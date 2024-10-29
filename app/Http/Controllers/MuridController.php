<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\Santri;
use App\Models\JawabanUjian;
use App\Models\Materii;
use App\Models\Tugas;
use App\Models\Ujian;
use App\Models\JawabanTugas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MuridController extends Controller
{

    public function index(){
        $user = Auth::guard('santri')->user();

        return view('siswa.DashboardM',[
            'title' => 'Dashboard Siswa',
            'user' => $user,
        ]);
    }

    public function mapel(){
        $user = Auth::guard('santri')->user();
        // $mapel = Mapel::all();
        // $mapel = Mapel::whereHas('kelas', function ($query) use ($user) {
        //     $query->where('id_kelas', $user->id_kelas); // Mengambil mapel yang terkait dengan kelas santri
        // })->get();

        $mapel = Mapel::whereHas('kelas', function ($query) use ($user) {
            $query->where('id_kelas', $user->id_kelas);
        })
        ->with(['materii' => function ($query) {
            $query->orderBy('created_at', 'asc'); // Pastikan materi pertama yang di-upload muncul pertama
        }])
        ->get();
         
        return view('siswa.MapelMurid',[
            'title' => 'Mapel',
            'user' => $user,
            'mapels' => $mapel

        ]);

    }

    public function showMateri($id)
    {
        $user = Auth::guard('santri')->user();
        $mapel = Mapel::find($id); // Mengambil data mapel berdasarkan ID

        if (!$mapel) {
            abort(404); // Jika mapel tidak ditemukan, tampilkan error 404
        }

        $materis = $mapel->materii()->where('status', 'Post')->paginate(3); // Ambil data materi untuk mapel ini

        return view('siswa.MateriMurid', [
            'title' => 'daftar Materi',
            'mapel' => $mapel,
            'materis' => $materis,
            'user' => $user,
        ]);
    }

    
    public function show($id)
{
    $user = Auth::guard('santri')->user();
    $materii = Materii::with('mapel')->findOrFail($id);
  
    return view('siswa.readMateri', [
        'title' => 'materi',
        'materi' => $materii,
        'user' => $user,
        
    ]);
}


    public function TugasMurid(){

        $user = Auth::guard('santri')->user();
        $mapel = Mapel::whereHas('kelas', function ($query) use ($user) {
            $query->where('id_kelas', $user->id_kelas); // Mengambil mapel yang terkait dengan kelas santri
        })->get();

        return view('siswa.tugasMurid',[
            'title'  => 'tugas',
            'user'   => $user,
            'tugasMapel' => $mapel

        ]);
    } 


    
    // public function ShowTugasMurid($id)
    // {
    //     $user = Auth::guard('santri')->user();
    //     $mapel = Mapel::find($id); // Mengambil data mapel berdasarkan ID

    //     if (!$mapel) {
    //         abort(404); // Jika mapel tidak ditemukan, tampilkan error 404
    //     }

    //     $materis = $mapel->materii; // Ambil data materi untuk mapel ini

    //     return view('siswa.MateriMurid', [
    //         'title' => 'daftar Materi',
    //         'mapel' => $mapel,
    //         'materis' => $materis,
    //         'user' => $user,
    //     ]);
    // }


    public function showTugasMurid($id)
    {
        $user = Auth::guard('santri')->user();
        $mapel = Mapel::findOrFail($id);

        // Sesuaikan logika untuk menampilkan detail mapel atau tugas
        // Misalnya, jika ingin menampilkan detail tugas dari mapel tertentu
        $tugas = Tugas::where('id_mapel', $mapel->id_mapel)->get();

        return view('siswa.draftTugas', [
            'title' => 'Detail Mapel Tugas',
            'mapel' => $mapel,
            'tugas' => $tugas,
            'user' => $user
        ]);
        
    }

    public function soalTugas($id){
        
    $user = Auth::guard('santri')->user();
    $tugas = Tugas::with('mapel')->findOrFail($id);
    
    return view('siswa.soalTugas',[
        'title' => 'tugas',
        'tugas' => $tugas,
        'user' => $user
    ]);

    }

    public function submitAnswer(Request $request)
    {
        // Validasi inputan
        $request->validate([
            'id_tugas' => 'required',
            'id_kelas' => 'required',
            'id_mapel' => 'required',
            'id_murid' => 'required',
            'jawaban_text' => 'required',
            'jawaban_file' => 'required|file|mimes:jpeg,png,pdf,|max:2048', // Validasi file PDF opsional
            'nilai_tugas'  => 'numeric'
        ], [
            'jawaban_text.required' => 'Kolom jawaban tidak boleh kosong.',
        ]);

        // Mengambil file PDF jika diunggah
        $file = $request->file('jawaban_file');
       
    if ($file) {
        // Buat nama file unik (misalnya menggunakan timestamp)
        $filename = 'jawaban_' . time() . '_' . $file->getClientOriginalName();

        // Tentukan direktori penyimpanan berdasarkan tipe file
        if ($file->getClientOriginalExtension() == 'pdf') {
            $path = $file->storeAs('pdfs', $filename); // Misalnya, untuk file PDF
        } elseif (in_array($file->getClientOriginalExtension(), ['jpg', 'jpeg', 'png', 'gif'])) {
            $path = $file->storeAs('images', $filename); // Misalnya, untuk gambar
        } elseif (in_array($file->getClientOriginalExtension(), ['doc', 'docx'])) {
            $path = $file->storeAs('documents', $filename); // Misalnya, untuk dokumen Word
        }

        // Jika jenis file tidak dikenali, sesuaikan dengan kebutuhan aplikasi Anda
    }

    // Set path ke null jika tidak ada file diunggah
    if (!$file) {
        $path = null;
    }

        // Menyimpan jawaban ke database
        JawabanTugas::create([
            'id_tugas' => $request->id_tugas,
            'id_kelas' => $request->id_kelas,
            'id_mapel' => $request->id_mapel,
            'id_murid' => $request->id_murid,
            'jawaban_text' => $request->jawaban_text,
            'jawaban_file' => $path,
            'nilai_tugas' => 0, 
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->route('tugas.draftTugas', ['id' =>  $request->id_mapel]);

    }

    public function rekapNilaiujianMurid(){
        $user = Auth::guard('santri')->user();
        
        $jawabanTugas = JawabanUjian::with(['ujian', 'kelas', 'mapel'])
        ->cari($user->id_murid)
        ->paginate(4);

   
        return view('siswa.nilaiujianMurid',[
            'title' => 'nilai ujian ',
            'user' => $user,
            'nilai' => $jawabanTugas,
        ]);
    }

    public function rekapNilaiMurid(){

        $user = Auth::guard('santri')->user();
        
        $jawabanTugas = JawabanTugas::where('id_murid', $user->id_murid)
        ->with(['tugas', 'kelas', 'mapel'])
        ->get();


   
        return view('siswa.nilaiMurid',[
            'title' => 'nilai Tugas ',
            'user' => $user,
            'nilai' => $jawabanTugas,
        ]);
    }

    public function UjianMurid(){
        $user = Auth::guard('santri')->user();
        $mapel = Mapel::whereHas('kelas', function ($query) use ($user) {
            $query->where('id_kelas', $user->id_kelas); // Mengambil mapel yang terkait dengan kelas santri
        })->get();


        return view('siswa.UjianMurid',[
            'title' => 'Ujian',
            'user' => $user,
            'mapel' => $mapel,

        ]);
    }

    public function draftujianmurid($id){
        $user = Auth::guard('santri')->user();
        $mapel = Mapel::findOrFail($id);

        // Sesuaikan logika untuk menampilkan detail mapel atau tugas
        // Misalnya, jika ingin menampilkan detail tugas dari mapel tertentu
        $tugas = Ujian::where('id_mapel', $mapel->id_mapel)->get();

        return view('siswa.draftUjian', [
            'title' => 'Detail Mapel Tugas',
            'mapel' => $mapel,
            'tugas' => $tugas,
            'user' => $user
        ]);
    }
    public function soalujian($id){
        $user = auth::guard('santri')->user();
        $ujian = Ujian::with('mapel')->findOrFail($id);
        return view('siswa.soalUjianm',[
            'title' => 'ujian',
            'user' => $user,
            'ujian' => $ujian
        ]);
    }

    public function jawabUjian(Request $request)
    {
  
        // Buat instance baru untuk jawaban ujian
        $jawabanUjian = new JawabanUjian();
        $jawabanUjian->id_ujian = $request->id_ujian;
        $jawabanUjian->id_kelas = $request->id_kelas;
        $jawabanUjian->id_mapel = $request->id_mapel;
        $jawabanUjian->id_murid = $request->id_murid;
        $jawabanUjian->student_ans = $request->student_ans;
        $jawabanUjian->nilai_ujian = $request->nilai_ujian;
    
        // Simpan jawaban ujian ke database
        $jawabanUjian->save();
    
        return redirect()->route('ujian.asa', ['id' => $request->id_mapel])->with('success', 'Jawaban telah berhasil disimpan.');
    }

    
   public function OpsiRekapNilai(){
    $user = Auth::guard('santri')->user();

    return view('siswa.rekapNilaii',[
        'title' => 'Rekap Nilai Murid',
        'user' => $user
    ]);
   }
    
    
    
    // public function simpanNilai(Request $request, $id)
    // {
    //     $request->validate([
    //         'nilai_tugas' => 'required|numeric|min:0|max:100',
    //     ]);

    //     $jawabanTugas = JawabanTugas::findOrFail($id);

    //     // Update nilai_tugas berdasarkan data dari request
    //     $jawabanTugas->nilai_tugas = $request->nilai_tugas;
    //     $jawabanTugas->save();

    //     // Redirect atau kembalikan response yang sesuai
    //     return back()->with('success', 'Nilai berhasil disimpan.');

      
    // }

}

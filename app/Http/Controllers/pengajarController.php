<?php

namespace App\Http\Controllers;
use App\Models\JawabanTugas;
use App\Models\Tugas;
use App\Models\Materii;
use App\Models\Ujian;
use App\Models\Mapel;
use App\Models\Santri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class pengajarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   $user = Auth::guard('pengajar')->user();
        $mapels = $user->mapels; 
        $mp = Mapel::where('id_pengajar', $user->id_pengajar)->get(); // iyeh maren la. ini sama kek yang di atas jadi ga di pake
        return view('pengajar/dashboardP',[
            'title' => 'Dashboard',
            'user' => $user,
            'mapels' => $mapels
        ]);

    }

    public function materi()
    {   
        $user = Auth::guard('pengajar')->user();
        $mapels = Mapel::where('id_pengajar', $user->id_pengajar)->pluck('id_mapel');
        $materi = Materii::with('mapel')
        ->whereIn('id_mapel', $mapels)
        ->cari() // Pastikan metode cari() ada jika diperlukan
        ->paginate(4);

        // $materi = Materii::with('mapel')->cari()->paginate(4);
       $mp = Mapel::where('id_pengajar', $user->id_pengajar)->get();

        return view('pengajar/materi', [
          
            'title' => 'Materi ',
            'materii' =>$materi,
            'user' => $user,
            'mapels' => $mp

        ]);

    }

    public function addMateriPage(){
         
        $user = Auth::guard('pengajar')->user();
        $materi = Materii::with('mapel')->get();
        $mp = Mapel::where('id_pengajar', $user->id_pengajar)->get();

        return view('pengajar/tambahMateri', [
        
            'title' => 'buat Materi ',
            // 'materii' =>$materi,
            'user' => $user,
            'mapels' => $mp,
            
        ]);
    }

    public function storeMateri(Request $request)
    {
        $request->validate([
            'id_mapel' => 'required',
            'judul_materi' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'konten' => 'required|string',
            'video_url' => 'nullable|string|max:255',
            'gambar_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        // Memeriksa dan menyimpan file gambar jika ada yang diunggah
        if ($request->hasFile('gambar_url')) {
            $file = $request->file('gambar_url');
            $fileName = time() . '_' . $file->getClientOriginalName(); // Menambahkan timestamp untuk memastikan nama unik
            $path = $file->storeAs('gambar_materi', $fileName); // Menyimpan file dengan nama yang diinginkan
        } else {
            $path = null; // Jika tidak ada gambar yang diunggah, simpan null
        }
    
        // Membuat instance baru dari model Materii
        $baru = new Materii();
        $baru->id_mapel = $request->id_mapel;
        $baru->judul_materi = $request->judul_materi;
        $baru->deskripsi = $request->deskripsi;
        $baru->konten = $request->konten;
        $baru->video_url = $request->video_url;
        $baru->gambar_url = $path; // Menyimpan path gambar ke dalam database
        $baru->status = 'draft'; // Menetapkan status default sebagai 'draft'
        $baru->id_pengajar = Auth::guard('pengajar')->user()->id_pengajar; 
        $baru->save();
    
        return redirect('/pengajar/materi')->with('success', 'Materi berhasil disimpan.');
    }
    

    public function showw($id)
{
    $user = Auth::guard('pengajar')->user();
    $materii = Materii::with('mapel')->findOrFail($id);
  
    return view('pengajar.dsbrM', [
        'title' => 'materi',
        'materi' => $materii,
        'user' => $user,
        
    ]);
}


public function edit($id)
{
     
    $user = Auth::guard('pengajar')->user();
    $mapels = Mapel::where('id_pengajar', $user->id_pengajar)->get();
    $materii = Materii::find($id);
  
    

    return view('pengajar.editMateri',[
        'title' => 'edit materi',
        'user' => $user,
        'materi' => $materii,
        'mapels' => $mapels
    ]);
}

public function update(Request $request, string $id)
{
  try{
    $materi = Materii::findOrFail($id);

    // Mengisi data materi dengan data baru dari form
    $materi->id_mapel = $request->input('id_mapel');
    $materi->judul_materi = $request->input('judul_materi');
    $materi->deskripsi = $request->input('deskripsi');
    $materi->konten = $request->input('konten');
    $materi->video_url = $request->input('video_url');
    $materi->gambar_url = $request->input('gambar_url');
    // Menyimpan perubahan data materi
    $materi->save();

    // Redirect ke halaman yang sesuai atau memberikan respons sukses
    return redirect('/pengajar/materi')->with('success', 'Materi berhasil diperbarui');
  } catch (\Exception $e) {
    return redirect('/pengajar/materi')->with('error', 'Gagal mengedit data. Silakan coba lagi.');
}
   
}
    public function hapusMateri($id){

        $angkatan = Materii::findOrFail($id);
        $angkatan->delete();

        return redirect('/pengajar/materi')->with('success', 'Data berhasil dihapus.');
    }
 
    
    public function tugas(){

        $user = Auth::guard('pengajar')->user();
        $mapels = $user->mapels;
        return view('pengajar.tugas',[
            'title' => 'Tugas',
            'user' => $user,
            'mapel' => $mapels
        ]);
    }
    /**
     * Display the specified resource.
     */
   

   

     public function materiByMapel($id)
     {
         $user = Auth::guard('pengajar')->user();
         $mapel = Mapel::with('tugas')->findOrFail($id);
         
         if (!$mapel) {
             abort(404, 'Mapel tidak ditemukan');
         }
     
         $tugass = Tugas::where('id_mapel', $id)
             ->with(['mapel', 'kelas'])
             ->Cari()
             ->paginate(3);  // Mengambil tugas berdasarkan mapel
     
         return view('pengajar.tugasMateri', [
             'title' => 'Tugas',
             'user' => $user,
             'mapel' => $mapel,
             'materis' => $tugass
         ]);
     }
     

   public function addTugas(string $id){
    
    $user = Auth::guard('pengajar')->user();
    $mapel = Mapel::find($id);
    $tugass = Tugas::where('id_mapel', $mapel->id_mapel)
    ->with(['mapel', 'kelas'])
    ->get();  // Mengambil materi berdasarkan mapel
    $kelas = $mapel->kelas;

    $lastTugas = Tugas::where('id_mapel', $mapel->id_mapel)->orderBy('no_tugas', 'desc')->first();

    // Tentukan nomor tugas berikutnya
    if ($lastTugas) {
        $nextTugasNumber = intval(preg_replace('/[^0-9]/', '', $lastTugas->no_tugas)) + 1;
    } else {
        $nextTugasNumber = 1;
    }

    // Buat nomor tugas
    $nextTugas = 'Tugas ke ' . $nextTugasNumber;

    return view('pengajar.tambahTugas',[
        
        'title' => 'menambahkan data tugas',
        'mapel' => $mapel,
        'user' => $user,
        'tugas' => $tugass,
        'kelas' => $kelas,
        'nextTugas' => $nextTugas

    ]);
   }

   public function storeAddTugas(Request $request){

    $id_mapel = $request->id_mapel;

    $messages = [
        'no_tugas.unique' => 'Nomor tugas sudah ada untuk mapel ini.',
        // ... tambahkan pesan lainnya jika diperlukan
    ];

    $request->validate([
        'id_mapel' => 'required',
        'id_kelas' => 'required',
        'deskripsi' => 'required',
        'dateline' => 'required|date_format:Y-m-d\TH:i', // Sesuaikan dengan format datetime-local
        'konten' => 'required',
        'no_tugas' => 'required|unique:tugas,no_tugas,null,id,id_mapel,' . $id_mapel,
    ], $messages);

    // Simpan data tugas ke dalam basis data
    $tugas = new Tugas();
    $tugas->id_mapel = $request->id_mapel;
    $tugas->id_kelas = $request->id_kelas;
    $tugas->deskripsi = $request->deskripsi;
    $tugas->dateline = $request->dateline;
    $tugas->konten = $request->konten;
    $tugas->no_tugas = $request->no_tugas;

    $tugas->save();

    $id_mapel = $request->id_mapel;

    return redirect()->route('materi.byMapel', ['id' => $id_mapel])
                     ->with('success', 'Tugas berhasil ditambahkan!');

   }

    public function detailTugas($id){

        $user = Auth::guard('pengajar')->user();
        $mapel = Tugas::findOrFail($id);
        $materii = Tugas::with('mapel')->findOrFail($id);
       
        return view('pengajar.detail-tugas',[
            'title' => 'detail tugas',
            'user' => $user,
            'tugas' => $materii,
            'mapel' => $mapel,
           
        ]);
    } 

    public function editTugas($id){

        $user = Auth::guard('pengajar')->user();
        $tugas = Tugas::with(['mapel','kelas'])->findOrFail($id);

    
        return view('pengajar.editTugas', [
            'title' => 'edit tugas',
            'user' => $user,
            'tugas' => $tugas,
           
            
        ]);
    }


    public function tugasUpdate(Request $request, string $id){

        $request->validate([
            'deskripsi' => 'required|string|max:255',
            'dateline' => 'required|date_format:Y-m-d\TH:i', // Sesuaikan dengan format datetime-local
            'konten' => 'required|string',
        ]);


        try{
            $tugas = Tugas::findOrFail($id);

        // Mengisi data materi dengan data baru dari form
        $tugas->id_mapel = $request->input('id_mapel');
        $tugas->id_kelas = $request->input('id_kelas');
        $tugas->deskripsi = $request->input('deskripsi');
        $tugas->konten = $request->input('konten');
        $tugas->dateline = $request->input('dateline');
        
 
        // Menyimpan perubahan data materi
        $tugas->save();
        $id_mapel = $request->input('id_mapel');

            // Redirect ke halaman yang sesuai atau memberikan respons sukses
            return redirect()->route('materi.byMapel', ['id' => $id_mapel])
            ->with('success', 'Tugas berhasil diEdit!');
          } catch (\Exception $e) {
            return redirect()->route('materi.byMapel', ['id' => $id_mapel])
            ->with('success', 'Tugas gagal diEdit!');
    }
     }

     public function hapusTugas($id){
        try {
            $tugas = Tugas::findOrFail($id);
            $tugas->delete();
    
            // Menambahkan notifikasi sukses ke dalam session
            return redirect()->route('materi.byMapel', ['id' => $tugas->id_mapel])
                ->with('success', 'Tugas berhasil dihapus!');
        } catch (\Exception $e) {
            // Menambahkan notifikasi gagal ke dalam session
            return redirect()->route('materi.byMapel', ['id' => $tugas->id_mapel])
                ->with('error', 'Tugas gagal dihapus!');
        }
    }

    public function beriNilaiTugas(){
        $user = Auth::guard('pengajar')->user();
        
        return view('pengajar.nilaiTugas',[
            'title' => 'nilai tugas give',
            'user' => $user,
        ]);
        
    }

    public function siswaSudahMengerjakan($id_tugas)
    {
        $tugas = Tugas::findOrFail($id_tugas);
        return $tugas->siswaSudahMengerjakan();
    }
    
    public function siswaBelumMengerjakan($id_tugas)
    {
        $tugas = Tugas::findOrFail($id_tugas);
        return $tugas->siswaBelumMengerjakan();
    }
    


    public function detailSiswa($id)
{
    $user = Auth::guard('pengajar')->user();
    $tugas = Tugas::findOrFail($id);
    $siswaSudahMengerjakan = $tugas->siswaSudahMengerjakanWithNilai();
    $siswaBelumMengerjakan = $tugas->siswaBelumMengerjakan();
    

    return view('pengajar.tugasMengerjakan', [
        'title' => 'tugas',
        'user' => $user,
        'tugas' => $tugas,
        'jawabanTugas' =>  $siswaSudahMengerjakan
        
 
    ]);
}

public function siswaTidakMengerjakan($id)
{
    $user = Auth::guard('pengajar')->user();
    $tugas = Tugas::findOrFail($id);
    $siswaSudahMengerjakan = $tugas->siswaSudahMengerjakanWithNilai();
    $siswaBelumMengerjakan = $tugas->siswaBelumMengerjakan();
    

    return view('pengajar.tugasNoMengerjakan', [
        'title' => 'tugas',
        'user' => $user,
        'tugas' => $tugas,
        'jawabanTugas' =>  $siswaSudahMengerjakan
        
 
    ]);
}

public function updateNilai(Request $request, $id)
{
    // Validasi data input jika diperlukan
    $request->validate([
        'nilai_tugas' => 'required|numeric|min:0|max:100',
    ]);
    // Temukan jawaban tugas berdasarkan ID
    $jawabanTugas = JawabanTugas::findOrFail($id);

    // Update nilai_tugas berdasarkan data dari request
    $jawabanTugas->nilai_tugas = $request->nilai_tugas;
    $jawabanTugas->save();

    // Respon kembali ke client
    return back()->with('success', 'Nilai berhasil disimpan.');
}

public function showPdfView($id)
{
    // Path lengkap ke file PDF di storage
    // Mengambil jawaban tugas berdasarkan ID
    $jawaban = JawabanTugas::with(['mapel', 'murid', 'kelas'])->findOrFail($id);

    // Kirim data jawaban ke tampilan
    return view('pengajar.pdf-view', ['jawaban' => $jawaban]);
}


    public function rekapNilai(){

        $user = Auth::guard('pengajar')->user();

        return view('pengajar.rekapNilai',[
            'title' => 'Rekap Nilai Murid',
            'user' => $user
        ]);
    }



    public function rekapNilaiMurid(){

        $user = Auth::guard('pengajar')->user();
        // $murid = Santri::with(['jawabanTugas', 'kelas'])->paginate(3);
        $murid = Santri::with(['jawabanTugas.tugas.mapel', 'kelas'])->paginate(3);
        
        foreach ($murid as $santri) {
            $santri->rataRataNilai = $santri->jawabanTugas->avg('nilai_tugas');
        }
           
        return view('pengajar.rekapNilaiSiswa',[
            'title' => 'rekap nilai tugas',
            'user' => $user,
            'siswa' => $murid 
        ]);

    }

    public function transkipNilaiPeng($id)
    {
        $user = Auth::guard('pengajar')->user();
        $siswa = Santri::with(['jawabanTugas.tugas.mapel', 'kelas'])->findOrFail($id);
    
        return view('pengajar.transkipNilai', [
            'title' => 'Rekap Nilai',
            'siswa' => $siswa,
            'user' => $user,
        ]);
    }

    public function ujianP(){

        $user = Auth::guard('pengajar')->user();
        $mpl =  $user->mapels;
        return view('pengajar.Ujian', [
            'title' => 'Ujian',
            'user' => $user,
            'mapel' => $mpl

        ]);
    }

    public function ujianDraft($id){
        $user = Auth::guard('pengajar')->user();
        $mapel = Mapel::with('ujian')->findOrFail($id);
        
        if (!$mapel) {
            abort(404, 'Mapel tidak ditemukan');
        }
    
        $tugass = Ujian::where('id_mapel', $id)
            ->with(['mapel', 'kelas'])
            ->Cari()
            ->paginate(3);  // Mengambil tugas berdasarkan mapel

        return view('pengajar.ujianDraft',[
            'title' => 'Data Ujian',
            'user' => $user,
            'mapel' => $mapel,
            'ujian' => $tugass,
        ]);
    }

    
public function detailSiswaujian($id)
{
    $user = Auth::guard('pengajar')->user();
    $ujian = Ujian::with('mapel')->findOrFail($id);
    $siswaSudahMengerjakan = $ujian->siswaSudahMengerjakanWithNilaiujian();
  
    return view('pengajar.ujianMengerjakan', [
        'title' => 'ujian',
        'user' => $user,
        'ujian' => $ujian,
        'siswaSudah' =>  $siswaSudahMengerjakan
        
 
    ]);
}
    public function formAddUjian(string $id){

        $user = Auth::guard('pengajar')->user();
        $mapel = Mapel::find($id);
        $ujian = Ujian::where('id_mapel', $mapel->id_mapel)
        ->with(['mapel', 'kelas'])
        ->get();  // Mengambil materi berdasarkan mapel
        $kelas = $mapel->kelas;

        return view('pengajar.formAddUjian',[
            'title' => 'buat ujian',
            'user' => $user,
            'mapel' => $mapel,
            'ujian' => $ujian,
            'kelas' => $kelas,
        ]);
    }

    public function addUjian(Request $request)
{
    $id_mapel = $request->id_mapel;

    $request->validate([
        'id_mapel' => 'required',
        'id_kelas' => 'required',
        'Deskripsi' => 'required|string|max:255',
        'waktu_mulai' => 'required|date_format:Y-m-d\TH:i',
        'waktu_berakhir' => 'required|date_format:Y-m-d\TH:i',
        'pertanyaan' => 'required|string',
        
    ],);

    // Simpan data ujian ke dalam basis data
    $ujian = new Ujian();
    $ujian->id_mapel = $request->id_mapel;
    $ujian->id_kelas = $request->id_kelas;
    $ujian->Deskripsi = $request->Deskripsi;
    $ujian->waktu_mulai = $request->waktu_mulai;
    $ujian->waktu_berakhir = $request->waktu_berakhir;
    $ujian->pertanyaan = $request->pertanyaan;

    // Jika ada file audio, simpan file dan set path-nya
    if ($request->hasFile('audio_ujian')) {
        $audioPath = $request->file('audio_ujian')->storeAs(
            'audio_ujian', 
            'ujian_' . time() . '_' . $request->file('audio_ujian')->getClientOriginalName()
        );
        $ujian->audio_ujian = $audioPath;
    } else {
        // Jika tidak ada file yang diupload, set audio_ujian menjadi null
        $ujian->audio_ujian = null;
    }

    $ujian->save();

    return redirect()->route('ujian.draft', ['id' => $id_mapel])
                     ->with('success', 'Ujian berhasil ditambahkan!');
}

public function infoUjian($id){
    $user = Auth::guard('pengajar')->user();
    $ujian = Ujian::with('mapel')->findOrFail($id);
    return view('pengajar.infoUjian',[
        'title' => 'ujian',
        'user' => $user,
        'ujian' => $ujian
    ]);
}

public function editUjian(string $id){
    $user = Auth::guard('pengajar')->user();
    $ujian = Ujian::with(['mapel', 'kelas'])->findOrFail($id);
    return view('pengajar.editUjian',[
        'title' => 'edit ujian',
        'user' => $user,
        'ujian' => $ujian,
    ]);
}

public function updateUjian(Request $request, string $id) {
    $id_mapel = $request->input('id_mapel'); // Mendefinisikan $id_mapel di luar blok try-catch

    try {
        $ujian = Ujian::findOrFail($id);

        // Mengisi data ujian dengan data baru dari form
        $ujian->id_mapel = $request->input('id_mapel');
        $ujian->id_kelas = $request->input('id_kelas');
        $ujian->Deskripsi = $request->input('Deskripsi');
        $ujian->pertanyaan = $request->input('pertanyaan');
        $ujian->waktu_mulai = $request->input('waktu_mulai');
        $ujian->waktu_berakhir = $request->input('waktu_berakhir');

        // Mengelola file audio jika ada file baru yang diunggah
        if ($request->hasFile('audio_ujian')) {
            // Hapus file lama jika ada
            if ($ujian->audio_ujian && Storage::exists($ujian->audio_ujian)) {
                Storage::delete($ujian->audio_ujian);
            }

            // Upload file baru
            $file = $request->file('audio_ujian');
            $filename = 'ujian_' . time() . '_' . $file->getClientOriginalName();
            $audioPath = $file->storeAs('audio_ujian', $filename);

            // Simpan nama file baru ke database
            $ujian->audio_ujian = $audioPath;
        }

        // Menyimpan perubahan data ujian
        $ujian->save();

        // Redirect ke halaman yang sesuai atau memberikan respons sukses
        return redirect()->route('ujian.draft', ['id' => $id_mapel])
            ->with('success', 'Ujian berhasil diedit!');
    } catch (\Exception $e) {
        return redirect()->route('ujian.draft', ['id' => $id_mapel])
            ->with('error', 'Ujian gagal diedit!'); // Mengganti 'success' dengan 'error' untuk pesan kesalahan
    }
}
    public function destroyUjian($id){
    try {
        // Temukan ujian berdasarkan ID
        $ujian = Ujian::findOrFail($id);

        // Path file audio di storage
        $audioPath = $ujian->audio_ujian; // Pastikan nama kolom ini benar sesuai dengan yang ada di database

        // Menghapus file audio jika ada
        if ($audioPath && Storage::exists($audioPath)) {
            Storage::delete($audioPath);
        }

        // Menghapus data ujian dari database
        $ujian->delete();

        // Menambahkan notifikasi sukses ke dalam session
        return redirect()->route('ujian.draft', ['id' => $ujian->id_mapel])
            ->with('success', 'Ujian dan file audio berhasil dihapus!');
    } catch (\Exception $e) {
        // Menambahkan notifikasi gagal ke dalam session
        return redirect()->route('ujian.draft', ['id' => $ujian->id_mapel])
            ->with('error', 'Ujian gagal dihapus!');
    }
}



public function siswaSudahMengerjakanujian($id_tugas)
{
    $tugas = Tugas::findOrFail($id_tugas);
    return $tugas->siswaSudahMengerjakan();
}

public function siswaBelumMengerjakanujian($id_tugas)
{
    $tugas = Tugas::findOrFail($id_tugas);
    return $tugas->siswaBelumMengerjakanujian();
}
   
     
    }

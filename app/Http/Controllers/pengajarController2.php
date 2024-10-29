<?php

namespace App\Http\Controllers;
use App\Models\JawabanTugas;
use App\Models\JawabanUjian;
use App\Models\Tugas;
use App\Models\Materii;
use App\Models\Ujian;
use App\Models\Mapel;
use App\Models\Santri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class pengajarController2 extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function siswaBelumMengerjakanujian($id_tugas)
    {
        $tugas = Tugas::findOrFail($id_tugas);
        return $tugas->siswaBelumMengerjakanujian();
    }
   
public function detailSiswaujianbelum($id){

    $user = Auth::guard('pengajar')->user();
    $ujian = Ujian::findOrFail($id);
    $siswaSudahMengerjakan = $ujian->siswaSudahMengerjakanWithNilaiujian();
    $siswaBelumMengerjakan = $ujian->siswaBelumMengerjakanujian();
    
    return view('pengajar.ujianNoMengerjakan', [
        'title' => 'ujian',
        'user' => $user,
        'ujian' => $ujian,
        'siswaSudah' =>  $siswaSudahMengerjakan
    ]);

}    

public function submitNilaiUjian(Request $request, $id){
    $request->validate([
        'nilai_ujian' => 'required|numeric|min:0|max:100',
    ]);
    $jawabanUjian = JawabanUjian::findOrFail($id);

    // Update nilai_tugas berdasarkan data dari request
    $jawabanUjian->nilai_ujian = $request->nilai_ujian;
    $jawabanUjian->save();

    return back()->with('success', 'Nilai berhasil disimpan.');
    
}

public function rekapNilaiujianMurid(){

    $user = Auth::guard('pengajar')->user();
    // $murid = Santri::with(['jawabanTugas', 'kelas'])->paginate(3);
    $murid = Santri::with(['jawabanUjian.ujian.mapel', 'kelas'])->paginate(3);
    
    foreach ($murid as $santri) {
        $santri->rataRataNilai = $santri->jawabanUjian->avg('nilai_ujian');
    }
       
    return view('pengajar.rekapNilaiUjian',[
        'title' => 'rekap nilai ujian',
        'user' => $user,
        'siswa' => $murid 
    ]);
}
   public function transkipNilaiUjian($id){
    $user = Auth::guard('pengajar')->user();
    $siswa = Santri::with(['jawabanUjian.ujian.mapel', 'kelas'])->findOrFail($id);

    return view('pengajar.transkipNilaiUjian', [
        'title' => 'Rekap Nilai Ujian',
        'siswa' => $siswa,
        'user' => $user,
    ]);
   }

   public function setStatusDraft($id)
{
    $materi = Materii::find($id);
    $materi->status = 'Draft';
    $materi->save();

    return redirect()->back()->with('success', 'Materi berhasil disimpan sebagai Draft.');
}

public function setStatusPost($id)
{
    $materi = Materii::find($id);
    $materi->status = 'Post';
    $materi->save();

    return redirect()->back()->with('success', 'Materi berhasil dipublikasikan.');
}

public function ujianCek($id){
    $user = Auth::guard('pengajar')->user();
    $jawaban = JawabanUjian::with(['mapel', 'murid', 'kelas'])->findOrFail($id);
    return view('pengajar.ujianCek', [
        'title' => 'jawaban Ujian',
        'jawaban' => $jawaban,
        'user'    => $user
    ]);
}

     
    }

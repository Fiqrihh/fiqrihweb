<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use App\Models\Kelas;
use App\Http\Requests\StoreKelasRequest;
use App\Http\Requests\UpdateKelasRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $kelass = Kelas::all();
        $kelas = Kelas::orderBy('created_at', 'asc')->paginate(3);

        return view('admin.kelas',[
            'title' => 'kelas',
            'user' => $user,
            'kelas' => $kelas,
            'kelass' => $kelass
            
        ]);
    }

    public function store(request $request){

        $new = new Kelas();
        $data = $request->only($new->getFillable());
        $new->n_kelas = $data['n_kelas'];
        $new->save();
        return redirect('/Mkelas');
    }

    public function update(Request $request, string $id)
    {
        try {
            $kelas = Kelas::findOrFail($id);
    
            // Mengupdate data pengeluaran
            $kelas->n_kelas = $request->input('n_kelas');
            $kelas->save();
    
            return redirect('/Mkelas')->with('success', 'Data berhasil diedit.');
        } catch (\Exception $e) {
            return redirect('/Mkelas')->with('error', 'Gagal mengedit data. Silakan coba lagi.');
        }
    }

    public function destroy($id)
    {
        $angkatan = Kelas::findOrFail($id);
        $angkatan->delete();

        return redirect('/Mkelas')->with('success', 'Data berhasil dihapus.');
    }



    public function kelasMurid($id_kelas)
{
    // Ambil data murid berdasarkan id_kelas
    $user = Auth::user();
    
    // Ambil murid dan nilai_tugas serta nilai_ujian
    $murid = Santri::where('id_kelas', $id_kelas)
        ->withCount(['jawabanTugas as nilai_tugas' => function($query) {
            $query->select(DB::raw('avg(nilai_tugas) as rata_rata_tugas'));
        }])
        ->withCount(['jawabanUjian as nilai_ujian' => function($query) {
            $query->select(DB::raw('avg(nilai_ujian) as rata_rata_ujian'));
        }])
        ->paginate(10);

    // Tampilkan view dengan data murid
    return view('admin.kelas_murid', [
        'title' => 'Data Murid Kelas',
        'user' => $user,
        'kelas' => $murid
    ]);
}

public function naikKelas($id)
{
    $murid = Santri::find($id);
    if ($murid) {
        if ($murid->id_kelas < 4) {
            $murid->id_kelas += 1; // Naik ke kelas berikutnya
        } elseif ($murid->id_kelas == 4) {
            // Tidak ada perubahan jika sudah di kelas 4
        }
        $murid->save();
    }

    return redirect()->back()->with('status', 'Status kelas berhasil diperbarui.');
}


    
    // public function kelasMurid($id_kelas)
    // {
    //     // Ambil data murid berdasarkan id_kelas
    //     $user = Auth::user();
    //     $murid = Santri::where('id_kelas', $id_kelas)->paginate(10);
        
    //     // Tampilkan view dengan data murid
    //     return view('admin.kelas_murid', [
    //         'title' => 'hai',
    //         'user' => $user,
    //         'kelas' => $murid
    //     ]);
    // }
    

}

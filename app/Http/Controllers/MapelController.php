<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\Kelas;
use App\Models\Pengajarr;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreMapelRequest;
use App\Http\Requests\UpdateMapelRequest;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {    $user = Auth::user();
        //  $mapel = Mapel::all();
        $mapel = Mapel::join('pengajarrs', 'mapels.id_pengajar', '=', 'pengajarrs.id_pengajar')
        ->join('kelas', 'mapels.id_kelas', '=', 'kelas.id_kelas')
        ->select('mapels.*', 'pengajarrs.namaP', 'kelas.n_kelas')
        ->orderByDesc('mapels.id_mapel')
        ->Cari()
        ->paginate(3);
          $pengajar = Pengajarr::orderBy('namaP')->get();
          $mep = Mapel::all();
          $klas = Kelas::all();

        return view('admin.mapel',[
            'title' => 'data mapel',
            'user'  => $user,
            'mpl'  => $mep,
            'mapl'=> $mapel,
            'peng' => $pengajar,
            'kelas' => $klas,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $baru = new Mapel();
        $data = $request->only($baru->getFillable());
        $baru->nama_mapel = $data['nama_mapel'];
        $baru->id_pengajar = $data['id_pengajar'];
        $baru->id_kelas = $data['id_kelas'];
        
        $baru->save();
        return redirect('/mapel');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mapel $mapel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = Auth::user();
        $mapel = Mapel::findOrFail($id);
        $pengajar = Pengajarr::orderBy('namaP')->get();

        return view('admin.angkatan', [
            'title' => 'Kelola Data Periode',
            'user'    => $user,
            'mpl' => $mapel,
            'peng' => $pengajar,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $mpl = Mapel::findOrFail($id);
    
            // Mengupdate data pengeluaran
            $mpl->nama_mapel = $request->input('nama_mapel');
            $mpl->id_pengajar = $request->input('id_pengajar');
            $mpl->save();
    
            return redirect('/mapel')->with('success', 'Data berhasil diedit.');
        } catch (\Exception $e) {
            return redirect('/mapel')->with('error', 'Gagal mengedit data. Silakan coba lagi.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $angkatan = Mapel::findOrFail($id);
        $angkatan->delete();

        return redirect('/mapel')->with('success', 'Data berhasil dihapus.');
    }
}

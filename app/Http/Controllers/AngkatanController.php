<?php

namespace App\Http\Controllers;

use App\Models\Angkatan;
use App\Http\Requests\StoreAngkatanRequest;
use App\Http\Requests\UpdateAngkatanRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AngkatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $angkatan = Angkatan::all();
        $angkatan2 = Angkatan::orderBy('created_at', 'desc')->Cari()->paginate(3);

        return view('admin.angkatan',[
            'title' => 'Kelola Data Periode',
            'user'    => $user,
            'periode' => $angkatan,
            'period'  => $angkatan2
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $baru = new Angkatan();
        $data = $request->only($baru->getFillable());
        $baru->tahun = $data['tahun'];
        $baru->bulan = $data['bulan'];
        $baru->save();
        return redirect('/angkatan');

    }

    /**
     * Display the specified resource.
     */
    public function show(Angkatan $angkatan)
    {
        
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = Auth::user();
        $angkatan = Angkatan::findOrFail($id);

        return view('admin.angkatan', [
            'title' => 'Kelola Data Periode',
            'user'    => $user,
            'periode' => $angkatan,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $periode = Angkatan::findOrFail($id);
    
            // Mengupdate data pengeluaran
            $periode->tahun = $request->input('tahun');
            $periode->bulan = $request->input('bulan');
            $periode->save();
    
            return redirect('/angkatan')->with('success', 'Data berhasil diedit.');
        } catch (\Exception $e) {
            return redirect('/angkatan')->with('error', 'Gagal mengedit data. Silakan coba lagi.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $angkatan = Angkatan::findOrFail($id);
        $angkatan->delete();

        return redirect('/angkatan')->with('success', 'Data berhasil dihapus.');
    }
}

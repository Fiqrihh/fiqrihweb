<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreSuratRequest;
use App\Http\Requests\UpdateSuratRequest;

class SuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sm = Surat::paginate(2);
        $user = Auth::user();
        $surat = Surat::all();
        return view('admin/suratMasuk',[
            'title' => 'surat masuk',
            'surat' =>  Surat::latest()->Cari()->paginate(3),
            'user' => $user,
            'sm'   => $sm,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $surat = Surat::all();

        return view('admin/formSurat', [
            'title' => 'form surat masuk',
            'user' => $user,
            'surat' => $surat,
    
            
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         
        $file = $request->file('fileSuratM');

// Periksa apakah file berhasil diunggah
if ($file) {
    // Ubah format tanggal jika diinginkan
    $filename = date('Y-m-d') . '_' . $file->getClientOriginalName();
    $path = 'filemasuk/' . $filename;

    // Simpan file
    Storage::disk('public')->put($path, file_get_contents($file));

    // Simpan data surat ke dalam database
    $surat = new Surat();
    $data = $request->only($surat->getFillable());
    $surat->pengirim = $data['pengirim'];
    $surat->judulSuratM = $data['judulSuratM'];
    $surat->nomorSuratM = $data['nomorSuratM'];
    $surat->tglSuratM = $data['tglSuratM'];
    $surat->isiSuratM = $data['isiSuratM'];
    $surat->fileSuratM = $filename;

    // Simpan data surat ke dalam database
    $surat->save();


    return redirect('/sMasuk');
} else {
    // Handle kesalahan jika file tidak berhasil diunggah
    return back()->withErrors(['fileSuratM' => 'Gagal mengunggah file.']);
}


    }

    /**
     * Display the specified resource.
     */
    public function show(Surat $surat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {   
        $user = Auth::user();
        $surat = Surat::all();
        return view('admin/editSuratm', Surat::findOrFail($id)->toArray(),[
                    'surat' => $surat,
                    'title' => 'edit data surat',
                    'user' => $user,

                ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $surat = Surat::findOrFail($id);
            // Mengupdate data surat
            $surat->Pengirim = $request->input('Pengirim');
            $surat->judulSuratM = $request->input('judulSuratM');
            $surat->nomorSuratM =$request->input('nomorSuratM');
            $surat->isiSuratM =$request->input('isiSuratM');
            $surat->tglSuratM =$request->input('tglSuratM');
            $surat->save();
    
            return redirect('/sMasuk')->with('success', 'Data berhasil diedit.');
        } catch (\Exception $e) {
            return redirect('/sMasuk')->with('error', 'Gagal mengedit data. Silakan coba lagi.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $surat = Surat::findOrFail($id);
    
            // Hapus file dari storage
            $filePath = 'filemasuk/' . $surat->fileSuratM;
            Storage::disk('public')->delete($filePath);
    
            // Hapus entri dari database
            $surat->delete();
    
            return redirect('/sMasuk')->with('success', 'Data surat berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect('/sMasuk')->with('error', 'Gagal menghapus data surat. Silakan coba lagi.');
        }
    }
}

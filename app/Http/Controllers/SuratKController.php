<?php

namespace App\Http\Controllers;

use App\Models\SuratK;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PDF;

class SuratKController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sm = SuratK::paginate(2);
        $user = Auth::user();
        $surat = SuratK::all();
        return view('admin/suratK',[
            'title' => 'surat Keluar',
            'surat' =>  SuratK::latest()->Cari()->paginate(3),
            'user' => $user,
            'sm'   => $sm,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Periksa apakah file berhasil diunggah
            $su = suratK::all();
            // Simpan data surat ke dalam database
            $surat = new SuratK();
            $data = $request->only($surat->getFillable());
            $surat->penerima = $data['penerima'];
            $surat->judulSuratK = $data['judulSuratK'];
            $surat->nomorSuratK = $data['nomorSuratK'];
            $surat->tglSuratK = $data['tglSuratK'];
            $surat->isiSuratK = $data['isiSuratK'];
            $surat->fileSuratK = $data['fileSuratK'];
            $surat->tempat = $data['tempat'];
            $surat->save();

            $suratBaru = SuratK::find($surat->id);

            $pdf = PDF::loadView('admin.pdfK', [
                'surat' => $suratBaru
            ]);

            // Tentukan lokasi penyimpanan baru
           
            return redirect('/sKeluar');
    }

    /**
     * Display the specified resource.
     */
    public function show(SuratK $suratK)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = Auth::user();
        $surat = SuratK::all();
        return view('admin/editSuratK', SuratK::findOrFail($id)->toArray(),[
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
            $surat = SuratK::findOrFail($id);
            // Mengupdate data surat
            $surat->Penerima = $request->input('Penerima');
            $surat->judulSuratK = $request->input('judulSuratK');
            $surat->nomorSuratK =$request->input('nomorSuratK');
            $surat->isiSuratK =$request->input('isiSuratK');
            $surat->tglSuratK =$request->input('tglSuratK');
            $surat->tempat =$request->input('tempat');
            $surat->save();
    
            return redirect('/sKeluar')->with('success', 'Data berhasil diedit.');
        } catch (\Exception $e) {
            return redirect('/sKeluar')->with('error', 'Gagal mengedit data. Silakan coba lagi.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        try {
            $surat = SuratK::findOrFail($id);
    
            // Hapus file dari storage
            $filePath = 'filekeluar/' . $surat->fileSuratK;
            Storage::disk('public')->delete($filePath);
    
            // Hapus entri dari database
            $surat->delete();
    
            return redirect('/sKeluar')->with('success', 'Data surat berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect('/sKeluar')->with('error', 'Gagal menghapus data surat. Silakan coba lagi.');
        }
    }
     public function printPDF($id)
    {
        $surat = SuratK::findOrFail($id);
        
        $pdf = PDF::loadView('admin.pdfK', compact('surat'));

        return $pdf->stream('surat_keluar_'.$id.'.pdf');
    }
    }


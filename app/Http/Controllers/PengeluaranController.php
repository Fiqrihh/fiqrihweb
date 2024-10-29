<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengeluaran;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePengeluaranRequest;
use App\Http\Requests\UpdatePengeluaranRequest;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        
        $belii = Pengeluaran::join('kategoris', 'pengeluarans.id_kategori', '=', 'kategoris.id_kategori')
        ->select('pengeluarans.*', 'kategoris.nama_kategori')
         ->orderByDesc('pengeluarans.id')->Cari()->paginate(5);
        
        $user = Auth::user();
        $totd = Pengeluaran::all();
        $kategori   = Kategori::all();
        $totalData = Pengeluaran::count();
        $itemsPerPage = 10; // Jumlah data yang ingin ditampilkan per halaman
        $totalPages = ceil($totalData / $itemsPerPage);

        $peng = Pengeluaran::all();
        return view('admin/pengeluaran', [
            'title' => 'pengeluaran',
            'keluar' => $belii,
            'pages' => $itemsPerPage,
            'pg' => $totalData,
            'kate' => $kategori,
            'data' => $totd,
            'user' => $user,
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
        $baru = new Pengeluaran();
        $data = $request->only($baru->getFillable());
        $baru->nama = $data['nama'];
        $baru->jumlah_peng = $data['jumlah_peng'];
        $baru->tanggal_peng = $data['tanggal_peng'];
        $baru->id_kategori    =  $data['id_kategori'];
        $baru->save();
        return redirect('/transaksi/pengeluaran');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengeluaran $pengeluaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {   
        $user = Auth::user();
        $kategori   = Kategori::all();
        $totd = Pengeluaran::all();
        return view('admin/editpeng', Pengeluaran::findOrFail($id)->toArray(),[
                    'kate' => $kategori,
                    'data' => $totd,
                    'title' => 'edit data',
                    'user' => $user,
        ]
        );
       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    
        try {
            $pengeluaran = Pengeluaran::findOrFail($id);
    
            // Mengupdate data pengeluaran
            $pengeluaran->nama = $request->input('nama');
            $pengeluaran->jumlah_peng = $request->input('jumlah_peng');
            $pengeluaran->tanggal_peng =$request->input('tanggal_peng');
            $pengeluaran->id_kategori =$request->input('id_kategori');
            $pengeluaran->save();
    
            return redirect('/transaksi/pengeluaran')->with('success', 'Data berhasil diedit.');
        } catch (\Exception $e) {
            return redirect('/transaksi/pengeluaran')->with('error', 'Gagal mengedit data. Silakan coba lagi.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $siswa = Pengeluaran::findOrFail($id);
        $siswa->delete(); 

        return redirect('/transaksi/pengeluaran')->with('success', 'Data berhasil dihapus.');
    }
}

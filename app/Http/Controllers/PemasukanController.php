<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemasukan;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePemasukanRequest;
use App\Http\Requests\UpdatePemasukanRequest;

class PemasukanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $untung = Pemasukan::join('kategoris', 'pemasukans.id_kategori', '=', 'kategoris.id_kategori')
        ->select('pemasukans.*', 'kategoris.nama_kategori')
         ->orderByDesc('pemasukans.id')->Cari()->paginate(5);

        $user = Auth::user();
        $kategori   = Kategori::all();
        $totd = Pemasukan::all();
        $totalData = Pemasukan::count();
        $masuk = Pemasukan::paginate(10);
        $itemsPerPage = 10; // Jumlah data yang ingin ditampilkan per halaman
        $totalPages = ceil($totalData / $itemsPerPage);

        $peng = Pemasukan::all();
        return view('admin/Pemasukan', [
            'title' => 'Pemasukan',
            'masuk' => $untung,
            'kate' => $kategori,
            'user' =>$user,
            
            
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $baru = new Pemasukan();
        $data = $request->only($baru->getFillable());
        $baru->nama = $data['nama'];
        $baru->jumlah_pem = $data['jumlah_pem'];
        $baru->tanggal_pem = $data['tanggal_pem'];
        $baru->id_kategori    =  $data['id_kategori'];
        $baru->save();
        return redirect('/transaksi/pemasukan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pemasukan $pemasukan)
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
        $totd = Pemasukan::all();
       
        return view('admin/editpem', Pemasukan::findOrFail($id)->toArray(),[
                    'kate' => $kategori,
                    'data' => $totd,
                    'title' => 'edit data',
                    'user' => $user,
                    
                ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $pemasukan = Pemasukan::findOrFail($id);
    
            // Mengupdate data pemasukan
            $pemasukan->nama = $request->input('nama');
            $pemasukan->jumlah_pem = $request->input('jumlah_pem');
            $pemasukan->tanggal_pem =$request->input('tanggal_pem');
            $pemasukan->id_kategori =$request->input('id_kategori');
            $pemasukan->save();
    
            return redirect('/transaksi/pemasukan')->with('success', 'Data berhasil diedit.');
        } catch (\Exception $e) {
            return redirect('/transaksi/pemasukan')->with('error', 'Gagal mengedit data. Silakan coba lagi.');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        
        $siswa = Pemasukan::findOrFail($id);
        $siswa->delete(); 

        return redirect('/transaksi/pemasukan')->with('success', 'Data berhasil dihapus.');
    }

    public function grafik(){
        $pendapatan = Pemasukan::all();
        $cuan  = $pendapatan->sum('jumlah_pem');
    }




}

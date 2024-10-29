<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $user = Auth::user();
        $pendapatan = Pemasukan::all();
        $beli       = Pengeluaran::all();
        $kategori   = Kategori::all();

           $belii = Pengeluaran::join('kategoris', 'pengeluarans.id_kategori', '=', 'kategoris.id_kategori')
                      ->select('pengeluarans.*', 'kategoris.nama_kategori')
                       ->orderByDesc('pengeluarans.id')
                      ->take(3)
                      ->get();
           $untung = Pemasukan::join('kategoris', 'pemasukans.id_kategori', '=', 'kategoris.id_kategori')
                      ->select('pemasukans.*', 'kategoris.nama_kategori')
                       ->orderByDesc('pemasukans.id')
                      ->take(3)
                      ->get();


        return view('admin/Transaksi', [
            'title' => 'Keuangan',
             'dapat' => $pendapatan,
             'beli'  => $beli,
             'belanja'=> $belii,
             'dibeli' => $untung,
             'kate' => $kategori,
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
    public function edit(Pemasukan $pemasukan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pemasukan $pemasukan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pemasukan $pemasukan)
    {
        //
    }
}

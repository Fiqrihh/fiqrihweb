<?php

namespace App\Http\Controllers;


use App\Models\kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorekategoriRequest;
use App\Http\Requests\UpdatekategoriRequest;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $kategori = Kategori::all();
        return view('admin/kategori', [
        'title' => 'Kategori',
        'user' => $user,
        'kate' => $kategori,
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
        $baru = new Kategori();
        $data = $request->only($baru->getFillable());
        $baru->nama_kategori = $data['nama_kategori'];
        $baru->save();
        return redirect('/kategori');
    }

    /**
     * Display the specified resource.
     */
    public function show(kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(kategori $kategori)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatekategoriRequest $request, kategori $kategori)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete(); 

        return redirect('/kategori')->with('success', 'Data berhasil dihapus.');
    }

}


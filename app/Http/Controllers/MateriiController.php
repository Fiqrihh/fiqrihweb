<?php

namespace App\Http\Controllers;

use App\Models\Materii;
use App\Http\Requests\StoreMateriiRequest;
use App\Http\Requests\UpdateMateriiRequest;

class MateriiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $materi = Materii::all();

        return view('pengajar/materi', [
          
            'title' => 'Materi ',
            'materii' =>$materi,
            // 'pelajar' => $murid1,
            // 'user'    => $user,  
        ]);    }

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
    public function store(StoreMateriiRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Materii $materii)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Materii $materii)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMateriiRequest $request, Materii $materii)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Materii $materii)
    {
        //
    }
}

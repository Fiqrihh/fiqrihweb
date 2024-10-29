<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Santri;
use Illuminate\Support\Facades\Auth;

class alumniController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $murid1 =  Santri::all();
        $murid =  Santri::count();
        return view('admin/alumni', [
            'pelajarJ' => Admin::latest()->Cari()->paginate(3),
            'title' => 'Data Alumni ',
            'pelajar' => $murid1,
            'user'    => $user,
            
        ]);
    }

    public function destroy( $id)
    {
        
        $siswa = Admin::findOrFail($id);
        $siswa->delete(); 

        return redirect('/alumni')->with('success', 'Data berhasil dihapus.');
    }



}

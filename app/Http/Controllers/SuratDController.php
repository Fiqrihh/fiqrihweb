<?php

namespace App\Http\Controllers;

use App\Models\SuratK;
use App\Models\Surat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SuratDController extends Controller
{
    public function index(){
    
    $suratMasuk = Surat::all();
    $suratKeluar = SuratK::all();
    $user = Auth::user();
    return view('admin.surat',[
        
        'title' => 'Surat',
        'sk'    => $suratKeluar,
        'sm'    => $suratMasuk,
        'user' => $user
        ]);
    }
    
}

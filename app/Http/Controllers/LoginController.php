<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { 
        $user = Auth::user();
        return view('admin/profile', [
            'title' => 'profile',
            'user' => $user,
            //'surat' => $surat
    
            
        ]);
    }
    public function showLoginForm()
    {
        return view('akun.Adlogin');
    }
     
    public function login(Request $request)
    {
        $cred = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);
        if(Auth::attempt($cred)){
            $request->session()->regenerate();
            return redirect()->intended('/');
        
    }
   
    return back()->with('loginError', 'Login failed!');

}
    public function logoutP(){
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/login');

    }
}
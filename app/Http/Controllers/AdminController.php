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
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        //
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
    public function logout(){
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');

    }
}
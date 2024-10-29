<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MultiUserLogin extends Controller
{
    public function index(){
        return view('akun.loginuser');
    }

    public function __construct()
    {
        $this->middleware('guest:pengajar')->except('logout');
        $this->middleware('guest:santri')->except('logout');
    }

    public function login(Request $request)
{
    $this->validate($request, [
        'username' => 'required', 
        'password' => 'required|min:6',
    ]);

    $credentials = $request->only('username', 'password'); 

    // Coba login sebagai pengajar
    if (Auth::guard('pengajar')->attempt($credentials, $request->remember)) {
        return redirect()->intended(route('pengajar.dashboard'));
    }

    // Coba login sebagai santri
    if (Auth::guard('santri')->attempt($credentials, $request->remember)) {
        return redirect()->intended(route('santri.dashboard'));
    }

    // Jika gagal login
    return redirect()->back()->withInput($request->only('username', 'remember'))->withErrors([
        'username' => 'Username atau password salah.', 
    ]);
}

public function logout(Request $request)
    {
        Auth::guard('pengajar')->logout();
        Auth::guard('santri')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/LoginUser');
    }

}

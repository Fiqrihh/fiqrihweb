<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginUserController extends Controller
{
    public function index(){
        return view('akun.loginuser');
    }
    public function __construct()
    {
        $this->middleware('guest:pengajar')->except('logout');
        $this->middleware('guest:santri')->except('logout');
    }

    public function loginMultiUser(Request $request)
{
    $this->validate($request, [
        'username' => 'required', 
        'password' => 'required|min:6',
    ]);

    $credentials = $request->only('username', 'password'); 

    // Coba login sebagai pengajar
    if (Auth::guard('pengajar')->attempt($credentials, $request->remember)) {
        return redirect()->intended('/pengajar/dashboard');
    }

    // Coba login sebagai santri
    if (Auth::guard('santri')->attempt($credentials, $request->remember)) {
        $santri = Auth::guard('santri')->user();
        
        if ($santri->status !== 'verifikasi') {
            Auth::guard('santri')->logout();
            return redirect()->back()->withInput($request->only('username', 'remember'))->withErrors([
                'username' => 'Akun Anda belum diverifikasi.',
            ]);
        }

        return redirect()->intended(route('santri.dashboard'));
    }


    // Jika gagal login
    return redirect()->back()->withInput($request->only('username', 'remember'))->withErrors([
        'username' => 'Username atau password salah.', 
    ]);
}

public function logout(Request $request)
    {
        if (Auth::guard('pengajar')->check()) {
            Auth::guard('pengajar')->logout(); // Melakukan logout dari guard 'pengajar'
        } elseif (Auth::guard('santri')->check()) {
            Auth::guard('santri')->logout(); // Melakukan logout dari guard 'santri'
        }

        $request->session()->invalidate(); // Mematikan sesi
        $request->session()->regenerateToken(); // Menghasilkan token baru untuk sesi

        return redirect('/LoginUser'); // Mengarahkan kembali ke halaman login
    }


}

<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Pengajarr;
use App\Models\Santri;
use Illuminate\Support\Facades\Hash;

class akunUserController extends Controller
{
    public function indexpengajar(){

        $peng = Pengajarr::all();
        $user = Auth::user();
        $pengaj = Pengajarr::whereNotNull('password')->paginate(4);
        $pengajar =  Pengajarr::orderBy('created_at', 'desc')->cari()->paginate(4);
        return view('admin.akunPengajar',[
            'title' => 'akun pengajar',
            'peng' => $pengajar,
            'user' => $user,
            'pngaja' => $pengaj,
            'pengS' => $peng
        ]);
    }

public function addPengajar(Request $request)
{
    $request->validate([
        'password' => 'required|string|min:6', // Menambahkan aturan validasi min:6 untuk password
    ]);

    try {
        
    $pengajar = Pengajarr::findOrFail($request->namaP);
    $pengajar->password = Hash::make($request->password); // Menghash password baru
    $pengajar->save();

        return redirect('/akun-pengajar')->with('success', 'Data berhasil ditambahkan.');
    } catch (\Exception $e) {
        return redirect('/akun-pengajar')->with('error', 'Gagal mengedit data. Silakan coba lagi.');
    }
}

public function updatePasswordPengajar(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string|min:8',
        ]);

        // Cari pengajar berdasarkan "no_pengajar"
        $pengajar = Pengajarr::where('username', $request->username)->first();

        if ($pengajar) {
            // Update kata sandi
            $pengajar->password = Hash::make($request->password);
            $pengajar->save();

            // Redirect kembali dengan pesan sukses
            return redirect()->back()->with('success', 'Kata sandi berhasil diperbarui.');
        } else {
            // Redirect kembali dengan pesan error
            return redirect()->back()->with('error', 'Pengajar tidak ditemukan.');
        }
    }


    // milik murid

    public function indexMurid(){
        $murid2 = Santri::all();
        $user = Auth::user();
        $murid1 = Santri::whereNotNull('password')->paginate(4);
        $murid =  Santri::orderBy('created_at', 'desc')->cari()->paginate(4);
        return view('admin.akunMurid',[
            'title' => 'akun murid',
            'murid' => $murid,
            'user' => $user,
            'murid2' => $murid2,
            'murid1' => $murid1
        ]);
    }

    
public function addMurid(Request $request)
{
    $request->validate([
        'password' => 'required|string|min:6', // Menambahkan aturan validasi min:6 untuk password
    ]);

    try {
        
    $murid = Santri::findOrFail($request->nama_lengkap);
    $murid->password = Hash::make($request->password); // Menghash password baru
    $murid->save();

        return redirect('/akun-murid')->with('success', 'Data berhasil ditambahkan.');
    } catch (\Exception $e) {
        return redirect('/akun-murid')->with('error', 'Gagal mengedit data. Silakan coba lagi.');
    }
}

public function updatePasswordMurid(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string|min:8',
        ]);

        // Cari pengajar berdasarkan "no_pengajar"
        $pengajar = Santri::where('username', $request->username)->first();

        if ($pengajar) {
            // Update kata sandi
            $pengajar->password = Hash::make($request->password);
            $pengajar->save();

            // Redirect kembali dengan pesan sukses
            return redirect()->back()->with('success', 'Kata sandi berhasil diperbarui.');
        } else {
            // Redirect kembali dengan pesan error
            return redirect()->back()->with('error', 'murid tidak ditemukan.');
        }
    }


    //login pengajar - murid



}

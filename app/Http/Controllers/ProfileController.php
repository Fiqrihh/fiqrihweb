<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;


class ProfileController extends Controller
{

    public function index(){
        $user = Auth::user();
        return view('admin.profile', [
            'title' => ' Halaman Profile',
            'user' => $user
        ]);
    }


    public function editt()
    {   
        $user = Auth::user(); // Dapatkan user yang sedang terautentikasi
        return view('admin.editaku',[
            'title' => 'edit profile',
            'user' => $user
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user(); // Dapatkan user yang sedang terautentikasi
    
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email:dns|min:3|max:255|unique:users,email,'.$user->id,
            'password' => 'nullable|min:5|max:255', // Ubah menjadi nullable karena password tidak selalu diubah
            'fotoAdmin' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|file|max:2048',
        ]);
    
        if ($request->file('fotoAdmin')) {
            $file = $request->file('fotoAdmin');
            $fileName = $file->getClientOriginalName();
            $validatedData['fotoAdmin'] = $file->storeAs('foto-admin', $fileName);
        
            // Hapus foto lama dari penyimpanan
            Storage::delete($user->fotoAdmin);
        
            // Simpan nama file baru ke kolom fotoAdmin
            $user->fotoAdmin = $validatedData['fotoAdmin'];
        }
        
        // Update data user
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        
        // Update password jika diisi
        if (!empty($validatedData['password'])) {
            $user->password = bcrypt($validatedData['password']);
        }
        
        // Simpan perubahan
        $user->save();
    
        return redirect('/')->with('success', 'Profil pengguna berhasil diperbarui');
    }
    


}

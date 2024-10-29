<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;



class RegisterController extends Controller
{
    public function index(){
        return view('akun/register');
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email:dns|min:3|max:255|unique:users',
            'password' => 'required|min:5|max:255',
            'fotoAdmin' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|file|max:2048',
        ]);

        if ($request->file('fotoAdmin')) {
            $file = $request->file('fotoAdmin');
            $fileName = $file->getClientOriginalName();
            $validatedData['fotoAdmin'] = $file->storeAs('foto-admin', $fileName);
        }

        $validatedData['password'] = bcrypt($validatedData['password']);


        User::create($validatedData);
        
        return redirect('/');
    }
}

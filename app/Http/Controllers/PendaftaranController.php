<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Santri;
use App\Models\WaktuPendaftaran;
use App\Models\Pendaftaran;
use App\Http\Requests\StorePendaftaranRequest;
use App\Http\Requests\UpdatePendaftaranRequest;
use Illuminate\Support\Facades\Hash;

class PendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pendaftaran = WaktuPendaftaran::first();

        // Periksa apakah data pendaftaran ada dan statusnya
        if ($pendaftaran && $pendaftaran->status == 'buka') {
            // Jika status 'buka', tampilkan view halamanuser
            return view('akun.halamanuser');
        } else {
            // Jika status 'tutup' atau data tidak ada, tampilkan view pendaftaranClose
            $currentYear = date('Y');
            $nextYear = $currentYear + 1;
            $nextYearDate = "7 Januari $nextYear";
            return view('akun.pendaftaranClose', [
                'nextYearDate' =>$nextYearDate
            ]);
        }
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('akun.halamanuser');
    }


    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|max:255',
            'alamat' => 'required|max:255',
            'tanggal_lahir' => 'required|date',
            'nohp' => 'required|max:15',
            'jenis_kelamin' => 'required|max:20',
            'status' => 'nullable|max:100',
            'fotoSiwa' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'id_kelas' => 'nullable',
            'password' => 'required',
            'username' => 'required',
            'email_murid'=> 'required'
        ]);
    
        // Memeriksa dan menyimpan file foto jika ada yang diunggah
        if ($request->hasFile('fotoSiwa')) {
            $file = $request->file('fotoSiwa');
            $fileName = time() . '_' . $file->getClientOriginalName(); // Menambahkan timestamp untuk memastikan nama unik
            $validatedData['fotoSiwa'] = $file->storeAs('foto-siswa', $fileName,); // Menyimpan file dengan nama yang diinginkan
        }
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Menyimpan data murid ke dalam database
        $murid = Santri::create([
            'nama_lengkap' => $validatedData['nama_lengkap'],
            'alamat' => $validatedData['alamat'],
            'tanggal_lahir' => $validatedData['tanggal_lahir'],
            'nohp' => $validatedData['nohp'],
            'jenis_kelamin' => $validatedData['jenis_kelamin'],
            'status' => $validatedData['status'],
            'fotoSiwa' => $fileName, // Menyimpan path file ke database
            'username' => $validatedData['username'],
            'password' => $validatedData['password'], // Diisi oleh admin
            'email_murid' => $validatedData['email_murid'],
            'id_kelas' => $validatedData['id_kelas']
        ]);
    
        // Menyimpan bahwa pendaftaran selesai dalam session
        session(['pendaftaran_selesai' => true]);
    
        // Mengembalikan view dengan data murid yang baru dibuat
        return view('akun.halamanuserr', ['murid' => $murid]);
    }
    


    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {    
    //     $request->validate([
    //         'nama_lengkap' => 'required',
    //         'alamat' => 'required',
    //         'tanggal_lahir' => 'required',
    //         'nohp' => 'required',
    //         'kelass' => 'required',
    //         'jenis_kelamin' => 'required',
    //         'fotoSiwa' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //     ]);
         
    //     $murid = Santri::create([
    //         'nama_lengkap' => $request->input('nama_lengkap'),
    //         'alamat' => $request->input('alamat'),
    //         'tanggal_lahir' => $request->input('tanggal_lahir'),
    //         'nohp' => $request->input('nohp'),
    //         'kelass' => $request->input('kelass'),
    //         'jenis_kelamin' => $request->input('jenis_kelamin'),
    //     ]);

    //     session(['pendaftaran_selesai' => true]);

    //     return view('akun.halamanuserr', ['murid' => $murid]);
        
    // }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $usr = Santri::all();
        return view('akun.halamauserr', [
            'user' => $usr
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pendaftaran $pendaftaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePendaftaranRequest $request, Pendaftaran $pendaftaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pendaftaran $pendaftaran)
    {
        //
    }
}

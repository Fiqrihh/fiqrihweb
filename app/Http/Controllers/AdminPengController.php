<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\pengajarr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminPengController extends Controller
{
    public function index(){

        $pengajar = Pengajarr::all();
       $user = Auth::user();
       $peng =  Pengajarr::orderBy('created_at', 'desc')->cari()->paginate(4);
       $jenis_kelamin_options = Pengajarr::distinct()->pluck('jenis_kelaminP');

        return view('Admin/pengajar',[
            'title' => 'data pengajar',
            'peng' => $peng,
            'user' =>$user,
            'pen' => $pengajar,
            'Jk_options' => $jenis_kelamin_options, // Kirim nilai ke view
        ]);
    }

    public function store(Request $request)
    {    $request->validate([
        'password' => 'required|string|min:6', // Menambahkan aturan validasi min:6 untuk password
    ]);

    try {
        $baru = new Pengajarr();
        $data = $request->only($baru->getFillable());
        $baru->namaP = $data['namaP'];
        $baru->Alamat = $data['Alamat'];
        $baru->tgl_lahirP = $data['tgl_lahirP'];
        $baru->No_hp_pengajar = $data['No_hp_pengajar'];
        $baru->jenis_kelaminP = $data['jenis_kelaminP'];
        $baru->username = $data['username'];
        $baru->password = Hash::make($data['password']); // Menghash password baru
        $baru->save();
        
        return redirect('/data-pengajar')->with('success', 'Data berhasil ditambahkan.');
    } catch (\Exception $e) {
        return redirect('/data-pengajar')->with('error', 'Gagal menambahkan data. Silakan coba lagi.');
    }
        

    }

    public function updatee(Request $request, string $id)
    {
        try {
            $peng = Pengajarr::findOrFail($id);
    
            // Mengupdate data pengeluaran
            $peng->namaP = $request->input('namaP');
            $peng->Alamat = $request->input('Alamat');
            $peng->tgl_lahirP = $request->input('tgl_lahirP');
            $peng->No_hp_pengajar = $request->input('No_hp_pengajar');
            $peng->jenis_kelaminP = $request->input('jenis_kelaminP');
            $peng->username = $request->input('username');

            $peng->save();
    
            return redirect('/data-pengajar')->with('success', 'Data berhasil diedit.');
        } catch (\Exception $e) {
            return redirect('/data-pengajar')->with('error', 'Gagal mengedit data. Silakan coba lagi.');
        }
    }

    public function destroy($id)
    {
        $angkatan = Pengajarr::findOrFail($id);
        $angkatan->delete();

        return redirect('/data-pengajar')->with('success', 'Data berhasil dihapus.');
    }

    public function storeAkunpengajar(Request $request)
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


        pengajarr::create($validatedData);
        
        return redirect('/');
    }
        


}

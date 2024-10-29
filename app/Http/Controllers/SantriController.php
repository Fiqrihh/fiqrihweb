<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Models\Santri;
use App\Models\Admin;
use App\Models\Kelas;
use App\Models\kategori;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSantriRequest;
use App\Http\Requests\UpdateSantriRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifikasiMuridMail;
use App\Mail\KuotaPenuh;
use App\Models\WaktuPendaftaran;

class SantriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        // Mengambil data santri dari database
        $user = Auth::user();
        $uang = Pemasukan::all();

        $totalPengeluaran = $uang->sum('pengeluaran');
        $totalPemasukan = $uang->sum('pemasukan');
        $sisaUang = $totalPemasukan - $totalPengeluaran;

        $murid = Santri::all();
        $jumlahBaris = Santri::count();
        return view('admin/dashboard', [
        'jumlah' => $jumlahBaris,
        'mrd'   => $murid,
        'duid' => $uang,
        'title' => 'Dashboard',
        'tPengeluaran' => $totalPengeluaran,
        'tPemasukan' => $totalPemasukan,
        'sisa_d' => $sisaUang,
        'user' => $user
]);
       

    }
    public function index1()
    {   
        $user = Auth::user();
        $murid1 =  Santri::all();
        $murid =  Santri::count();
        // $murid2 = Santri::orderBy('created_at', 'desc')->Cari()->paginate(3);
        // $murid2 = Santri::join('kelas', 'santris.id_kelas', '=', 'kelas.id_kelas')
        // ->select('santris.*', 'kelas.n_kelas')
        // ->orderByDesc('santris.id_murid')
        // ->Cari()
        // ->paginate(3);
        $murid2 = Santri::join('kelas', 'santris.id_kelas', '=', 'kelas.id_kelas')
        ->select('santris.*', 'kelas.n_kelas')
        ->orderByDesc('santris.created_at') // Urutkan berdasarkan waktu pendaftaran (terbaru)
        ->orderByRaw("FIELD(status, 'belum_verifikasi', 'verifikasi', 'ditolak')") // Urutkan berdasarkan status
        ->Cari()
        ->paginate(3);
        $kelasOptions = Kelas::all();

        $pendaftaran = WaktuPendaftaran::all();
    
        return view('admin/murid', [
            'pelajarJ' => $murid2,
            'title' => 'Data Murid',
            'pelajar' => $murid1,
            'user'    => $user,
            'kelas'   => $kelasOptions,
            'wp'     => $pendaftaran
            
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
        $baru = new Santri();
        $data = $request->only($baru->getFillable());

        $baru->nama_lengkap = $data['nama_lengkap'];
        $baru->alamat = $data['alamat'];
        $baru->nohp = $data['nohp'];
        $baru->jenis_kelamin = $data['jenis_kelamin'];
        $baru->kelass = $data['kelass'];
        $baru->tanggal_lahir = $data['tanggal_lahir'];
        $baru->status = $data['status'] ?? 'belum_verifikasi'; // Set default status jika tidak ada
        $baru->username = $data['username'] ?? null; // Set default nomor_murid jika tidak ada
     
        

        $baru->save();
        return redirect('/murid');

    }

    /**
     * Display the specified resource.
     */
    public function show(Santri $santri)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string  $id)
    {   
        $user = Auth::user();
        $siswa = Santri::all();
        $kelasOptions = Kelas::all();
        return view('admin/editsiswa', Santri::findOrFail($id)->toArray(),[
                    'data' => $siswa,
                    'title' => 'edit data siswa',
                    'user'  => $user,
                    'kelas' => $kelasOptions
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {try {

        $murid = Santri::findOrFail($id);
    
        // Mengupdate data murid
        $murid->nama_lengkap = $request->input('nama_lengkap');
        $murid->alamat = $request->input('alamat');
        $murid->nohp = $request->input('nohp');
        $murid->jenis_kelamin = $request->input('jenis_kelamin');
        $murid->tanggal_lahir = $request->input('tanggal_lahir');
        $murid->status = $request->input('status');
        $murid->username = $request->input('username');
        $murid->id_kelas = $request->input('id_kelas');

        $murid->save();
    
        // Hapus data pemasukan jika status tidak diverifikasi
        if ($request->input('status') == 'belum_verifikasi') {
            Pemasukan::where('nama', $murid->nama_lengkap)->delete();
            Log::info('Data pemasukan berhasil dihapus untuk murid: ' . $murid->nama_lengkap);
        } else if ($request->input('status') == 'verifikasi') {
            $kategoriId = 3; // ID kategori default
    
            $pemasukan = new Pemasukan();
            $pemasukan->nama = $murid->nama_lengkap;
            $pemasukan->jumlah_pem = 100000; // Harga default
            $pemasukan->tanggal_pem = $murid->updated_at->format('Y-m-d'); // Tanggal update_at murid
            $pemasukan->id_kategori = $kategoriId;
            $pemasukan->save();
            Log::info('Data pemasukan berhasil ditambahkan: ' . $pemasukan);
        }
    
            return redirect('/murid')->with('success', 'Data berhasil diedit.');
        } catch (\Exception $e) {
            return redirect('/murid')->with('error', 'Gagal mengedit data. Silakan coba lagi.');
        }

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        try {
            // Ambil data santri yang ingin dihapus
            $santri = Santri::findOrFail($id);
            
            // Simpan data santri ke dalam tabel alumni
            $alumni = new Admin();
            $alumni->nama_lengkap = $santri->nama_lengkap;
            $alumni->alamat = $santri->alamat;
            $alumni->nohp = $santri->nohp;
            $alumni->jenis_kelamin = $santri->jenis_kelamin;
            $alumni->kelass = $santri->kelass;
            $alumni->tanggal_lahir = $santri->tanggal_lahir;

            // Lanjutkan dengan atribut lain yang sesuai
            
            $alumni->save();
    
            // Hapus data santri setelah disalin ke tabel alumni
            $santri->delete(); 
    
            return redirect('/murid')->with('success', 'Data berhasil dihapus dan dipindahkan ke alumni.');
        } catch (\Exception $e) {
            return redirect('/murid')->with('error', 'Gagal menghapus data. Silakan coba lagi.');
        }
    }

    public function verif(Request $request, $id)
    {
        try {
            // Ambil data siswa yang ingin diverifikasi
            $siswa = Santri::findOrFail($id);
    
            // Verifikasi kelas
            $siswa->verifikasi = true;
            $siswa->save();
    
            // Input data pemasukan otomatis dengan nama kategori "pendaftaran"
            $kategoriPendaftaran = Kategori::where('nama_kategori', 'pendaftaran')->first();
            
            if ($kategoriPendaftaran) {
                $uang = new Pemasukan();
                $uang->nama = $siswa->nama_lengkap;
                $uang->nominal = 100000;
                $uang->tanggal = now();
                $uang->kategori_id = 3;
                $uang->save();
                return redirect('/murid');
            }
    
            return response()->json(['message' => 'Verifikasi kelas berhasil. Data pemasukan otomatis telah diinput.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal melakukan verifikasi kelas. Silakan coba lagi.']);
        }
    }

    public function verifikasi($id) {
 $murid = Santri::find($id);
    $kelasId = $murid->id_kelas;

    // Jika kelas adalah kelas dengan id_1
    if ($kelasId == 1) {
        $jumlahVerifikasi = Santri::where('id_kelas', 1)->where('status', 'Verifikasi')->count();
        
        
        // Jika jumlah verifikasi sudah 30 orang, tampilkan pesan
        if ($jumlahVerifikasi >= 30) {
            return redirect()->back()->with('error', 'Kelas penuh. Tidak dapat menambahkan murid baru.');
        }
    }

    // Verifikasi murid
    $murid->status = 'verifikasi';
    $murid->save();

    Mail::to($murid->email_murid)->send(new VerifikasiMuridMail($murid));


        return redirect()->back()->with('success', 'Murid berhasil diverifikasi.');
    }
    
    public function tidakVerivikasi($id) {
        $murid = Santri::findOrFail($id);
        $murid->status = 'ditolak'; // atau sesuai dengan status yang diinginkan
        $murid->save();
    
        Mail::to($murid->email_murid)->send(new KuotaPenuh($murid));

        return redirect()->back()->with('error', 'Murid tidak diverifikasi.');
    }


}

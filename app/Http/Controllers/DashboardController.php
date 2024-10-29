<?php

namespace App\Http\Controllers;


use DateTime;
use App\Models\Keuangan;
use App\Models\Pemasukan;
use App\Models\Santri;
use App\Models\Pengeluaran;
use App\Models\Surat;
use App\Models\SuratK;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreKeuanganRequest;
use App\Http\Requests\UpdateKeuanganRequest;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $today = Carbon::now();

        $bulan_names = [
            'January', 'February', 'March', 'April', 'May', 'June', 'July',
            'August', 'September', 'October', 'November', 'December'
        ];
        
    
        $hasil_pemasukan = DB::select("
    SELECT
        COALESCE(SUM(jumlah_pem), 0) as jumlah_pem,
        MONTHNAME(tanggal_pem) as bulan
    FROM
        pemasukans
    GROUP BY
        MONTHNAME(tanggal_pem)
    ORDER BY
        MONTH(tanggal_pem) ASC
");
$hasil_pengeluaran = DB::select("
    SELECT
        COALESCE(SUM(jumlah_peng), 0) as jumlah_peng,
        MONTHNAME(tanggal_peng) as bulan
    FROM
        pengeluarans
    GROUP BY
        MONTHNAME(tanggal_peng)
    ORDER BY
        MONTH(tanggal_peng) ASC
");


    $grafik_data = [
        'jumlah_pemasukan' => array_column($hasil_pemasukan, 'jumlah_pem'),
        'jumlah_pengeluaran' => array_column($hasil_pengeluaran, 'jumlah_peng'),
        'bulan' =>  $bulan_names, 
    ];
 

        $user = Auth::user();
        $suratM = Surat::count();
        $suratK = SuratK::count();
        $pendapatan = Pemasukan::all();
        $beli       = Pengeluaran::all();
        $cuan       = $pendapatan->sum('jumlah_pem');
        $rugi       = $beli->sum('jumlah_peng');
        $sisaUang   = $cuan - $rugi;
        $murid = Santri::all();
        $jumlahBaris = Santri::count();
        return view('admin/dashboard', [
            'jumlah'       => $jumlahBaris,
            'mrd'          => $murid,
            'title'        => 'dashboard',
            'pendapatan'   => $pendapatan,
            'beli'         => $beli, 
            'tPengeluaran' => $rugi,
            'tPemasukan'   => $cuan,
            'sisa_d'       => $sisaUang,
            'user'        => $user,
            'suratm'      => $suratM,
            'suratk'      => $suratK,
            'grafik_data' => $grafik_data,
            
        ]); 

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $uang = Keuangan::all();
        return view('admin/transaksii', [
            'fulus' => $uang,
            'title' =>'semua transaksi'
        ]);
    }
    


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $trans = new Keuangan();
        $data = $request->only($trans->getFillable());
        $trans->namaT = $data['namaT'];
        $trans->pengeluaran = $data['pengeluaran'];
        $trans->pemasukan = $data['pemasukan'];
        $trans->tanggal = $data['tanggal'];
        $trans->save();
        return redirect('/transaksi');
    }

    /**
     * Display the specified resource.
     */
    public function show(Keuangan $keuangan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Keuangan $keuangan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    $transaksi = Keuangan::findOrFail($id);

    $request->validate([
        'namaT' => 'required',
        'pengeluaran' => 'required',
        'pemasukan' => 'required',
        'tanggal' => 'required', 
    ]);


    $transaksi->namaT = $request->input('namaT');
    $transaksi->pengeluaran = $request->input('pengeluaran');
    $transaksi->pemasukan = $request->input('pemasukan');
    $transaksi->tanggal = $request->input('tanggal');
    $transaksi->save();

    // Redirect ke halaman transaksi dengan pesan sukses
    return redirect('/transaksi')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $keuangan = Keuangan::findOrFail($id);
        $keuangan->delete(); 

        return redirect('/transaksi')->with('success', 'Data berhasil dihapus.');
    }
  
    private function transformData()
    {   
        $jumlah_pem = Pemasukan::select(DB::raw("CAST(SUM(jumlah_pem) as int)as jumlah_pem"))
        ->GroupBy(DB::raw("Month(created_at)"))
        ->pluck('jumlah_pem');
        $bulan= Pemasukan::select(DB::raw("MONTHNAME(created_at) as bulan"))
        ->GroupBy(DB::raw("MONTHNAME(created_at)"))
        ->pluck('bulan');
    }
    
}

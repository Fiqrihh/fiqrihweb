<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Pengeluaran;
use App\Models\Pemasukan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class rekaAdController extends Controller
{ 

    public function index(Request $request)
{
    $user = Auth::user();
    $pem = Pemasukan::all();

    $bulanIndonesia = [
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember'
    ];

    // Ambil nilai bulan dan tahun dari permintaan HTTP
    $bulan = $request->input('bulan');
    $tahun = $request->input('tahun');

    // Ambil data bulan dari database
    $bulanDatabase = Pemasukan::select(DB::raw('MONTH(tanggal_pem) AS bulan'))
                                ->distinct()
                                ->orderBy('bulan', 'ASC')
                                ->pluck('bulan');

    // Ambil data tahun dari database
    $tahunDatabase = Pemasukan::select(DB::raw('YEAR(tanggal_pem) AS tahun'))
                                ->distinct()
                                ->orderBy('tahun', 'ASC')
                                ->pluck('tahun');

    // Query untuk memfilter data berdasarkan bulan dan tahun
    $totalPemasukan = Pemasukan::select(
        DB::raw('YEAR(tanggal_pem) AS tahun'),
        DB::raw('MONTH(tanggal_pem) AS bulan'),
        DB::raw('SUM(jumlah_pem) AS total_pemasukan')
    );

    $totalPengeluaran = Pengeluaran::select(
        DB::raw('YEAR(tanggal_peng) AS tahun'),
        DB::raw('MONTH(tanggal_peng) AS bulan'),
        DB::raw('SUM(jumlah_peng) AS total_pengeluaran')
    );

    // Filter data berdasarkan bulan dan tahun jika tersedia
    if ($bulan && $tahun) {
        $totalPemasukan->whereMonth('tanggal_pem', $bulan)->whereYear('tanggal_pem', $tahun);
        $totalPengeluaran->whereMonth('tanggal_peng', $bulan)->whereYear('tanggal_peng', $tahun);
    }

    // Lakukan pengelompokan dan paginasi seperti biasa
    $totalPemasukan = $totalPemasukan->groupBy('tahun', 'bulan')->paginate(5);
    $totalPengeluaran = $totalPengeluaran->groupBy('tahun', 'bulan')->paginate(5);

    return view('admin/rekap', [
        'title' => 'rekap bulanan',
        'totalPengeluaran'  => $totalPengeluaran,
        'totalPemasukan'   => $totalPemasukan,
        'bulanIndonesia' => $bulanIndonesia,
        'bulanDatabase' => $bulanDatabase,
        'tahunDatabase' => $tahunDatabase,
        'user'             => $user,
        'pem'       => $pem, 
    ]);
}

public function printRekap(Request $request)
{
    $bulan = $request->bulan;
    $tahun = $request->tahun;
    $bulanIndonesia = [
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember'
    ];


    $pemasukan = Pemasukan::with('kategori')
    ->whereYear('tanggal_pem', $tahun)
    ->whereMonth('tanggal_pem', $bulan)
    ->get();
    $pengeluaran = Pengeluaran::with('kategori')
    ->whereYear('tanggal_peng', $tahun)
    ->whereMonth('tanggal_peng', $bulan)
    ->get();

    $totalPemasukan = Pemasukan::whereYear('tanggal_pem', $tahun)
        ->whereMonth('tanggal_pem', $bulan)
        ->sum('jumlah_pem');

    $totalPengeluaran = Pengeluaran::whereYear('tanggal_peng', $tahun)
        ->whereMonth('tanggal_peng', $bulan)
        ->sum('jumlah_peng');

    $pdf = PDF::loadView('admin.print_rekap', [
        'bulan' => $bulan,
        'tahun' => $tahun,
        'bulanIndonesia' => $bulanIndonesia,
        'pemasukan' => $pemasukan,
        'pengeluaran' => $pengeluaran,
        'totalPemasukan' => $totalPemasukan,
        'totalPengeluaran' => $totalPengeluaran
    ]);
    return $pdf->stream('rekap_'.$bulan.'_'.$tahun.'.pdf');
    //return $pdf->download('rekap_'.$bulan.'_'.$tahun.'.pdf');
}


        

    public function destroy( $id)
    {
        
        $siswa = Admin::findOrFail($id);
        $siswa->delete(); 

        return redirect('/alumni')->with('success', 'Data berhasil dihapus.');
    }



}
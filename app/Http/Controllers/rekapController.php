<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemasukan;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF; 
use Dompdf\Dompdf;


class rekapController extends Controller
{
    public function index(Request $request)
    {
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
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        $bulanDatabase = Pemasukan::select(DB::raw('MONTH(tanggal_pem) AS bulan'))
                                ->distinct()
                                ->orderBy('bulan', 'ASC')
                                ->pluck('bulan');
        $tahunDatabase = Pemasukan::select(DB::raw('YEAR(tanggal_pem) AS tahun'))
                                ->distinct()
                                ->orderBy('tahun', 'ASC')
                                ->pluck('tahun');

        $untung = Pemasukan::join('kategoris', 'pemasukans.id_kategori', '=', 'kategoris.id_kategori')
        ->select('pemasukans.*', 'kategoris.nama_kategori')
        ->whereIn('pemasukans.id_kategori', [3, 4]) // Menambahkan kondisi WHERE untuk kategori_id 3 dan 4
        ->orderByDesc('pemasukans.id');


        if ($bulan && $tahun) {
            $untung->whereMonth('tanggal_pem', $bulan)->whereYear('tanggal_pem', $tahun);
        }

        $untung = $untung->paginate(5);
    
    $user = Auth::user();
    $kategori = Kategori::all();
    $totd = Pemasukan::all();
    $totalData = Pemasukan::count();
    $masuk = Pemasukan::paginate(10);
    $itemsPerPage = 10; // Jumlah data yang ingin ditampilkan per halaman
    $totalPages = ceil($totalData / $itemsPerPage);
    
    $peng = Pemasukan::all();
    
    return view('admin/rekapPembayaran', [
        'title' => 'rekap Pembayaran Siswa',
        'masuk' => $untung,
        'kate' => $kategori,
        'user' =>$user,
        'bulanIndonesia' => $bulanIndonesia,
        'bulanDatabase' => $bulanDatabase,
        'tahunDatabase' => $tahunDatabase,
    ]);
    
    }

    public function store(Request $request)
    {
       
        $baru = new Pemasukan();
        $data = $request->only($baru->getFillable());
        $baru->nama = $data['nama'];
        $baru->jumlah_pem  = $data['jumlah_pem'];
        $baru->tanggal_pem = $data['tanggal_pem'];
        $baru->id_kategori =  $data['id_kategori'];
        $baru->save();

        return redirect()->route('cetak_pdf', $baru->id);

        return redirect('/rekap');
    }

    
public function cetakPDF($id)
{
    $baru = Pemasukan::findOrFail($id);

    // Buat PDF
    $pdf = PDF::loadView('admin/bukti_pembayaran_pdf', compact('baru'));
    
    // Return PDF untuk dicetak
    return $pdf->stream('admin/bukti_pembayaran.pdf');
}

}

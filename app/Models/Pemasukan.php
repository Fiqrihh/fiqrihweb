<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemasukan extends Model
{
    use HasFactory;
    protected $table = 'pemasukans';
    protected $fillable = ['nama','jumlah_pem','tanggal_pem','id_kategori'];

    public function relatedModel()
    {
        return $this->belongsTo(Kategori::class , 'id_kategori');
    }


    public function scopeCari($query)
    {
        if (request('cari')) {
            return $query
                ->where('nama', 'like', '%' . request('cari') . '%')
                ->orWhere('jumlah_pem', 'like', '%' . request('cari') . '%')
                ->orWhere('tanggal_pem', 'like', '%' . request('cari') . '%')
                ->orWhereHas('relatedModel', function ($q) {
                    $q->where('nama_kategori', 'like', '%' . request('cari') . '%');
                });
        }
    }


    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function scopeCari2($query)
{
    if (request('cari')) {
        $cari = request('cari');

        // Daftar nama bulan yang diterima
        $namaBulan = [
            'januari' => '1',
            'februari' => '2',
            'maret' => '3',
            'april' => '4',
            'mei' => '5',
            'juni' => '6',
            'juli' => '7',
            'agustus' => '8',
            'september' => '9',
            'oktober' => '10',
            'november' => '11',
            'desember' => '12'
        ];

        // Pisahkan kata kunci pencarian menjadi array kata
        $kataKunci = explode(' ', strtolower($cari));

        // Inisialisasi variabel bulan dan tahun
        $bulan = null;
        $tahun = null;

        // Periksa setiap kata kunci
        foreach ($kataKunci as $kunci) {
            // Jika kata kunci adalah nama bulan yang valid
            if (array_key_exists($kunci, $namaBulan)) {
                $bulan = $namaBulan[$kunci];
            } elseif (is_numeric($kunci) && strlen($kunci) == 4) {
                // Jika kata kunci adalah tahun
                $tahun = $kunci;
            }
        }

        // Lakukan query berdasarkan bulan dan tahun jika keduanya ditemukan
        if ($bulan) {
            $query->whereMonth('tanggal_pem', $bulan);
                 
        }
        if ($tahun) {
            $query->whereYear('tanggal_pem', $tahun);
                  
        }
    }

    return $query;
}


}

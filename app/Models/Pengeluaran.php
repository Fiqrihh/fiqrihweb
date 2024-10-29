<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    use HasFactory;
    protected $table = 'pengeluarans';
    protected $fillable = ['nama','jumlah_peng','tanggal_peng','id_kategori'];

    public function relatedModel()
    {
        return $this->belongsTo(Kategori::class , 'id_kategori');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }
    public function scopeCari($query)
    {
        if (request('cari')) {
            return $query
                ->where('nama', 'like', '%' . request('cari') . '%')
                ->orWhere('jumlah_peng', 'like', '%' . request('cari') . '%')
                ->orWhere('tanggal_peng', 'like', '%' . request('cari') . '%')
                ->orWhereHas('relatedModel', function ($q) {
                    $q->where('nama_kategori', 'like', '%' . request('cari') . '%');
                });
        }
    }

}

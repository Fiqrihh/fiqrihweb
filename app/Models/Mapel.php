<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    protected $table = 'mapels';
    protected $fillable = ['id_pengajar','nama_mapel','id_kelas'];
    protected $primaryKey = 'id_mapel';

    public function pengajar()
    {
        return $this->belongsTo(Pengajarr::class, 'id_pengajar', 'id_pengajar');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    public function materii()
    {
        return $this->hasMany(Materii::class, 'id_mapel');
    }

    public function tugas()
    {
        return $this->hasMany(Tugas::class, 'id_mapel', 'id_mapel');
    }

    public function murid(){

        return $this->hasmany(Santri::class, 'id_murid', 'id_murid');
    }

    
    public function jawabanTugas()
    {
        return $this->hasMany(JawabanTugas::class, 'id_mapel', 'id_mapel');
    }
    public function ujian()
    {
        return $this->hasMany(Ujian::class, 'id_mapel'); // Sesuaikan dengan nama foreign key yang benar
    }


    public function scopeCari($query)
    {
        if (request('cari')) {
            return $query
                ->where('nama_mapel', 'like', '%' . request('cari') . '%')
                ->orWhereHas('pengajar', function ($query) {
                    $query->where('namaP', 'like', '%' . request('cari') . '%');
                });
        }
    }

    use HasFactory;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawabanUjian extends Model
{
    protected $table = 'jawaban_ujians';
    protected $primaryKey = 'id_jawabanUjian';
    protected $fillable = ['id_mapel','id_ujian','id_murid','id_kelas','student_ans','nilai_ujian'];

    use HasFactory;

    
    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'id_mapel', 'id_mapel');
    }
    public function ujians()
    {
        return $this->belongsTo(Ujian::class, 'id_ujian',  'id_ujian');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }
    public function siswa()
    {
        return $this->belongsTo(Santri::class, 'id_murid');
    }
    public function ujian()
    {
        return $this->belongsTo(Ujian::class, 'id_ujian');
    }

    public function murid()
    {
        return $this->belongsTo(Santri::class, 'id_murid', 'id_murid');
    }

    public function scopeCari($query, $id_murid) {
        if (request('cari')) {
            $query->where('id_murid', $id_murid)
                ->whereHas('mapel', function ($query) {
                    $query->where('nama_mapel', 'like', '%' . request('cari') . '%');
                });
        }
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jawabanTugas extends Model
{
    protected $table = 'jawaban_tugas';
    protected $primaryKey = 'id_jawabanTugas';
    protected $fillable = ['id_mapel','id_tugas','id_murid','id_kelas','jawaban_text','jawaban_file','nilai_tugas'];

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'id_mapel', 'id_mapel');
    }

    public function tugas()
    {
        return $this->belongsTo(Tugas::class, 'id_tugas',  'id_tugas');
    }

    public function murid()
    {
        return $this->belongsTo(Santri::class, 'id_murid', 'id_murid');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }
   

    use HasFactory;
}

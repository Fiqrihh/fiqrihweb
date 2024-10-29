<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiTugas extends Model
{
    protected $table = 'nilai_tugas';
    protected $fillable = ['id_mapel','id_tugas','id_murid','id_kelas','id_jawabanTugas','nilai_tugas'];
    protected $primaryKey = 'id_nilaiTugas';

    
    use HasFactory;
}

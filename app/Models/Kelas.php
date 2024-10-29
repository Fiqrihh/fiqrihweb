<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{

    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'id_kelas');
    }

    public function murid()
    {
        return $this->hasMany(Santri::class, 'id_kelas');
    }

    public function mapel() {
        return $this->hasMany(Mapel::class, 'id_kelas');
    }

    public function jawabanTugas()
    {
        return $this->hasMany(JawabanTugas::class, 'id_tugas', 'id_tugas');
    }

    public function ujians() {
        return $this->hasMany(Ujian::class, 'id_kelas');
    }

    protected $table = 'kelas';
    protected $fillable = ['n_kelas'];
    protected $primaryKey = 'id_kelas';

    
    use HasFactory;
    
}

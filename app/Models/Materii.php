<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materii extends Model
{
    use HasFactory;
    protected $table = 'materiis';
    protected $primaryKey = 'id_materi';
    protected $fillable = ['judul_materi','deskripsi','konten','video_url','gambar_url','id_mapel'];

    public function scopeCari($query){
        if(request('cari'))
        {
           return $query->where('judul_materi','like','%'.request('cari').'%');
        }
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'id_mapel');
    }

}

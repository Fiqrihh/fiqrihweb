<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;

    protected $table = 'surats';
    protected $fillable = ['pengirim','nomorSuratM','judulSuratM','isiSuratM','tglSuratM','fileSuratM'];
    public function scopeCari($query){
        if(request('cari'))
        {
           return $query->where('pengirim','like','%'.request('cari').'%')
            ->orWhere('nomorSuratM','like','%'.request('cari').'%')
            ->orWhere('judulSuratM','like','%'.request('cari').'%')
            ->orWhere('tglSuratM','like','%'.request('cari').'%');
        }
    }

}

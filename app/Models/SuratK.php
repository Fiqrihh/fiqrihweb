<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratK extends Model
{
    use HasFactory;
    protected $table = 'surat_k_s';
    protected $fillable = ['penerima','nomorSuratK','judulSuratK','isiSuratK','tglSuratK','fileSuratK', 'tempat'];

    public function scopeCari($query){
        if(request('cari'))
        {
           return $query->where('penerima','like','%'.request('cari').'%')
            ->orWhere('nomorSuratK','like','%'.request('cari').'%')
            ->orWhere('tglSuratK','like','%'.request('cari').'%')
            ->orWhere('tempat','like','%'.request('cari').'%')
            ->orWhere('fileSuratK','like','%'.request('cari').'%');
        }
    }
}

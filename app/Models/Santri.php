<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Santri extends Authenticatable
{
    
    protected $table = 'santris';
    protected $fillable = ['nama_lengkap','alamat','nohp','jenis_kelamin','tanggal_lahir','kelass','fotoSiwa', 'username','status', 'password','id_kelas','email_murid'];
    protected $primaryKey = 'id_murid'; // Sesuaikan dengan nama primary key yang sesuai dengan tabel Anda

    public function kelas()
{
    return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
}

// Santri (Murid) model
public function kelass()
{
    return $this->belongsTo(Kelas::class, 'id_kelas');
}


public function Mapel(){
    return $this->hasMany(Mapel::class, 'id_murid', 'id_murid');
}

public function jawaban_ujian()
{
    return $this->hasMany(JawabanUjian::class, 'id_murid');
}

public function jawabanUjian(){
    return $this->hasMany(JawabanUjian::class,'id_murid', 'id_murid');
}
public function jawabanTugas()
{
    return $this->hasMany(JawabanTugas::class, 'id_murid', 'id_murid');
}


    public function scopeCari($query){
        if(request('cari'))
        {
           return $query->where('nama_lengkap','like','%'.request('cari').'%')
            ->orWhere('alamat','like','%'.request('cari').'%')
            ->orWhere('jenis_kelamin','like','%'.request('cari').'%')
            ->orWhere('tanggal_lahir','like','%'.request('cari').'%')
            ->orWhereHas('kelas', function ($query) {
                $query->where('n_kelas', 'like', '%'.request('cari').'%');
            });
        }
    }

    


    use HasFactory;


}


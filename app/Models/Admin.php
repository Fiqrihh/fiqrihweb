<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'admins';
    protected $fillable = ['nama_lengkap','alamat','nohp','jenis_kelamin','kelass','tanggal_lahir'];

    public function scopeCari($query){
        if(request('cari'))
        {
           return $query->where('nama_lengkap','like','%'.request('cari').'%')
            ->orWhere('alamat','like','%'.request('cari').'%')
            ->orWhere('jenis_kelamin','like','%'.request('cari').'%')
            ->orWhere('tanggal_lahir','like','%'.request('cari').'%');
        }
    }


}

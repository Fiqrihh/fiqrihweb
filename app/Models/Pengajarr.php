<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajarr extends Authenticatable
{
    
    protected $table = 'pengajarrs';
    protected $fillable = ['namaP','tgl_lahirP','Alamat','No_hp_pengajar','jenis_kelaminP','username','fotoPengajar','password','email_pengajar'];
    protected $primaryKey = 'id_pengajar';

    public function mapels()
    {
        return $this->hasMany(Mapel::class, 'id_pengajar');
    }

    public function ujians() {
        return $this->hasMany(Ujian::class, 'id_mapel');
    }

    public function scopeCari($query)
    {
        if (request('cari')) {
            return $query
                ->where('namaP', 'like', '%' . request('cari') . '%')
                ->orWhere('no_pengajar', 'like', '%' . request('cari') . '%');           
        }
    }


    use HasFactory;
}



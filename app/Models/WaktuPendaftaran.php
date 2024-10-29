<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaktuPendaftaran extends Model
{
    protected $table = 'waktu_pendaftarans';
    protected $fillable = ['status', 'teks_pendaftaran'];
    protected $primaryKey = 'id_Wpendaftaran';
    use HasFactory;

}

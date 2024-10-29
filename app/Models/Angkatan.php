<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Angkatan extends Model
{
    use HasFactory;
    protected $table = 'angkatans';
    protected $fillable = ['tahun','bulan'];
    protected $primaryKey = 'id_angkatan';

    public function scopeCari($query)
    {
        if (request('cari')) {
            return $query
                ->where('tahun', 'like', '%' . request('cari') . '%')
                ->orWhere('bulan', 'like', '%' . request('cari') . '%');           
        }
    }

}

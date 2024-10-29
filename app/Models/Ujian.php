<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ujian extends Model
{ 
    protected $table = 'ujians';
    protected $fillable = ['id_kelas','id_mapel','waktu_mulai','waktu_berakhir','deskripsi','pertanyaan','created_at'];
    protected $primaryKey = 'id_ujian';
 

    public function scopeCari($query){
        if(request('cari'))
        {
           return $query->where('deskripsi','like','%'.request('cari').'%');
        }
    }
   
    
public function siswaSudahMengerjakanWithNilaiujian()
{
    $jawabanUjian = $this->jawabanUjian()->where('nilai_ujian', '>', 0)->pluck('id_murid');

    return Santri::with(['jawabanUjian' => function ($query) {
            $query->where('id_ujian', $this->id_ujian);
        }])
        ->whereIn('id_murid', $jawabanUjian)
        ->get();
}

    public function siswaSudahMengerjakanujian()
    {
        $jawabanTugas = $this->jawabanUjian()->pluck('id_murid');

        return Santri::with(['jawabanUjian' => function ($query) {
            $query->where('id_ujian', $this->id_ujian);
        }])
        ->whereIn('id_murid', $jawabanTugas)
        ->get();
    }

    public function siswaBelumMengerjakanujian()
    {
        $jawabanUjian = $this->jawabanUjian()->pluck('id_murid');

        return Santri::with('jawabanUjian')
            ->whereNotIn('id_murid', $jawabanUjian)
            ->get();
    }


    public function jawabanUjian()
    {
        return $this->hasMany(JawabanUjian::class, 'id_ujian', 'id_ujian');
    }


    public function is_done_by_user($id_murid)
{
    // Contoh implementasi untuk memeriksa apakah ada jawaban yang sudah dikirimkan oleh user
    return $this->jawabanUjian()->where('id_murid', $id_murid)->exists();
}

    public function mapel() {
        return $this->belongsTo(Mapel::class, 'id_mapel', 'id_mapel');
    }
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }
    use HasFactory;
}

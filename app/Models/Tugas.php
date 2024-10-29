<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{

    
    protected $table = 'tugas';
    protected $fillable = ['id_kelas','id_mapel','konten','dateline','deskripsi','no_tugas'];
    protected $primaryKey = 'id_tugas';

    
    public function scopeCari($query){
        if(request('cari'))
        {
           return $query->where('no_tugas','like','%'.request('cari').'%');
        }
    }


    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'id_mapel', 'id_mapel');
    }

    public function materi()
    {
        return $this->belongsTo(Materii::class, 'id_materi', 'id_materi');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    public function is_done_by_user($id_murid)
{
    // Contoh implementasi untuk memeriksa apakah ada jawaban yang sudah dikirimkan oleh user
    return $this->jawabanTugas()->where('id_murid', $id_murid)->exists();
}
    
    public function jawabanTugas()
    {
        return $this->hasMany(JawabanTugas::class, 'id_tugas', 'id_tugas');
    }

//     public function siswaSudahMengerjakanBelumDinilai()
// {
//     $jawabanTugas = $this->jawabanTugas()->where('nilai_tugas', '<', 1)->pluck('id_murid');

//     return Santri::with(['jawabanTugas' => function ($query) {
//             $query->where('id_tugas', $this->id_tugas);
//         }])
//         ->whereIn('id_murid', $jawabanTugas)
//         ->get();
// }

public function siswaSudahMengerjakanWithNilai()
{
    $jawabanTugas = $this->jawabanTugas()->where('nilai_tugas', '>', 0)->pluck('id_murid');

    return Santri::with(['jawabanTugas' => function ($query) {
            $query->where('id_tugas', $this->id_tugas);
        }])
        ->whereIn('id_murid', $jawabanTugas)
        ->get();
}

    public function siswaSudahMengerjakan()
    {
        $jawabanTugas = $this->jawabanTugas()->pluck('id_murid');

        return Santri::with(['jawabanTugas' => function ($query) {
            $query->where('id_tugas', $this->id_tugas);
        }])
        ->whereIn('id_murid', $jawabanTugas)
        ->get();
    }

    public function siswaBelumMengerjakan()
    {
        $jawabanTugas = $this->jawabanTugas()->pluck('id_murid');

        return Santri::with('jawabanTugas')
            ->whereNotIn('id_murid', $jawabanTugas)
            ->get();
    }

    use HasFactory;
}

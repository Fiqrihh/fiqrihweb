@extends('lyout.Lmurid')

@section('konten1')

<div class="kotak1">
    <div class="gambar">
        <img src="{{ asset('gambar/gambar.jpg') }}">
    </div>
       
</div>

<div class="kotak2">
    <div class="atas">
    <h3 class="judul">Tentang anda</h3>
    <div class="mapel">nama : {{ $user->nama_lengkap }}</div>
    <div class="st">status : Murid</div>
    <div class="kelas">Anda Tingkatan "........"</div>
    </div>
 
    <div class="text-sambutan">
        Aplikasi ini merupakan aplikasi pembelajaran yang di buat untuk kurusus yang ada di pondok pesantren darul lugah waddirasatil islamiyah. untuk membantu kegiatan belajar mengajar kursus bahasa arab di pondok pesantren darul lughah waddirsatil islamiyah. memiliki fitur manajemen materi, manajemen tugas, ujian.
    </div>
</div>
    </div>
    



@endsection

@section('footer')
<div class="text-footer">@2024. kursus Bahasa Arab DLWI</div>
@endsection
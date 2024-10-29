@extends('lyout.lyoutPengajara')

@section('konten1')
    
    <div class="kotak1">
        <div class="gambar">
            <img src="{{ asset('gambar/gambar.jpg') }}">
        </div>
           
    </div>

    <div class="kotak2">
        <div class="atas">
        <h3 class="judul">Tentang anda</h3>
        <div class="mapel">nama : {{ $user->namaP }}</div>
        <div class="mapel">
            Mapel:
            @foreach($mapels as $mapel)
                {{ $mapel->nama_mapel }}@if(!$loop->last), @endif
            @endforeach
        </div>
        <div class="st">Status : Pengajar</div>
        </div>
        <div class="text-sambutan">
            Aplikasi ini merupakan aplikasi pembelajaran yang di buat untuk kurusus yang ada di pondok pesantren darul lugah waddirasatil islamiyah. untuk membantu kegiatan belajar mengajar kursus bahasa arab di pondok pesantren darul lughah waddirsatil islamiyah. memiliki fitur manajemen materi, manajemen tugas, ujian.
        </div>
    </div>



@endsection

@section('footer')
    <div class="text-footer">@2024. kursus Bahasa Arab DLWI</div>
@endsection
{{-- 
<div class="tentang">Hai namaGuru Selamat Datang di Aplikasi</div>
    <div class="kotak">
        <div class="sub-kotak">
            <img src="{{ ('gambar/gambar.jpg') }}">
        </div>

        <div class="sub-kotak2">
            <div class="profile">
                <div class="judul">Tentang anda</div>
                <div class="mapel">Anda mengajar mapel "........."</div>
                <div class="kelas">Anda Mengajar Tingkatan "........"</div>
                <span>---------------------------------------------</span>
            </div>
            <div class="text-sambutan">
                Aplikasi ini merupakan aplikasi pembelajaran yang di buat untuk kurusus yang ada di pondok pesantren darul lugah waddirasatil islamiyah. untuk membantu kegiatan belajar mengajar kursus bahasa arab di pondok pesantren darul lughah waddirsatil islamiyah. memiliki fitur manajemen materi, manajemen tugas, ujian.
            </div>
            
        </div>
    </div> --}}
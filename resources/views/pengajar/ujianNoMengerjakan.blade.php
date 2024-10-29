@extends('lyout.ujianpeng')

@section('konten')

<div class="navbar navbar-expand-lg navbar-light  bg-white navbarr">
    <div class="container-fluid" style="background-color:white; margin-left:1rem;">
        <a class="navbar-brand" href="#">Daftar siswa</a>
        <span> || </span>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ml-auto">
                <a class="nav-link  {{ request()->is('ujian/detail/*') ? 'active' : '' }} " href="/ujian/detail/{{ $ujian->id_ujian }}">Telah Mengerjakan</a>
                <a class="nav-link {{ request()->is('ujian/detail/*/belum') ? 'active' : '' }}" href="/ujian/detail/{{ $ujian->id_ujian }}/belum">Belum Mengerjakan</a>
            </div>
        </div>
    </div>
</div>


<div class="card bungkus-tugas">
   
    
    <div class="card-body header-row">
        <div class="row">
            <div class="col-md-1 hide-on-mobile"><strong>No</strong></div>
            <div class="col-md-2 hide-on-mobile"><strong>Profile Siswa</strong></div>
            
        </div>
    </div>
    
    @forelse ($ujian->siswaBelumMengerjakanujian() as $index => $item)
        <div class="card-body nilai-tugas">
            
            <div class="kiri" >
                <p >{{ $index + 1 }}</p>
                <img src="{{ asset('storage/foto-siswa/' . $item->fotoSiwa) }} "  class="profile-picture">
                <p class="nama-profile">{{ $item->nama_lengkap }}</p>
            </div>
            <div class="tengah">
               <p>Alamat :{{ $item->alamat }}</p>
               <p>No hp: {{ $item->nohp }}</p>
               <p>Jenis Kelamin : {{ $item->jenis_kelamin }}</p>
                
            </div>
            <div class="kanan">

            </div>
        </div>
    @empty
    <div class="card-body">
        <p class="text-center">Siswa telah mengerjakan semua tugas.</p>
    </div>
    @endforelse
</div>

    
@endsection
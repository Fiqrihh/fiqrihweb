@extends('lyout.tugasPeng')

@section('konten')

<div class="navbar navbar-expand-lg navbar-light  bg-white navbarr">
    <div class="container-fluid" style="background-color:white; margin-left:1rem;">
        <a class="navbar-brand" href="#">Daftar siswa</a>
        <span class="garis2"> || </span>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ml-auto">
                <a class="nav-link  {{ request()->is('tugas/*/siswa') ? 'active' : '' }} " href="{{ route('tugas.detailSiswa', ['id' => $tugas->id_tugas]) }}">Telah Mengerjakan</a>
                <a class="nav-link {{ request()->is('tugas/*/siswa/belum') ? 'active' : '' }}" href="{{ route('tugas.siswaBeluM', ['id' => $tugas->id_tugas]) }}">Belum Mengerjakan</a>
            </div>
        </div>
    </div>
</div>



<div class="card bungkus-tugas">
   
    
    <div class="card-body header-row">
        <div class="row">
            <div class="col-md-1  hide-on-mobile"><strong>No</strong></div>
            <div class="col-md-3  hide-on-mobile"><strong>Profile Siswa</strong></div>
            <div class="col-md-4  hide-on-mobile"><strong>File PDF</strong></div>
            <div class="col-md-4  hide-on-mobile"><strong>Penilaian</strong></div>
        </div>
    </div>
    
    @forelse ($tugas->siswaSudahMengerjakan() as $index => $item)
        <div class="card-body nilai-tugas">
            
            <div class="kiri" >
                <p >{{ $index + 1 }}</p>
                <img src="{{ asset('storage/foto-siswa/' . $item->fotoSiwa) }} "  class="profile-picture">
                <p class="nama-profile">{{ $item->nama_lengkap }}</p>
            </div>
            <div class="tengah">
                @foreach ($item->jawabanTugas as $jawaban)
                    <a href="/jawaban-tugas/{{ $jawaban->id_jawabanTugas }}" target="_blank" class="file-link">
                        <i class='bx bx-check-square' ></i>
                        <span class="file-name">Cek</span>
                    </a>
                    {{-- <p>{{ $jawaban->jawaban_text }}</p> --}}
                
            </div>
            <div class="kanan">
                <form action="/tugas/simpan-nilai/{{ $jawaban->id_jawabanTugas }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                       
                        <input type="number" id="nilai" name="nilai_tugas" class="form-control" min="0" max="100" step="1" required inputmode="numeric" style="width: 5rem; background-color: #d9dcdf" value="{{ $jawaban->nilai_tugas > 1 ? $jawaban->nilai_tugas : '' }}">
                    </div>
                    @endforeach
                    <button type="submit" class="btn btn-primary" style="margin-top: 1rem">Simpan Nilai</button>
                </form>
            </div>
        </div>
    @empty
        <p>Tidak ada siswa yang sudah mengerjakan tugas.</p>
    @endforelse
</div>

   






















@endsection

@extends('lyout.leotPengajar')

@section('konten')




<h2 class="mapel">nama mapel : {{ $mapel->nama_mapel }}</h2>    
<h3 class="kelas">Kelas : {{ $mapel->kelas->n_kelas }}</h3>
<div class="tugas">
  
   
    
</div>

<div class="container" style="background-color: rgb(255, 255, 255)">

    <p style="padding-top: 2rem; font-size: 20px;" >Deskripsi : {{ $tugas->deskripsi }}</p>
    <div class="pertanyaan" style="width: 100%">
    <p>pertanyaan</p>
    
    <span style="white-space: pre-wrap;">{{ $tugas->konten }}</span>
    </div>


    <div class="dateline" style="margin-top:3rem">
        <p>date exp. : {{ $tugas->dateline }}</p>
 
    </div>
    <div class="publish">
        <p> tanggal publish : {{ $tugas->created_at }}</p>
    </div>
</div>


@endsection
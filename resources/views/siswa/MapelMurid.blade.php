@extends('lyout.allMurid')

@section('konten1')

<div class="container mt-3">
    <div class="row">
        @foreach ($mapels as $mapel)
            <div class="col-md-4 mb-4 bungkus">
                <div class="card">
                    {{-- <img src="https://via.placeholder.com/150" class="card-img-top" alt="Gambar Mapel"> --}}
                    <div class="card-body">
                        <h5 class="card-title">{{ $mapel->nama_mapel }}</h5>
                        <p class="card-text">{{ $mapel->deskripsi }}</p>
                        <a href="/mapel/{{ $mapel->id_mapel }}/materi" class="btn btn-primary">
                            <i class='bx bxs-door-open'></i> Masuk
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
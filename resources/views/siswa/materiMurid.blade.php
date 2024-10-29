@extends('lyout.allMurid')

@section('konten1')

<div class="container mt-3">
    <h2>Materi untuk Mapel {{ $mapel->nama_mapel }}</h2>
    <div class="row">
        @foreach ($materis as $materi)
            <div class="col-md-4 mb-4 bungkus">
                <div class="card">
                    @if (!empty($materi->gambar_url))
                    <img src="{{ asset('storage/' . $materi->gambar_url) }}" class="card-img-top" alt="Gambar Mapel">
                @else
                    <img src="https://via.placeholder.com/150" class="card-img-top" alt="Gambar Mapel">
                @endif
                

                    <div class="card-body">
                        <h5 class="card-title">{{ $materi->judul_materi }}</h5>
                        <p class="card-text">{{ $materi->deskripsi }}</p>
                        <!-- Tambahkan link atau tombol lainnya jika diperlukan -->

                    </div>
                    <a href="{{ route('materi.show', $materi->id_materi) }}" class="btn btn-info btn-sm"><i class='bx bx-show'></i> Baca</a>

                </div>
            </div>
        @endforeach
    </div>
    {{ $materis->links() }}
</div>

@endsection
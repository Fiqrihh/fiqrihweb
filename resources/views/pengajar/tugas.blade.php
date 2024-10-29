@extends('lyout.leotpengajar')

@section('konten')

<div class="card card-tugas">
    <div class="card-body body-tugas">
      <h1 class="card-title text-center" style="color: aliceblue">Tugas</h1>
      <h3 class="card-subtitle mb-2 text-body-secondary text-center" style="color: aliceblue">Mata Pelajaran yang anda ajarin </h6>
      <h5 class="card-textt text-center" style="color: aliceblue; text-center">Pilih mapel untuk di manajemen </h5>
    </div>
</div>
<div class="tugas">
    <div class="container">
        <div class="row">
            @foreach ($mapel as $mapel)
                <div class="col-md-4 mb-4 bungkuss">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-center">{{ $mapel->nama_mapel }}</h5>
                            <a href="{{ route('materi.byMapel', $mapel->id_mapel) }}" class="btn btn-primary">
                                <i class='bx bxs-door-open'></i> Masuk
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection

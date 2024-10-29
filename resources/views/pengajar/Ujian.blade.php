@extends('lyout/ujian.ujian')

@section('konten')

<div class="card card-ujian">
    <div class="card-body body-tugas">
      <h1 class="card-title text-center" style="color: aliceblue">Ujian</h1>
      <h3 class="card-subtitle mb-2 text-body-secondary text-center" style="color: aliceblue">Mata Pelajaran yang anda ajarin </h6>
      <h5 class="card-textt text-center" style="color: aliceblue; text-center">  @foreach ($mapel as $mp)
        <div>{{ $mp->nama_mapel }}</div>
    @endforeach </h5>
    </div>
</div>
<div class="tugas">
    <div class="container">
        <div class="row">
            @foreach ($mapel as $mapel)
                <div class="col-md-4 mb-4 bungkuss">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('ujian.draft', $mapel->id_mapel) }}" class="btn btn-primary">
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
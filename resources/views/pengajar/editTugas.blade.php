@extends('lyout.leotpengajar')

@section('konten')

<div class="card">
    <div class="card-body cb-tugas">
      <form action="{{ route('tugas.update', $tugas->id_tugas) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nama_mapel" class="form-label fl-tugas">nama mapel </label>
            <input type="text" class="form-control form-readonly" id="nama_mapel" name="nama_mapel" value="{{ $tugas->mapel->nama_mapel }}" readonly>
            <input type="hidden" id="id_mapel" name="id_mapel" value="{{ $tugas->id_mapel }}">
          </div>
          
          <div class="mb-3">
            <label for="id_kelas" class="form-label fl-tugas">kelas </label>
            <input type="text" class="form-control form-readonly" id="id_kelas" name="id_kelas" value="{{ $tugas->kelas->n_kelas }}" readonly>
            <input type="hidden" id="id_kelas" name="id_kelas" value="{{ $tugas->id_kelas }}">
          </div>
          <div class="mb-3">
            <label for="deskripsi" class="form-label fl-tugas">deskripsi </label>
            <input type="text" class="form-control " id="deskripsi" name="deskripsi" value="{{ $tugas->deskripsi }}">
          </div>
          <div class="mb-3">
            <label for="dateline" class="form-label fl-tugas">exp date </label>
            <input type="datetime-local" class="form-control " id="dateline" name="dateline" value="{{ \Carbon\Carbon::parse($tugas->dateline)->format('Y-m-d\TH:i') }}">
          </div>
          <div class="mb-3">
            <label for="konten" class="form-label fl-tugas">Pertanyaan </label>
            <textarea id="konten" name="konten" class="form-control konten" rows="4" required>  {{ $tugas->konten }}</textarea>
          </div>

          <button type="submit" class="btn btn-success" style="margin-top: 2rem">Submit</button>
      </form>

    </div>
  </div>

    
@endsection
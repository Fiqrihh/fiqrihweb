@extends('lyout.leotpengajar')

@section('konten')

<div class="card">
    <div class="card-body cb-tugas">
      <form action="{{ route('tugas.addTugass', $mapel->id_mapel) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="nama_mapel" class="form-label fl-tugas">nama mapel </label>
            <input type="text" class="form-control form-readonly" id="nama_mapel" name="nama_mapel" value="{{ $mapel->nama_mapel }}" readonly>
            <input type="hidden" id="id_mapel" name="id_mapel" value="{{ $mapel->id_mapel }}">
          </div>
          
          <div class="mb-3">
            <label for="id_kelas" class="form-label fl-tugas">kelas </label>
            <input type="text" class="form-control form-readonly" id="id_kelas" name="id_kelas" value="{{ $kelas->n_kelas }}" readonly>
            <input type="hidden" id="id_kelas" name="id_kelas" value="{{ $kelas->id_kelas }}">
          </div>
          <div class="mb-3">
            <label for="deskripsi" class="form-label fl-tugas">deskripsi </label>
            <input type="text" class="form-control " id="deskripsi" name="deskripsi" value="{{ old('deskripsi') }}" >
          </div>

          <div class="mb-3">
            <label for="no_tugas" class="form-label fl-tugas">info tugas </label>
            <input type="text" class="form-control @error('no_tugas') is-invalid @enderror" id="no_tugas" name="no_tugas" value="{{ $nextTugas }}" required>
            @error('no_tugas')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

          <div class="mb-3">
            <label for="dateline" class="form-label fl-tugas">exp date </label>
            <input type="datetime-local" class="form-control " id="dateline" name="dateline" >
          </div>
          <div class="mb-3">
            <label for="konten" class="form-label fl-tugas">Pertanyaan </label>
            <textarea id="konten" name="konten" class="form-control konten" rows="4" required value="{{ old('konten') }}"></textarea>
          </div>

          <button type="submit" class="btn btn-success" style="margin-top: 2rem">Submit</button>
      </form>

    </div>
  </div>

    
@endsection
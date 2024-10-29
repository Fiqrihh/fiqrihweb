@extends('lyout/ujian.ujian')

@section('konten')

<div class="card">
    <div class="card-body cb-tugas">
      <form action="{{ route('ujian.submitadd') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="id_mapel" class="form-label fl-tugas">nama mapel </label>
            <input type="text" class="form-control form-readonly" value="{{ $mapel->nama_mapel }}" readonly>
            <input type="hidden" id="id_mapel" name="id_mapel" value="{{ $mapel->id_mapel }}">
          </div>
          
          <div class="mb-3">
            <label for="id_kelas" class="form-label fl-tugas">kelas </label>
            <input type="text" class="form-control form-readonly" id="id_kelas" name="id_kelas" value="{{ $kelas->n_kelas }}" readonly>
            <input type="hidden" id="id_kelas" name="id_kelas" value="{{ $kelas->id_kelas }}">
          </div>
          <div class="mb-3">
            <label for="Deskripsi" class="form-label fl-tugas">deskripsi </label>
            <input type="text" class="form-control " id="Deskripsi" name="Deskripsi" value="{{ old('Deskripsi') }}" >
          </div>

          <div class="mb-3">
            <label for="waktu_mulai" class="form-label fl-tugas">waktu mulai </label>
            <input type="datetime-local" class="form-control " id="waktu_mulai" name="waktu_mulai" >
          </div>

          <div class="mb-3">
            <label for="waktu_berakhir" class="form-label fl-tugas">waktu berakhir </label>
            <input type="datetime-local" class="form-control " id="waktu_berakhir" name="waktu_berakhir" >
          </div>

          <div class="mb-3">
            <label for="pertanyaan" class="form-label fl-tugas">Pertanyaan </label>
            <textarea id="pertanyaan" name="pertanyaan" class="form-control konten" rows="4" required value="{{ old('pertanyaan') }}"></textarea>
          </div>

          <div class="mb-3">
            <label for="audio_ujian" class="form-label">Upload MP3 File</label>
            <input class="form-control" type="file" id="audio_ujian" name="audio_ujian" accept=".mp3" >
        </div>

          <button type="submit" class="btn btn-success" style="margin-top: 2rem">Submit</button>
      </form>

    </div>
  </div>
    
@endsection
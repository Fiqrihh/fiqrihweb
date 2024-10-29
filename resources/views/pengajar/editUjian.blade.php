@extends('lyout/ujian.editUjian')

@section('konten')
<div class="card">
    <div class="card-body">
        <form action="/update/ujian/{{ $ujian->id_ujian }}" method="POST" enctype="multipart/form-data">
            @csrf

            @method('PUT')
            
            <div class="mb-3">
                <label for="id_mapel" class="form-label fl-tugas">nama mapel </label>
                <input type="text" class="form-control form-readonly" value="{{ $ujian->mapel->nama_mapel }}" readonly>
                <input type="hidden" id="id_mapel" name="id_mapel" value="{{  $ujian->id_mapel }}">
              </div>
              
              <div class="mb-3">
                <label for="id_kelas" class="form-label fl-tugas">kelas </label>
                <input type="text" class="form-control form-readonly" value="{{ $ujian->kelas->n_kelas }}" readonly>
                <input type="hidden" id="id_kelas" name="id_kelas" value="{{ $ujian->id_kelas }}">
              </div>
              <div class="mb-3">
                <label for="Deskripsi" class="form-label fl-tugas">deskripsi </label>
                <input type="text" class="form-control " id="Deskripsi" name="Deskripsi" value="{{ $ujian->Deskripsi }}" >
              </div>
    
              <div class="mb-3">
                <label for="waktu_mulai" class="form-label fl-tugas">waktu mulai </label>
                <input type="datetime-local" class="form-control " id="waktu_mulai" name="waktu_mulai" value="{{ $ujian->waktu_mulai }}">
              </div>
    
              <div class="mb-3">
                <label for="waktu_berakhir" class="form-label fl-tugas">waktu berakhir </label>
                <input type="datetime-local" class="form-control " id="waktu_berakhir" name="waktu_berakhir"  value="{{ $ujian->waktu_berakhir }}">
              </div>
    
              <div class="mb-3">
                <label for="pertanyaan" class="form-label fl-tugas">Pertanyaan </label>
                <textarea id="pertanyaan" name="pertanyaan" class="form-control konten" rows="4" required >{{ $ujian->pertanyaan }}</textarea>
              </div>
    
              <div class="mb-3">
                <label for="audio_ujian" class="form-label">Upload MP3 File</label>
                <!-- Tampilkan nama file MP3 yang sudah ada jika ada -->
                @if($ujian->audio_ujian)
                    <p>File yang ada: <a href="{{ asset('storage/'.$ujian->audio_ujian) }}" target="_blank">{{ $ujian->audio_ujian }}</a></p>
                @endif
                <input class="form-control" type="file" id="audio_ujian" name="audio_ujian" accept=".mp3">
            </div>
            
    
              <button type="submit" class="btn btn-success" style="margin-top: 2rem">Submit</button>
          </form>
    
    </div>
  </div>
@endsection
@extends('lyout.leotpengajar')

@section('konten')
<form action="/pengajar/materi/tambah" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="id_mapel">Mata Pelajaran:</label>
        <select id="id_mapel" name="id_mapel" class="form-control" required>
            @foreach($mapels as $mapel)
                <option value="{{ $mapel->id_mapel }}">{{ $mapel->nama_mapel }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="judul_materi">Judul Materi:</label>
        <input type="text" id="judul_materi" name="judul_materi" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="deskripsi">Deskripsi:</label>
        <input type="text" id="deskripsi" name="deskripsi" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="konten">Penjelasan:</label>
        <textarea id="konten" name="konten" class="form-control konten" rows="4" required></textarea>
    </div>
    <div class="form-group">
        <label for="video_url">Link Video (YouTube):</label>
        <input type="text" id="video_url" name="video_url" class="form-control" placeholder="Contoh: https://youtu.be/056UmAJskSk?si=rTCz4ht2tsv-kpJf">
    </div>

    <input type="hidden" name="status" value="draft">

    <div class="form-group">
        <label for="gambar_url">Sampul:</label>
        <input type="file" class="form-control" id="gambar_url" name="gambar_url">
      </div>
      
    <button type="submit" class="btn btn-success" style="margin-top: 2rem">Submit</button>
</form>

@endsection
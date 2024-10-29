@extends('lyout.leotpengajar')

@section('konten')

<div class="container">
    <h1>Edit Materi</h1>

    <form action="{{ route('materi.update', $materi->id_materi) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="id_mapel">Mata Pelajaran:</label>
            <select id="id_mapel" name="id_mapel" class="form-control" required>
                @foreach($mapels as $mapel)
                    <option value="{{ $mapel->id_mapel }}" {{ $mapel->id_mapel == $materi->id_mapel ? 'selected' : '' }}>{{ $mapel->nama_mapel }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="judul_materi">Judul Materi:</label>
            <input type="text" id="judul_materi" name="judul_materi" class="form-control" value="{{ $materi->judul_materi }}" required>
        </div>
        <div class="form-group">
            <label for="deskripsi">Deskripsi:</label>
            <input type="text" id="deskripsi" name="deskripsi" class="form-control" value="{{ $materi->deskripsi }}" required>
        </div>
        <div class="form-group">
            <label for="konten">Penjelasan:</label>
            <textarea id="konten" name="konten" class="form-control konten" rows="4" required>{{ $materi->konten }}</textarea>
        </div>
        <div class="form-group">
            <label for="video_url">Link Video (YouTube):</label>
            <input type="text" id="video_url" name="video_url" class="form-control" value="{{ $materi->video_url }}" placeholder="Contoh: https://www.youtube.com/watch?v=VIDEO_ID">
        </div>
        {{-- <div class="form-group">
            <label for="gambar_url">Link Gambar:</label>
            <input type="text" id="gambar_url" name="gambar_url" class="form-control" value="{{ $materi->gambar_url }}" placeholder="Contoh: https://www.example.com/path/to/image.jpg">
        </div> --}}
        <button type="submit" class="btn btn-success" style="margin-top: 2rem">Simpan Perubahan</button>
    </form>
</div>
@endsection
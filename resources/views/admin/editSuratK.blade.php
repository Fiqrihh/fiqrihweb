@extends('lyout.leotuang')

@section('contener')


<form action="/sKeluar/{{ $id }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($id))
    @method('PUT')
    @endif
    <label for="pengirim">Pengirim:</label>
    <input type="text" id="Penerima" name="Penerima" class="form-control" value="{{ $Penerima }}" required>
    <label for="judulSuratK">Judul Surat:</label>
    <input type="text" id="judulSuratK" name="judulSuratK" class="form-control" value="{{ $judulSuratK }}" required>
    <label for="nomorSuratK">No.Surat:</label>
    <input type="text" id="nomorSuratK" name="nomorSuratK" class="form-control"value="{{ $nomorSuratK }}" required>
    
    <label for="tempat">tempat tujuan:</label>
    <input type="text" id="tempat" name="tempat" class="form-control"value="{{ $tempat }}" required>

    <label for="isiSuratK">Isi:</label>
    <textarea id="isiSuratK" name="isiSuratK" class="form-control" rows="4" required>{{ $isiSuratK }}</textarea>
    
    <label for="tglSuratK">Tanggal Surat:</label>
    <input type="date" id="tglSuratK" name="tglSuratK" class="form-control"value="{{ $tglSuratK }}" required>
    
    <div class="modal-footer">
      <button type="submit" class="btn btn-success" >Simpan</button> 
      <a href="/sKeluar" class="btn btn-warning" > kembali</a>
    </div>
    <!-- Tambahkan elemen form lainnya sesuai kebutuhan -->
  </form>

  

@endsection
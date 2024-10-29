@extends('lyout.leotuang')

@section('contener')


<form action="/sMasuk/{{ $id }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($id))
    @method('PUT')
    @endif
    <label for="pengirim">Pengirim:</label>
    <input type="text" id="Pengirim" name="Pengirim" class="form-control" value="{{ $Pengirim }}" required>
    <label for="judulSuratM">Judul Surat:</label>
    <input type="text" id="judulSuratM" name="judulSuratM" class="form-control" value="{{ $judulSuratM }}" required>
    <label for="nomorSuratM">No.Surat:</label>
    <input type="text" id="nomorSuratM" name="nomorSuratM" class="form-control"value="{{ $nomorSuratM }}" required>
    <label for="isiSuratM">Keteragan:</label>
    <input type="text" id="isiSuratM" name="isiSuratM" class="form-control"value="{{ $isiSuratM }}" required>
    <label for="tglSuratM">Tanggal Surat:</label>
    <input type="date" id="tglSuratM" name="tglSuratM" class="form-control"value="{{ $tglSuratM }}" required>
    
    <div class="modal-footer">
      <button type="submit" class="btn btn-success" >Simpan</button> 
      <a href="/sMasuk" class="btn btn-warning" > kembali</a>
    </div>
    <!-- Tambahkan elemen form lainnya sesuai kebutuhan -->
  </form>

  

@endsection
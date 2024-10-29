@extends('lyout/leotuang')

@section('contener')
    

          <form action="/murid/{{ $id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($id))
            @method('PUT')
            @endif
            <label for="nama">Nama Lengkap:</label>
            <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" value="{{ $nama_lengkap }}" required>
            <label for="alamat">Alamat:</label>
            <input type="text" id="alamat" name="alamat" class="form-control" value="{{ $alamat }}" required>
            <label for="nohp">No hp:</label>
            <input type="text" id="nohp" name="nohp" class="form-control"value="{{ $nohp }}" required>
            <label for="jenis_kelamin">Jenis Kelamin:</label>
            <select id="jenis_kelamin" name="jenis_kelamin" class="form-control" required>
                <option value="Laki-laki" {{ $jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ $jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
            <label for="nohp">tanggal Lahir:</label>
            <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control"value="{{ $tanggal_lahir }}" required>
            <label for="kelass">Status:</label>
            <select id="kelass" name="kelass" class="form-control" required>
                <option value="verifikasi" {{ $kelass == 'verifikasi' ? 'selected' : '' }}>verifikasi</option>
                <option value="belum_verifikasi" {{ $kelass == 'belum_verifikasi' ? 'selected' : '' }}>belum_verifikasi</option>
            </select>

            <div class="modal-footer">
              <button type="submit" class="btn btn-success" >Simpan</button> 
              <a href="/murid/" class="btn btn-warning" > kembali</a>
            </div>
            <!-- Tambahkan elemen form lainnya sesuai kebutuhan -->
          </form>
        
  @endsection
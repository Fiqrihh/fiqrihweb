@extends('lyout/leotuang')

@section('contener')
    

          <form action="/transaksi/pemasukan/{{ $id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($id))
            @method('PUT')
            @endif
            <div class="form-group">
              <label for="id_kategori">Kategori:</label>
              <select class="form-control" name="id_kategori" id="id_kategori">
                  @foreach ($kate as $katego)
                      <option value="{{ $katego->id_kategori }}">{{ $katego->nama_kategori }}</option>
                  @endforeach
              </select>
          </div>
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" class="form-control" value="{{ $nama }}" required>
            <label for="jumlah_pem">Nominal:</label>
            <input type="number" id="jumlah_pem" name="jumlah_pem" class="form-control" value="{{ $jumlah_pem }}" required>
            <label for="tanggal_pem">tanggal:</label>
            <input type="date" id="tanggal_pem" name="tanggal_pem" class="form-control"value="{{ $tanggal_pem }}" required>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success" >Simpan</button>
              <a href="/transaksi/pemasukan" class="btn btn-warning" > kembali</a>
            </div>
            <!-- Tambahkan elemen form lainnya sesuai kebutuhan -->
          </form>
        
  @endsection
@extends('lyout/leotuang')

@section('contener')
    

          <form action="/transaksi/pengeluaran/{{ $id }}" method="POST" enctype="multipart/form-data">
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
            <label for="jumlah_peng">Nominal:</label>
            <input type="number" id="jumlah_peng" name="jumlah_peng" class="form-control" value="{{ $jumlah_peng }}" required>
            <label for="tanggal_peng">tanggal:</label>
            <input type="date" id="tanggal_peng" name="tanggal_peng" class="form-control"value="{{ $tanggal_peng }}" required>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success" >Simpan</button>
              <a href="/transaksi/pengeluaran" class="btn btn-warning" > kembali</a>
            </div>
            <!-- Tambahkan elemen form lainnya sesuai kebutuhan -->
          </form>
        
  @endsection
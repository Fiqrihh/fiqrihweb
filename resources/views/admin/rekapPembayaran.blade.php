@extends('lyout.leotuang')

@section('contener')
<div class="container-fluid">
  <button type="button" class="btn btn-success" style="margin:5px" data-toggle="modal" data-target="#myModalmasukan"><i class="fa fa-plus">Tambah Pembayarn</i></button>

    <div class="row justify-content-center">
        <div class="col-md-4 mb-4">
            <!-- Rekap Form -->
            <form action="/rekap" method="GET" class="form-inline">
                <div class="input-group">
                    <select class="form-control" name="bulan">
                        <option value="">Pilih Bulan</option>
                        @foreach($bulanIndonesia as $key => $bulan)
                            <option value="{{ $key }}" @if(request('bulan') == $key) selected @endif>{{ $bulan }}</option>
                        @endforeach
                    </select>
                    <select class="form-control" name="tahun">
                        <option value="">Pilih Tahun</option>
                        @foreach($tahunDatabase as $tahun)
                            <option value="{{ $tahun }}" @if(request('tahun') == $tahun) selected @endif>{{ $tahun }}</option>
                        @endforeach
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit" id="button-addon2">Rekap</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Display Data -->
    <div class="row justify-content-center">
        <div class="col-lg-9 mb-4">
            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-center">Pembayaran Siswa</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            {{ $masuk->links() }}
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Tanggal</th>
                                    <td>print</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($masuk as $in)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $in->nama_kategori }}</td>
                                    <td>{{ $in->nama }}</td>
                                    <td>{{ $in->jumlah_pem }}</td>
                                    <td>{{ $in->tanggal_pem }}</td>
                                    <td> <a href="/cetak_pdf/{{ $in->id}}" class="btn btn-info fa fa-print" target="_blank" ></a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="myModalmasukan">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Header Modal -->
      <div class="modal-header">
        <h4 class="modal-title">Form Pemasukan</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Body Modal -->
      <div class="modal-body">

        
        <!-- Isi form pemasukan di sini -->
        <form action="/rekap" method="POST" enctype="multipart/form-data" >
          @csrf
          <div class="form-group">
            <label for="id_kategori">Kategori:</label>
            <select class="form-control" name="id_kategori" id="id_kategori">
              @foreach ($kate as $katego)
                  @if ( $katego->id_kategori == 4)
                      <option value="{{ $katego->id_kategori }}">{{ $katego->nama_kategori }}</option>
                  @endif
              @endforeach
          </select>
        </div>
          <label for="nama">Nama:</label>
          <input type="text" id="nama" name="nama" class="form-control" required>
          <label for="jumlah_pem">Nominal:</label>
          <input type="number" id="jumlah_pem" name="jumlah_pem" class="form-control" required>
          <label for="tanggal_peng">tanggal:</label>
          <input type="date" id="tanggal_pem" name="tanggal_pem" class="form-control" required>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success" id="simpanBtn">Simpan</button>
          </div>
        </form>
      </div>
      <!-- Footer Modal -->
      

    </div>
  </div>
</div>


<!-- Script JavaScript untuk menangani tombol Simpan -->
<script>
  $(document).ready(function(){
      $('#simpanBtn').click(function(){
          if(confirm("Anda yakin ingin menyimpan data?")) {
              // Jika pengguna menekan OK, kirimkan form
              $('#formPemasukan').submit();
          }
      });
  });
</script>

<script>
  $(document).ready(function(){
      $('#formPemasukan').submit(function(){
          alert("Data berhasil disimpan.");
      });
  });
</script>

@endsection
@section('konten')
    

@endsection

@extends('lyout.leotuang')

@section('contener')
<div class="row justify-content-center align-items-center">
    <div class=" col-lg-14 mb-4">
      <div class="card shadow mb-4 mx-auto">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Transaksi</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th class="text-center align-middle">No</th>
                  <th class="text-center align-middle">Nama</th>
                  <th class="text-center align-middle">Aksi</th>
                </tr>
              </thead>
           
              @foreach($kate as $gori)
                  <tbody>
                    <tr>
                      <td class="text-center align-middle">{{ $loop->index + 1 }}</td>
                      <td class="text-center align-middle">{{ $gori->nama_kategori  }}</td>
                      <td class="text-center align-middle"><a href="/kategori/{{ $gori->id_kategori }}/edit" class="btn btn-primary"><i class="fa fa-edit" >Edit</i></a>   ||
                          <a href="/kategori/{{ $gori->id_kategori }}/delete" class="btn btn-danger delete-btn" class="fa fa-trash" data-id={{ $gori->id_kategori }}>delete</a>
                      </td>
                      
                    
                    </tr>
                  @endforeach
              
            </tbody>
            </div>

            <button type="button" class="btn btn-success" style="margin:5px" data-toggle="modal" data-target="#myModalTambah"><i class="fa fa-plus"> Tambah kategori</i></button>
            <div class="modal" id="myModalTambah">
            <div class="modal-dialog">
            <div class="modal-content">

                <!-- Header Modal -->
        <div class="modal-header">
          <h4 class="modal-title">tambah Data Kategori</h4>
          <button type="button" class="close" data-dismiss="modal" >&times;</button>
        </div>
  
        <!-- Body Modal -->
        <div class="modal-body">
          <!-- Isi form di sini -->
          <form action="/kategori" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="nama_lengkap">Nama:</label>
            <input type="text" id="nama_kategori" name="nama_kategori" class="form-control" required>
          

            <div class="modal-footer">
              <button type="submit" class="btn btn-success" >Simpan</button>
            </div>
            <!-- Tambahkan elemen form lainnya sesuai kebutuhan -->
          </form>
        </div>
  
        <!-- Footer Modal -->
        
  
      </div>
    </div>
  </div>
<!-- penutup  Header pegeluaran -->
      </div>
      </div>

      @if(session('success'))
<div class="alert alert-success" id="success-alert">
    {{ session('success') }}
</div>
@endif

<!-- Bagian Notifikasi untuk Kesalahan -->
@if(session('error'))
<div class="alert alert-danger" id="error-alert">
    {{ session('error') }}
</div>
@endif

<script>
// Menghilangkan notifikasi sukses setelah 5 detik
setTimeout(function() {
    $('#success-alert').fadeOut('fast');
}, 500);

// Menghilangkan notifikasi kesalahan setelah 5 detik
setTimeout(function() {
    $('#error-alert').fadeOut('fast');
}, 5000);
</script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Mengambil semua elemen dengan kelas 'delete-btn'
    var deleteButtons = document.querySelectorAll('.delete-btn');

    // Menambahkan event listener untuk setiap tombol hapus
    deleteButtons.forEach(function (button) {
      button.addEventListener('click', function (event) {
        event.preventDefault();

        // Mengambil ID dari atribut data-id
        var id = button.getAttribute('data-id');

        // Menampilkan kotak dialog konfirmasi
        var isConfirmed = confirm('Apakah Anda yakin ingin menghapus data?');

        // Jika pengguna mengonfirmasi, arahkan ke URL penghapusan
        if (isConfirmed) {
          window.location.href = '/kategori/' + id + '/delete';
        }
      });
    });
  });
</script>


    
@endsection
@section('konten')
    
@endsection
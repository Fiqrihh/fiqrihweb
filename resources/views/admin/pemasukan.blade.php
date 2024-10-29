@extends('lyout.leotuang')

@section('contener')

<div class="container-fluid">
<div class="row  justify-content-center">
  <div class="col-md-4 mb-4">
    <!-- Search Form -->
    <form action="/transaksi/pemasukan" class="form-inline">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="cari.." name="cari" value="{{ request('cari') }}">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit" id="button-addon2">Cari</button>
            </div>
        </div>
    </form>
</div>
</div>

@endsection

@section('konten')
    

  <!-- Content Row -->
         <div class="row justify-content-center">

           <!-- Content Column -->
           <div class="col-lg-9 mb-4">

             <!-- Project Card Example -->
             <div class="card shadow mb-4">
               <div class="card-header py-3">
                 <h6 class="m-0 font-weight-bold text-center">Pemasukan</h6>
                 <button type="button" class="btn btn-success" style="margin:5px" data-toggle="modal" data-target="#myModalmasukan"><i class="fa fa-plus">Masukan</i></button>
               </div>
               <div class="card-body">
                 <div class="table-responsive">
                   <table class="table">
                    {{ $masuk->links() }}
                 <thead>
                   <tr>
                    
                     <th scope="col">No</th>
                     <th scope="col">kategori</th>
                     <th scope="col">Nama</th>
                     <th scope="col">Harga</th>
                     <th scope="col">Tanggal</th>
                     <th scope="col">keterangan</th>
                     <th scope="col">Aksi</th>

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
                     <td>{{ $in->keterangan }}</td>
                     <td>
                     <a href="/transaksi/pemasukan/{{ $in->id }}/edit" class="btn btn-primary"><i class="fa fa-edit" >Edit</i></a>  ||
                      <a href="/transaksi/{{ $in->id }}/pem/delete" class="btn btn-danger delete-btn" class="fa fa-trash"  data-id="{{ $in->id }}">delete</a>
                  </td>
                   </tr>
                   @endforeach
               </tbody>
                  </td>
                </tr>
              </tfoot>
              
               </table>
             </div>
               </div>
             </div>
       </div>

<!-- Pembuka tambah pemasukan -->

<!-- Modal untuk form pemasukan -->
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
        <form action="/transaksi/pem" method="POST" enctype="multipart/form-data" >
          @csrf
          <div class="form-group">
            <label for="id_kategori">Kategori:</label>
            <select class="form-control" name="id_kategori" id="id_kategori">
                @foreach ($kate as $katego)
                    <option value="{{ $katego->id_kategori }}">{{ $katego->nama_kategori }}</option>
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
            <button type="submit" class="btn btn-success" >Simpan</button>
          </div>
        </form>
      </div>
      <!-- Footer Modal -->
      

    </div>
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
                window.location.href = '/transaksi/' + id + '/pem/delete';
              }
            });
          });
        });
      </script>
      

@endsection


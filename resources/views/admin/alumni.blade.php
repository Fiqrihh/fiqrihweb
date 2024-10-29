@extends('lyout.leotuang')

@section('contener')
<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-md-4 mb-4">
        <!-- Search Form -->
        <form action="/alumni" class="form-inline">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="cari.." name="cari" value="{{ request('cari') }}">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit" id="button-addon2">Cari</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('konten')

 
<div class="row justify-content-center">  
  <div class=" col-lg-14 mb-4">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold  text-center">Daftar Alumni</h5>
       
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table">
            <thead>
           
              <tr>
                <th class="text-center align-middle">No</th>
                <th class="text-center align-middle">Nama</th>
                <th class="text-center align-middle">Alamat</th>
                <th class="text-center align-middle">No.Hp</th>
                <th class="text-center align-middle">jenis kelamin</th>
                <th class="text-center align-middle">Status</th>
                <th class="text-center align-middle">Tanggal Lahir</th>
                <th class="text-center align-middle">Aksi</th>
              </tr>
            </thead>
            <tbody>
            @foreach($pelajarJ as $anak)
                
                  <tr>
                    <td class="text-center align-middle">{{ $loop->index + 1 }}</td>
                    <td class="text-center align-middle">{{ $anak->nama_lengkap  }}</td>
                    <td class="text-center align-middle">{{ $anak->alamat }}</td>
                    <td class="text-center align-middle">{{ $anak->nohp }}</td>
                    <td class="text-center align-middle">{{ $anak->jenis_kelamin }}</td>
                    <td class="text-center align-middle">{{ $anak->kelass }}</td>
                    <td class="text-center align-middle">{{ $anak->tanggal_lahir }}</td>
                    <td><a href="/alumni/{{ $anak->id }}/delete" class="btn btn-danger delete-btn" class="fa fa-trash"  data-id="{{ $anak->id }}">delete</a></td>
                 
                  </tr>
                @endforeach
            
          </tbody>
          
          </div>
          
          </div>


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
                    window.location.href = '/alumni/' + id + '/delete';
                  }
                });
              });
            });
          </script>


{{ $pelajarJ->links() }}

    
@endsection
@extends('lyout.leotuang')


@section('contener')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-4 mb-4 mx-auto">
        <!-- Search Form -->
        <form action="/sMasuk" class="form-inline">
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

  <!-- Content Row -->
         <div class="row">

           <!-- Content Column -->
           <div class="col-lg-12 mb-4">

             <!-- Project Card Example -->
             <div class="card shadow mb-4">
               <div class="card-header py-3">
                 <h6 class="m-0 font-weight-bold text-center">Surat Masuk</h6>
                 <button type="button" class="btn btn-success" style="margin:5px" data-toggle="modal" data-target="#myModalTambah"><i class="fa fa-plus">Surat Masuk</i></button>
               </div>
               <div class="card-body">
                {{ $surat->links() }}
               
                 <div class="table-responsive">
                   <table class="table">
                 <thead>
                   <tr>
                    
                     <th scope="col">No</th>
                     <th scope="col">pengirim</th>
                     <th scope="col">judul</th>
                     <th scope="col">nomor</th>
                     <th scope="col">isi</th>
                     <th scope="col">tanggal</th>
                     <th scope="col">file</th> 
                     <th scope="col">Aksi</th>

                   </tr>
                   
                 </thead>
                
                 <tbody>
                   @foreach ($surat as $out)
                 
                   <tr>
                     <td>{{ $loop->index + 1 }}</td>
                     <td>{{ $out->Pengirim }}</td>
                     <td>{{ $out->judulSuratM	 }}</td>
                     <td>{{ $out->nomorSuratM }}</td>
                     <td>{{ $out->isiSuratM }}</td>
                     <td>{{ $out->tglSuratM }}</td>
                     <td><a href="/pdf/{{ $out->id}}" target="_blank">{{ $out->fileSuratM }}</a></td>
                     <td class=" align-middle" style="display: flex; justify-content: space-around; align-items: center;">
                      <a href="/sMasuk/{{ $out->id }}/edit" class="btn btn-primary"><i class="fa fa-edit" ></i></a>
                      <a href="/surat/{{ $out->id }}/masuk/delete" class="btn btn-danger delete-btn" class="fa fa-trash"  data-id="{{ $out->id }}">delete</a>
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
  </div>
               </div>
             </div>
       </div>

       





         <!-- pembuka pengeluaran tambah -->

  <div class="modal" id="myModalTambah">
    <div class="modal-dialog">
      <div class="modal-content">
  
        <!-- Header Modal -->
        <div class="modal-header">
          <h4 class="modal-title">Form Surat masuk</h4>
          <button type="button" class="close" data-dismiss="modal" >&times;</button>
        </div>
  
        <!-- Body Modal -->
        <div class="modal-body">
          <!-- Isi form di sini -->
          <form action="/sMasuk" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="pengirim">pengirim:</label>
            <input type="text" id="pengirim" name="pengirim" class="form-control" required>
            <label for="nomorSuratM">NO.Surat:</label>
            <input type="text" id="nomorSuratM" name="nomorSuratM" class="form-control" required>
            <label for="judulSuratM">judul surat:</label>
            <input type="text" id="judulSuratM" name="judulSuratM" class="form-control" required>
            <label for="tglSuratM">tanggal:</label>
            <input type="date" id="tglSuratM" name="tglSuratM" class="form-control" required>
            <label for="isiSuratM">Keterangan:</label>
            <input type="text" id="isiSuratM" name="isiSuratM" class="form-control" required>
            <label for="fileSuratM">file:</label>
            <input type="file" id="fileSuratM" name="fileSuratM" class="form-control" required>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success" >Simpan</button>
            </div>
            <!-- Tambahkan elemen form lainnya sesuai kebutuhan -->
          </form>
        </div>
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
                window.location.href = '/surat/' + id + '/masuk/delete';
              }
            });
          });
        });
      </script>
      
              


@endsection
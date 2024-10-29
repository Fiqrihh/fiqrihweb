@extends('lyout.leotuang')

@section('contener')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-4 mb-4 mx-auto">
        <!-- Search Form -->
        <form action="/sKeluar" class="form-inline">
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

<div class="container-fluid">
  <!-- Content Row -->
         <div class="row">

           <!-- Content Column -->
           <div class="col-lg-12 mb-4">

             <!-- Project Card Example -->
             <div class="card shadow mb-4">
               <div class="card-header py-3">
                 <h6 class="m-0 font-weight-bold text-center">Surat Keluar</h6>
                 <button type="button" class="btn btn-success" style="margin:5px" data-toggle="modal" data-target="#myModalTambah"><i class="fa fa-plus">Surat Keluar</i></button>
               </div>
               <div class="card-body">
                {{ $surat->links() }}

                 <div class="table-responsive">
                   <table class="table">
                 <thead>
                   <tr>
                    
                     <th scope="col">No</th>
                     <th scope="col">Penerima</th>
                     <th scope="col">Judul</th>
                     <th scope="col">Nomor</th>
                     <th scope="col">Tanggal</th>
                     <th scope="col" class="text-center">Aksi</th>

                   </tr>
                   
                 </thead>
                
                 <tbody>
                   @foreach ($surat as $out)
                 
                   <tr>
                     <td>{{ $loop->index + 1 }}</td>
                     <td>{{ $out->Penerima }}</td>
                     <td>{{ $out->judulSuratK	 }}</td>
                     <td>{{ $out->nomorSuratK }}</td>
                     <td>{{ $out->tglSuratK }}</td>
                     <td class=" align-middle" style="display: flex; justify-content: space-around; align-items: center;">
                      <a href="/sKeluar/{{ $out->id }}/edit" class="btn btn-primary"><i class="fa fa-edit" ></i></a> 
                      <a href="/sKeluar/{{ $out->id }}/print" class="btn btn-info fa fa-print" target="_blank" ></a>
                      <a href="/sKeluar/{{ $out->id }}/delete" class="btn btn-danger delete-btn" class="fas fa-trash-alt"  data-id="{{ $out->id }}">X</a>
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
          <form action="/sKeluar" method="POST" enctype="multipart/form-data">
            @csrf

            <form id="formSurat">
              <div class="form-group">
                <label for="nomorSuratK">Nomor Surat</label>
                <input type="text" class="form-control" id="nomorSuratK" name="nomorSuratK" required>
              </div>
              <div class="form-group">
                <label for="judulSuratK">Perihal</label>
                <input type="text" class="form-control" id="judulSuratK" name="judulSuratK" required>
              </div>
              <div class="form-group">
                <label for="penerima">Penerima</label>
                <input type="text" class="form-control" id="penerima" name="penerima" required>
              </div>
              <div class="form-group">
                <label for="tempat">tempat tujuan</label>
                <input type="text" class="form-control" id="tempat" name="tempat" required>
              </div>
              <div class="form-group">
                <label for="fileSuratK">penanggung jawab</label>
                <input type="text" class="form-control" id="fileSuratK" name="fileSuratK" required>
              </div>
              <div class="form-group">
                <label for="tglSuratK">Tanggal Surat</label>
                <input type="date" class="form-control" id="tglSuratK" name="tglSuratK" required>
              </div>
              
              <div class="form-group">
                <label for="isiSuratK">Isi Surat</label>
                <textarea class="form-control" id="isiSuratK" name="isiSuratK" rows="4" required></textarea>
              </div>


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
                window.location.href = '/sKeluar/' + id + '/delete';
              }
            });
          });
        });
      </script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Ambil jumlah surat dari elemen dengan ID 'totalSurat' atau sesuaikan dengan cara lain
    var totalSurat = {{ $surat->count() }};

    // Isi otomatis nomor surat dengan menambah 1 ke jumlah surat yang ada
    var nomorSurat = totalSurat + 1;

    // Format nomor surat dengan menambah nol di depannya
    var nomorSuratFormatted = ('000' + nomorSurat).slice(-3); // Tambahkan nol di depan dan ambil tiga digit terakhir

    // Masukkan nomor surat yang diformat ke dalam input 'nomorSuratK'
    document.getElementById('nomorSuratK').value = nomorSuratFormatted;

    // Mengunci input nomor surat agar tidak bisa diubah oleh pengguna
    document.getElementById('nomorSuratK').readOnly = true;
});

</script>

      
              


@endsection
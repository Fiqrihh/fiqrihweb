@extends('lyout.leotuang')

@section('contener')
<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-md-4 mb-4">
        <!-- Search Form -->
        <form action="/murid" class="form-inline">
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
          <h5 class="m-0 font-weight-bold  text-center">Daftar murid</h5>
          {{-- <button type="button" class="btn btn-success"  data-toggle="modal" data-target="#myModalTambah">
            <i class="fa fa-plus"> Tambah data Siswa</i>
        </button> --}}
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
                  <th class="text-center align-middle">Tingkatan</th>
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
                      <td class="text-center align-middle">{{ $anak->status }}</td>
                      <td class="text-center align-middle">{{ $anak->tanggal_lahir }}</td>
                      <td class="text-center align-middle">{{ $anak->n_kelas }}</td>
                      <td class="text-center align-middle">
                        <a href="" class="btn btn-primary" data-toggle="modal" data-target="#myModalEdit{{ $anak->id_murid }}" style="font-size: 10px"><i class='bx bx-edit'></i></a> 
                      <a href="/murid/{{ $anak->id }}/delete" class="btn btn-danger delete-btn  btn-sm" class="fa fa-trash" data-id={{ $anak->id }}>delete</a>
                      <button class="btn btn-warning" data-toggle="modal" data-target="#verificationModal{{ $anak->id_murid }}" style="font-size: 10px">Verifikasi</button>  
                    </td>                  
                    </tr>
                  @endforeach
            </tbody>
            </table>
          <nav aria-label="Page navigation example">
              <ul class="pagination justify-content-center">
                  @if ($pelajarJ->onFirstPage())
                      <li class="page-item disabled">
                          <a class="page-link">Previous</a>
                      </li>
                  @else
                      <li class="page-item">
                          <a class="page-link" href="{{ $pelajarJ->previousPageUrl() }}">Previous</a>
                      </li>
                  @endif
  
                  @for ($i = 1; $i <= $pelajarJ->lastPage(); $i++)
                      @if ($i == $pelajarJ->currentPage())
                          <li class="page-item active" aria-current="page">
                              <a class="page-link" href="#">{{ $i }}</a>
                          </li>
                      @else
                          <li class="page-item"><a class="page-link" href="{{ $pelajarJ->url($i) }}">{{ $i }}</a></li>
                      @endif
                  @endfor
  
                  @if ($pelajarJ->hasMorePages())
                      <li class="page-item">
                          <a class="page-link" href="{{ $pelajarJ->nextPageUrl() }}">Next</a>
                      </li>
                  @else
                      <li class="page-item disabled">
                          <a class="page-link">Next</a>
                      </li>
                  @endif
              </ul>
          </nav>
            
            </div>
            
            </div>
                <!-- "Tambah data Siswa" Button -->
                
          
            <div class="modal" id="myModalTambah">
            <div class="modal-dialog">
            <div class="modal-content">

                <!-- Header Modal -->
        <div class="modal-header">
          <h4 class="modal-title">tambah Data Siswa</h4>
          <button type="button" class="close" data-dismiss="modal" >&times;</button>
        </div>
  
        <!-- Body Modal -->
        <div class="modal-body">
          <!-- Isi form di sini -->
          <form action="/murid" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="nama_lengkap">Nama:</label>
            <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" required>
            <label for="alamat">Alamat:</label>
            <input type="text" id="alamat" name="alamat" class="form-control" required>
            <label for="nohp">No hp:</label>
            <input type="text" id="nohp" name="nohp" class="form-control" required>
            <label for="jenis_kelamin">Jenis Kelamin:</label>
            <select id="jenis_kelamin" name="jenis_kelamin" class="form-control" required>
              <option value="Laki-laki">Laki-laki</option>
              <option value="Perempuan">Perempuan</option>
          </select>
            <label for="status">Status:</label>
            <select id="status" name="status" class="form-control" required>
                <option value="Verifikasi">Verifikasi</option>
                <option value="belum_verifikasi" >belum_verifikasi</option>
            </select>
          </select>
          <label for="id_kelas">Kelas:</label>
          {{-- <select id="id_kelas" name="id_kelas" class="form-control" required>
              <option value="1" {{ $item->kelas->id_kelas == 1 ? 'selected' : '' }}>Dasar</option>
              <option value="2" {{ $item->kelas->id_kelas == 2 ? 'selected' : '' }}>Menengah</option>
              <option value="3" {{ $item->kelas->id_kelas == 3 ? 'selected' : '' }}>Lanjutan</option>
          </select> --}}
          
          </select>
          <label for="username">Nomor murid </label>
          <input type="text" id="username" name="username" class="form-control" required>
            <label for="tanggal_lahir">tanggal Lahir:</label>
            <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control" required>
          

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

      
{{-- Modal Edit Data --}}
@foreach ($pelajarJ as $item)
<div class="modal" id="myModalEdit{{ $item->id_murid }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Header Modal -->
            <div class="modal-header">
                <h4 class="modal-title">Edit Data siswa</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Body Modal -->
            <div class="modal-body">
                <form action="/murid/edit/{{ $item->id_murid }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                  
                    <!-- Isi form dengan data yang ingin di-edit -->
            <label for="nama_lengkap">Nama:</label>
            <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" value="{{ $item->nama_lengkap }}" required>
            <label for="alamat">Alamat:</label>
            <input type="text" id="alamat" name="alamat" class="form-control" value="{{ $item->alamat }}" required>
            <label for="nohp">No hp:</label>
            <input type="text" id="nohp" name="nohp" class="form-control" value="{{ $item->nohp }}" required>
            <label for="jenis_kelamin">Jenis Kelmain:</label>
            <select id="jenis_kelamin" name="jenis_kelamin" class="form-control" required>
              <option value="Laki-laki" {{ $item->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
              <option value="Perempuan" {{ $item->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
          </select>
          <label for="status">Status:</label>
          <select id="status" name="status" class="form-control" required>
              <option value="Verifikasi" {{ $item->status == 'Verifikasi' ? 'selected' : '' }}>Verifikasi</option>
              <option value="belum_verifikasi" {{ $item->status == 'belum_verifikasi' ? 'selected' : '' }}>belum_verifikasi</option>
          </select>
          <label for="id_kelas" name="id_kelas">Kelas:</label>
          <select id="id_kelas" name="id_kelas" class="form-control" required>
            @foreach ($kelas as $kelasItem)
                <option value="{{ $kelasItem->id_kelas }}" {{ $item->kelas && $item->kelas->id_kelas == $kelasItem->id_kelas ? 'selected' : '' }}>
                    {{ $kelasItem->n_kelas }}
                </option>
            @endforeach
        </select>
        
          {{-- <label for="id_kelas">Kelas:</label>
          <select id="id_kelas" name="id_kelas" class="form-control" required>
            @foreach ($kelas as $kelas)
                <option value="{{ $kelas->id_kelas }}" {{ $item->kelas && $item->kelas->id_kelas == $kelas->id_kelas ? 'selected' : '' }}>
                    {{ $kelas->n_kelas }}
                </option>
            @endforeach
        </select> --}}
        
            <label for="username">Nomor murid </label>
            <input type="text" id="username" name="username" class="form-control" value="{{ $item->username ?: date('Ym', strtotime($item->created_at)) . sprintf('%02d', $loop->index + 1) }}" required>

              <label for="tanggal_lahir">tanggal Lahir:</label>
              <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control" value="{{ $item->tanggal_lahir }}" required>
            
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="verificationModal{{ $item->id_murid }}" tabindex="-1" role="dialog" aria-labelledby="verificationModalLabel{{ $item->id_murid }}" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="verificationModalLabel{{ $item->id_murid}}">Verifikasi Akun</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Apakah Anda yakin ingin memverifikasi akun ini?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <a href="/murid/{{$item->id_murid}}/verifikasi" class="btn btn-success">Verifikasi</a>
        <a href="/murid/{{ $item->id_murid }}/tidak-verifikasi" class="btn btn-danger">Tolak</a>
      </div>
    </div>
  </div>
</div>

@endforeach



<div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">Status Pendaftaran</h5>
    <h6 id="status-pendaftaran" class="card-subtitle mb-2 text-muted">
      {{ $pendaftaran->status ?? 'DITUTUP' }}
    </h6>
    <h6 id="teks-pendaftaran" class="card-subtitle mb-2 text-muted">
      {{ $pendaftaran->teks_pendaftaran ?? 'pendaftaran sedang di tutup' }}
    </h6>
    <p class="card-text">
      <button type="button" class="btn btn-primary" onclick="togglePendaftaran('buka')">Buka</button>
      <button type="button" class="btn btn-secondary" onclick="togglePendaftaran('tutup')">Tutup</button>
    </p>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function togglePendaftaran(status) {
        $.ajax({
            url: "{{ route('toggle.pendaftaran') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                status: status
            },
            success: function(response) {
                if (response.success) {
                    $('#status-pendaftaran').text(response.status.toUpperCase());
                    $('#teks-pendaftaran').text(response.teks_pendaftaran);
                }
            }
        });
    }
</script>

      
      {{-- @if(session('success'))
<div class="alert alert-success" id="success-alert">
    {{ session('success') }}
</div>
@endif

<!-- Bagian Notifikasi untuk Kesalahan -->
@if(session('error'))
<div class="alert alert-danger" id="error-alert">
    {{ session('error') }}
</div>
@endif --}}

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
          window.location.href = '/murid/' + id + '/delete';
        }
      });
    });
  });
</script>

    
@endsection

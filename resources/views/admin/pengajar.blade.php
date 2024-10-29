@extends('lyout.leotuang')

@section('contener')

<div class="container-fluid">
  <div class="row  justify-content-center">
    <div class="col-md-4 mb-4">
      <!-- Search Form -->
      <form action="/data-pengajar" class="form-inline">
          <div class="input-group">
              <input type="text" class="form-control" placeholder="Nama/No Pengajar" name="cari" value="{{ request('cari') }}">
              <div class="input-group-append">
                  <button class="btn btn-primary" type="submit" id="button-addon2">Cari</button>
              </div>
          </div>
      </form>
  </div>
  </div>



<div class="container">
  <div class="card">
      <div class="card-body">
          <button type="button" class="btn btn-success"  data-toggle="modal" data-target="#myModalTambah">
              <i class="fa fa-plus"> data pengajar</i>
          </button>
          <h5 class="card-title text-center">data Pengajar</h5>
          <div class="table-responsive">
              <table class="table table-bordered">
                  <thead>
                      <tr>
                          <th class="text-center align-middle">NO</th>
                          <th class="text-center align-middle">nama_pengajar</th>
                          <th class="text-center align-middle">no_pengajar</th>
                          <th class="text-center align-middle">alamat pengajar</th>
                          <th class="text-center align-middle">tgl_lahir</th>
                          <th class="text-center align-middle">no_hp</th>
                          <th class="text-center align-middle">kelamin</th>
                          <th class="text-center align-middle">aksi</th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr>
                          @forelse ($peng as $item)
                          <td class="text-center align-middle">{{ $loop->index + 1 }}</td>
                          <td class="text-center align-middle">{{ $item->namaP }}</td>
                          <td class="text-center align-middle">{{ $item->username }}</td>
                          <td class="text-center align-middle">{{ $item->Alamat }}</td>
                          <td class="text-center align-middle">{{ $item->tgl_lahirP }}</td>
                          <td class="text-center align-middle">{{ $item->No_hp_pengajar }}</td>
                          <td class="text-center align-middle">{{ $item->jenis_kelaminP }}</td>
                          <td class="text-center align-middle">
                              <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#myModalEdit{{ $item->id_pengajar }}"><i class='bx bx-edit'></i></a>
                              <a href="/data-pengajar/{{ $item->id_pengajar }}/hapus" class="btn btn-danger delete-btn" class="fa fa-trash" ><i class='bx bx-trash'></i></a>
                          </td>
                      </tr>
                      @empty
                      <tr>
                          <td colspan="8" class="text-center">Tidak ada data yang ditemukan.</td>
                      </tr>
                      @endforelse
                      <!-- More rows as needed -->
                  </tbody>
              </table>
              <nav aria-label="Page navigation example">
                  <ul class="pagination justify-content-center">
                      @if ($peng->onFirstPage())
                          <li class="page-item disabled">
                              <a class="page-link">Previous</a>
                          </li>
                      @else
                          <li class="page-item">
                              <a class="page-link" href="{{ $peng->previousPageUrl() }}">Previous</a>
                          </li>
                      @endif
      
                      @for ($i = 1; $i <= $peng->lastPage(); $i++)
                          @if ($i == $peng->currentPage())
                              <li class="page-item active" aria-current="page">
                                  <a class="page-link" href="#">{{ $i }}</a>
                              </li>
                          @else
                              <li class="page-item"><a class="page-link" href="{{ $peng->url($i) }}">{{ $i }}</a></li>
                          @endif
                      @endfor
      
                      @if ($peng->hasMorePages())
                          <li class="page-item">
                              <a class="page-link" href="{{ $peng->nextPageUrl() }}">Next</a>
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
  </div>
  </div>
</div>
</div>


{{-- model tambah --}}

<div class="modal" id="myModalTambah">
  <div class="modal-dialog">
  <div class="modal-content">

      <!-- Header Modal -->
<div class="modal-header">
<h4 class="modal-title">tambah Data pengajar</h4>
<button type="button" class="close" data-dismiss="modal" >&times;</button>
</div>

<!-- Body Modal -->
<div class="modal-body">
<!-- Isi form di sini -->
<form action="/data-pengajar" method="POST" enctype="multipart/form-data">
  @csrf
  <label for="namaP">nama:</label>
  <input type="text" id="namaP" name="namaP" class="form-control" required>
  <label for="Alamat">Alamat:</label>
  <input type="text" id="Alamat" name="Alamat" class="form-control" required>
  <label for="tgl_lahirP">Tanggal lahir:</label>
  <input type="date" id="tgl_lahirP" name="tgl_lahirP" class="form-control" required>
  <label for="No_hp_pengajar">no hp:</label>
  <input type="text" id="No_hp_pengajar" name="No_hp_pengajar" class="form-control" required>
  <label for="No_hp_pengajar">Jenis Kelamin:</label>
  <select id="jenis_kelaminP" name="jenis_kelaminP" class="form-control" required>
    <option value="">Pilih Jenis Kelamin</option>
    <option value="Laki-laki">Laki-laki</option>
    <option value="perempuan">Perempuan</option>
</select>
<label for="username">no pengajar:</label>
<input type="text" id="username" name="username" class="form-control" required>
<label for="password">password:</label>
<input type="text" id="password" name="password" class="form-control" required>



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

{{-- edit modal --}}
@foreach ($pen as $item)
<div class="modal" id="myModalEdit{{ $item->id_pengajar }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Header Modal -->
            <div class="modal-header">
                <h4 class="modal-title">Edit Data pengajar</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Body Modal -->
            <div class="modal-body">
                <form action="/data-pengajar/{{ $item->id_pengajar }}/edit" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                  
                    <!-- Isi form dengan data yang ingin di-edit -->
                    <label for="namaP">nama:</label>
                    <input type="text" id="namaP" name="namaP" class="form-control" value="{{ $item->namaP }}" required>
                    <label for="Alamat">Alamat:</label>
                    <input type="text" id="Alamat" name="Alamat" class="form-control"  value="{{ $item->Alamat }}" required>
                    <label for="tgl_lahirP">Tanggal lahir:</label>
                    <input type="date" id="tgl_lahirP" name="tgl_lahirP" class="form-control"  value="{{ $item->tgl_lahirP }}"  required>
                    <label for="No_hp_pengajar">no hp:</label>
                    <input type="text" id="No_hp_pengajar" name="No_hp_pengajar" class="form-control" value="{{ $item->No_hp_pengajar }}" required>
                    <label for="No_hp_pengajar">Jenis Kelamin:</label>
                    <select id="jenis_kelaminP" name="jenis_kelaminP" class="form-control" required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="perempuan">Perempuan</option>
                    </select>
                  <label for="username">no pengajar:</label>
                  <input type="text" id="username" name="username" class="form-control" value="{{ $item->username }}" required>
                 
                  <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

    @endforeach

  


@endsection
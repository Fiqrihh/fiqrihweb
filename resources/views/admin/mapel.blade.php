@extends('lyout.leotuang')

@section('contener')
<div class="container-fluid">
    <div class="row  justify-content-center">
      <div class="col-md-4 mb-4">
        <!-- Search Form -->
        <form action="/mapel" class="form-inline">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="cari.." name="cari" value="{{ request('cari') }}">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit" id="button-addon2">Cari</button>
                </div>
            </div>
        </form>
    </div>
    </div>

    <div class="container">
        <div class="card" style="width: 80%;">
            <div class="card-body">
                <button type="button" class="btn btn-success"  data-toggle="modal" data-target="#myModalTambah" style="margin-bottom: 1rem">
                    <i class="fa fa-plus"> Mata Pelajaran</i>
                </button>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center align-middle">NO</th>
                                <th class="text-center align-middle">nama_mapel</th>
                                <th class="text-center align-middle">nama_pengajar</th>
                                <th class="text-center align-middle">Tingkatan</th>
                                <th class="text-center align-middle">aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @forelse ($mapl as $item)
                                <td class="text-center align-middle">{{ $loop->index + 1 }}</td>
                                <td class="text-center align-middle">{{ $item->nama_mapel }}</td>
                                <td class="text-center align-middle">{{ $item->namaP }}</td>
                                <td class="text-center align-middle">{{ $item->n_kelas }}</td>
                                <td class="text-center align-middle">
                                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#myModalEdit{{ $item->id_mapel }}"><i class='bx bx-edit'></i></a>
                                    <a href="/mapel/{{ $item->id_mapel }}/hapus" class="btn btn-danger delete-btn" class="fa fa-trash" ><i class='bx bx-trash'></i></a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada data yang ditemukan.</td>
                            </tr>
                            @endforelse
                            <!-- More rows as needed -->
                        </tbody>
                    </table>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            @if ($mapl->onFirstPage())
                                <li class="page-item disabled">
                                    <a class="page-link">Previous</a>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $mapl->previousPageUrl() }}">Previous</a>
                                </li>
                            @endif
            
                            @for ($i = 1; $i <= $mapl->lastPage(); $i++)
                                @if ($i == $mapl->currentPage())
                                    <li class="page-item active" aria-current="page">
                                        <a class="page-link" href="#">{{ $i }}</a>
                                    </li>
                                @else
                                    <li class="page-item"><a class="page-link" href="{{ $mapl->url($i) }}">{{ $i }}</a></li>
                                @endif
                            @endfor
            
                            @if ($mapl->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $mapl->nextPageUrl() }}">Next</a>
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

    
<div class="modal" id="myModalTambah">
    <div class="modal-dialog">
    <div class="modal-content">

        <!-- Header Modal -->
<div class="modal-header">
  <h4 class="modal-title">tambah Data Mapel</h4>
  <button type="button" class="close" data-dismiss="modal" >&times;</button>
</div>

<!-- Body Modal -->
<div class="modal-body">
  <!-- Isi form di sini -->
  <form action="/mapel" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="nama_mapel">nama_mapel:</label>
    <input type="text" id="nama_mapel" name="nama_mapel" class="form-control" required>
    <label for="id_pengajar">Pengajar:</label>
    <select id="id_pengajar" name="id_pengajar" class="form-control" required>
        <option>Pilih Pengajar</option>
        @foreach($peng as $pengajar)
            <option value="{{ $pengajar->id_pengajar }}">{{ $pengajar->namaP }}</option>
        @endforeach
    </select>
    <label for="id_kelas">tingkatan :</label>
    <select id="id_kelas" name="id_kelas" class="form-control" required>
        <option value="" disabled selected>Pilih Kelas</option>
        @foreach($kelas as $kl)
            <option value="{{ $kl->id_kelas }}">{{ $kl->n_kelas }}</option>
        @endforeach
    </select>

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


{{-- Modal Edit Data --}}
@foreach ($mpl as $item)
<div class="modal" id="myModalEdit{{ $item->id_mapel }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Header Modal -->
            <div class="modal-header">
                <h4 class="modal-title">Edit Data mapel</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Body Modal -->
            <div class="modal-body">
                <form action="/mapel/{{ $item->id_mapel }}/edit" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                  
                    <!-- Isi form dengan data yang ingin di-edit -->
                    <label for="nama_mapel">mapel:</label>
                    <input type="text" id="nama_mapel" name="nama_mapel" class="form-control" value="{{ $item->nama_mapel }}" required>
                    <label for="id_pengajar">pengajar:</label>
                    <select id="id_pengajar" name="id_pengajar" class="form-control" required>
                        @foreach($peng as $pengajar)
                            <option value="{{ $pengajar->id_pengajar }}" {{ $item->id_pengajar == $pengajar->id_pengajar ? 'selected' : '' }}>
                                {{ $pengajar->namaP }}
                            </option>
                        @endforeach
                    </select>
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
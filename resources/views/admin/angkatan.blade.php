@extends('lyout.leotuang')

@section('contener')


<div class="container-fluid">
    <div class="row  justify-content-center">
      <div class="col-md-4 mb-4">
        <!-- Search Form -->
        <form action="/angkatan" class="form-inline">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="cari.." name="cari" value="{{ request('cari') }}">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit" id="button-addon2">Cari</button>
                </div>
            </div>
        </form>
    </div>
    </div>

<div class="card" style="width: 40rem; margin-left:14%;">
    <div class="card-body">
      <h5 class="card-title" class="text-center align-middle">Manajemen Periode</h5>
      <button type="button" class="btn btn-success"  data-toggle="modal" data-target="#myModalTambah">
        <i class="fa fa-plus"> data periode</i>
    </button>
    
      <div class="card">
        <div class="card-body">
            <h5 class="card-title">data Periode Per Triwulan</h5>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center align-middle">NO</th>
                            <th class="text-center align-middle">Tahun</th>
                            <th class="text-center align-middle">Bulan</th>
                            <th class="text-center align-middle">aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @forelse ($period as $item)
                            <td class="text-center align-middle">{{ $loop->index + 1 }}</td>
                            <td class="text-center align-middle">{{ $item->tahun }}</td>
                            <td class="text-center align-middle">{{ $item->bulan }}</td>
                            <td class="text-center align-middle">
                                <a href="" class="btn btn-primary" data-toggle="modal" data-target="#myModalEdit{{ $item->id_angkatan }}"><i class='bx bx-edit'></i></a>
                                <a href="/angkatan/{{ $item->id_angkatan }}/hapus" class="btn btn-danger delete-btn" class="fa fa-trash" ><i class='bx bx-trash'></i></a>
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
                        @if ($period->onFirstPage())
                            <li class="page-item disabled">
                                <a class="page-link">Previous</a>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $period->previousPageUrl() }}">Previous</a>
                            </li>
                        @endif
        
                        @for ($i = 1; $i <= $period->lastPage(); $i++)
                            @if ($i == $period->currentPage())
                                <li class="page-item active" aria-current="page">
                                    <a class="page-link" href="#">{{ $i }}</a>
                                </li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $period->url($i) }}">{{ $i }}</a></li>
                            @endif
                        @endfor
        
                        @if ($period->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $period->nextPageUrl() }}">Next</a>
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
  
{{-- model tambah --}}

<div class="modal" id="myModalTambah">
    <div class="modal-dialog">
    <div class="modal-content">

        <!-- Header Modal -->
<div class="modal-header">
  <h4 class="modal-title">tambah Data angkatan</h4>
  <button type="button" class="close" data-dismiss="modal" >&times;</button>
</div>

<!-- Body Modal -->
<div class="modal-body">
  <!-- Isi form di sini -->
  <form action="/angkatan" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="tahun">Tahun:</label>
    <input type="text" id="tahun" name="tahun" class="form-control" required>
    <label for="bulan">Bulan:</label>
    <input type="text" id="bulan" name="bulan" class="form-control" required>
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
@foreach ($periode as $item)
<div class="modal" id="myModalEdit{{ $item->id_angkatan }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Header Modal -->
            <div class="modal-header">
                <h4 class="modal-title">Edit Data Periode</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Body Modal -->
            <div class="modal-body">
                <form action="/angkatan/edit/{{ $item->id_angkatan }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                  
                    <!-- Isi form dengan data yang ingin di-edit -->
                    <label for="edit-tahun">Tahun:</label>
                    <input type="text" id="edit-tahun" name="tahun" class="form-control" value="{{ $item->tahun }}" required>
                    <label for="edit-bulan">Bulan:</label>
                    <input type="text" id="edit-bulan" name="bulan" class="form-control" value="{{ $item->bulan }}" required>
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
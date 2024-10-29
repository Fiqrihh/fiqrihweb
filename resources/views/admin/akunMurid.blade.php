@extends('lyout.leotuang')

@section('contener')
    
<div class="container-fluid">
    <div class="row  justify-content-center">
      <div class="col-md-4 mb-4">
        <!-- Search Form -->
        <form action="/akun-murid" class="form-inline">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="cari.." name="cari" value="{{ request('cari') }}">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit" id="button-addon2">Cari</button>
                </div>
            </div>
        </form>
    </div>
    </div>
  
<div class="container-fluid">
    <div class="row justify-content-center">
    <div class="card" style="width:80%">
       
        <div class="card-body">
            {{-- <button type="button" class="btn btn-success"  data-toggle="modal" data-target="#myModalTambah">
                <i class="fa fa-plus"> data murid</i>
            </button> --}}
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center align-middle">NO</th>
                            <th class="text-center align-middle">nama murid</th>
                            <th class="text-center align-middle">no murid</th>
                            <th class="text-center align-middle">aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @forelse ($murid1 as $item)
                            <td class="text-center align-middle">{{ $loop->index + 1 }}</td>
                            <td class="text-center align-middle">{{ $item->nama_lengkap }}</td>
                            <td class="text-center align-middle">{{ $item->username }}</td>
                            <td class="text-center align-middle">
                                <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#myModalEdit{{ $item->id_murid }}"><i class='bx bx-reset'></i>reset password</i></a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data yang ditemukan.</td>
                        </tr>
                        @endforelse
                        <!-- More rows as needed -->
                    </tbody>
                </table>
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        @if ($murid1->onFirstPage())
                            <li class="page-item disabled">
                                <a class="page-link">Previous</a>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $murid1->previousPageUrl() }}">Previous</a>
                            </li>
                        @endif
        
                        @for ($i = 1; $i <= $murid1->lastPage(); $i++)
                            @if ($i == $murid1->currentPage())
                                <li class="page-item active" aria-current="page">
                                    <a class="page-link" href="#">{{ $i }}</a>
                                </li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $murid1->url($i) }}">{{ $i }}</a></li>
                            @endif
                        @endfor
        
                        @if ($murid1->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $murid1->nextPageUrl() }}">Next</a>
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
  </div>

  {{-- modal tambah akun --}}
  <div class="modal" id="myModalTambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Header Modal -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah akun murid</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="/add-Murid" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="nama_lengkap">Nama murid:</label>
                        <select id="nama_lengkap" name="nama_lengkap" class="form-control" required>
                            <option value="" selected disabled>Pilih murid</option>
                            @foreach($murid2 as $murid)
                            @if(empty($murid->password)) {{-- tampilkan jika tidak memiliki password --}}
                            <option value="{{ $murid->id_murid }}" data-nomormurid="{{ $murid->username }}">{{ $murid->nama_lengkap }}</option>
                        @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="username">No Murid:</label>
                        <input type="text" id="username" name="username" class="form-control" required readonly>
                    </div>
                    <div class="form-group">
                        <label for="password">Kata Sandi:</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
  
  {{-- modal reset pw akun --}}
  @foreach ($murid2 as $item)
  <div class="modal" id="myModalEdit{{ $item->id_murid }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Header Modal -->
            <div class="modal-header">
                <h4 class="modal-title">ganti password</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="/brbresetpassword" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="nama_lengkap">Nama murid:</label>
                        <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" value="{{ $item->nama_lengkap }}" required readonly>
                    </div>
                    <div class="form-group">
                        <label for="username">No murid:</label>
                        <input type="text" id="username" name="username" class="form-control" value="{{ $item->username }}" required readonly>
                    </div>
                    <div class="form-group">
                        <label for="password">Kata Sandi Baru:</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

<script>
    $(document).ready(function() {
    $('#nama_lengkap').change(function() {
        var nomor_murid = $(this).find(':selected').data('nomormurid');
        $('#username').val(nomor_murid);
    });
});
</script>

@endsection
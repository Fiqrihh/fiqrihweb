@extends('lyout.leotuang')

@section('contener')
    
<div class="container-fluid">
    <div class="row  justify-content-center">
      <div class="col-md-4 mb-4">
        <!-- Search Form -->
        <form action="/akun-pengajar" class="form-inline">
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
            
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center align-middle">NO</th>
                            <th class="text-center align-middle">nama_pengajar</th>
                            <th class="text-center align-middle">no_pengajar</th>
                            <th class="text-center align-middle">aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @forelse ($pngaja as $item)
                            <td class="text-center align-middle">{{ $loop->index + 1 }}</td>
                            <td class="text-center align-middle">{{ $item->namaP }}</td>
                            <td class="text-center align-middle">{{ $item->username }}</td>
                            <td class="text-center align-middle">
                                <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#myModalEdit{{ $item->id_pengajar }}"><i class='bx bx-reset'></i>reset password</i></a>
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
                        @if ($pngaja->onFirstPage())
                            <li class="page-item disabled">
                                <a class="page-link">Previous</a>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $pngaja->previousPageUrl() }}">Previous</a>
                            </li>
                        @endif
        
                        @for ($i = 1; $i <= $pngaja->lastPage(); $i++)
                            @if ($i == $pngaja->currentPage())
                                <li class="page-item active" aria-current="page">
                                    <a class="page-link" href="#">{{ $i }}</a>
                                </li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $pngaja->url($i) }}">{{ $i }}</a></li>
                            @endif
                        @endfor
        
                        @if ($peng->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $pngaja->nextPageUrl() }}">Next</a>
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
                <h4 class="modal-title">Tambah akun Pengajar</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <form action="/update-pengajar" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="namaP">Nama Pengajar:</label>
                        <select id="namaP" name="namaP" class="form-control" required>
                            <option value="" selected disabled>Pilih Pengajar</option>
                            @foreach($peng as $pengajar)
                            @if(empty($pengajar->password)) {{-- tampilkan jika tidak memiliki password --}}
                            <option value="{{ $pengajar->id_pengajar }}" data-nopengajar="{{ $pengajar->username }}">{{ $pengajar->namaP }}</option>
                        @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="username">No Pengajar:</label>
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
  @foreach ($pengS as $item)
  <div class="modal" id="myModalEdit{{ $item->id_pengajar }}">
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
                        <label for="namaP">Nama pengajar:</label>
                        <input type="text" id="namaP" name="namaP" class="form-control" value="{{ $item->namaP }}" required readonly>
                    </div>
                    <div class="form-group">
                        <label for="username">No Pengajar:</label>
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
    // Menghilangkan notifikasi setelah 3 detik
    setTimeout(function() {
        var notification = document.getElementById('notification');
        if (notification) {
            notification.style.display = 'none';
        }
    }, 3000);
</script>

@endsection
@extends('lyout/leotuang')

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
                <h5 class="m-0 font-weight-bold text-center">Daftar Kelas</h5>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModalTambah">
                    <i class="fa fa-plus"></i>
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center align-middle">No</th>
                                <th class="text-center align-middle">Tingkatan</th>
                                <th class="text-center align-middle">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kelas as $kl)
                                <tr>
                                    <td class="text-center align-middle">{{ $loop->index + 1 }}</td>
                                    <td class="text-center align-middle">{{ $kl->n_kelas }}</td>
                                    <td class="text-center align-middle">
                                        <a href="" class="btn btn-primary" data-toggle="modal" data-target="#myModalEdit{{ $kl->id_kelas }}">
                                            <i class='bx bx-edit'></i>
                                        </a>
                                        <a href="/kelas/{{ $kl->id_kelas }}/murid" class="btn btn-info info-btn btn-sm">
                                            <i class='bx bxs-school'>cek murid</i>
                                        </a>
                                        
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>
            </div>

            {{-- Modal Tambah --}}
            <div class="modal" id="myModalTambah">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Header Modal -->
                        <div class="modal-header">
                            <h4 class="modal-title">Tambah Data Kelas</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <!-- Body Modal -->
                        <div class="modal-body">
                            <form action="/Mkelas" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="n_kelas">Tingkatan:</label>
                                    <input type="text" id="n_kelas" name="n_kelas" class="form-control" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                </div>
                            </form>
                        </div>
                        <!-- Footer Modal -->
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


{{-- Modal Edit Data --}}
@foreach ($kelass as $item)
<div class="modal" id="myModalEdit{{ $item->id_kelas }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Header Modal -->
            <div class="modal-header">
                <h4 class="modal-title">Edit Data kelas</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Body Modal -->
            <div class="modal-body">
                <form action="/Mkelas/{{ $item->id_kelas }}/edit" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                  
                    <!-- Isi form dengan data yang ingin di-edit -->
                    <label for="n_kelas">tingkatan:</label>
                    <input type="text" id="n_kelas" name="n_kelas" class="form-control" value="{{ $item->n_kelas }}" required>
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

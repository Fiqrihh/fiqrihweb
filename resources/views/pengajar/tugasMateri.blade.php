@extends('lyout.leotpengajar')

@section('konten')

<div class="container">
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
<div class="search">
  <div class="row justify-content-center">
    <div class="col-md-4 mb-4">
        <!-- Search Form -->
        <form action="{{ route('materi.byMapel', $mapel->id_mapel) }}" class="form-inline">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="cari.." name="cari" value="{{ request('cari') }}">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit" id="button-addon2">Cari</button>
                </div>
            </div>
        </form>
    </div>

    
    <div class=" tugas-materi">
        <a href="/add-tugas/{{ $mapel->id_mapel }}/add" class="btn btn-success"><i class='bx bxs-file-plus '></i> Tugas</a>
    <div class="table-responsive" >
        <table class="table table-bordered table-striped" style="background-color: white">
            <thead>
                <tr>
                    <th scope="col" class="text-center">No</th>
                    <th scope="col" class="text-center align-middle">mapel</th>
                    <th scope="col" class="text-center align-middle">kelas</th>
                    <th scope="col" class="text-center align-middle">deskripsi</th>
                    <th scope="col" class="text-center align-middle">No tugas</th>
                    <th scope="col" class="text-center align-middle">Date exp</th>
                    <th scope="col" class="text-center align-middle">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($materis as $tugas)
                    <tr>
                        <td class="text-center align-middle">{{ $loop->index + 1 }}</td>
                        <td class="text-center align-middle">{{ $tugas->mapel->nama_mapel }}</td>
                        <td class="text-center align-middle">{{ $tugas->kelas->n_kelas }}</td>
                        <td class="text-center align-middle">{{ $tugas->deskripsi }}</td>
                        <td class="text-center align-middle">{{ $tugas->no_tugas }}</td>
                        <td class="text-center align-middle">{{ $tugas->dateline }}</td>
                        <td class="text-center align-middle">
                            <a href="{{ route('tugas.detail', $tugas->id_tugas) }}" class="btn btn-info btn-sm tgs-btn " title="Detail"><i class='bx bx-detail'></i></a> 
                            <a href="{{ route('tugas.editTugas',  $tugas->id_tugas) }}" class="btn btn-secondary btn-sm tgs-btn" title="edit"><i class='bx bx-edit-alt' ></i></a>
                            <a href="{{ route('tugas.hapus', $tugas->id_tugas) }}" class="btn btn-danger btn-sm tgs-btn" title="hapus"><i class='bx bxs-trash' > </i></a>
                            <a href="{{ route('tugas.detailSiswa', $tugas->id_tugas) }}" class="btn btn-dark btn-sm tgs-btn" title="cek siswa"><i class='bx bx-list-check'></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center">
        {{ $materis->links() }}
</div>
</div>


@endsection

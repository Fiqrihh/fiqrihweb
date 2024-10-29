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
    <div class="col-lg-14 mb-4">
        <div class="card shadow mb-4" style="width:60rem">
            <div class="card-header py-3">
                <h5 class="m-0 font-weight-bold text-center">Daftar murid kelas </h5>
                {{-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModalTambah">
                    <i class="fa fa-plus"></i>
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
                                <th class="text-center align-middle">Nilai Tugas</th>
                                <th class="text-center align-middle">Grade Tugas</th>
                                <th class="text-center align-middle">Nilai Ujian</th>
                                <th class="text-center align-middle">Grade Ujian</th>
                                <th class="text-center align-middle">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kelas as $murid)
                                <tr>
                                    <td class="text-center align-middle">{{ $loop->index + 1 }}</td>
                                    <td class="text-center align-middle">{{ $murid->nama_lengkap }}</td>
                                    <td class="text-center align-middle">{{ $murid->alamat }}</td>
                                    <td class="text-center align-middle">{{ $murid->nilai_tugas }}</td>
                                    <td class="text-center align-middle">
                                        @if ($murid->nilai_tugas >= 90)
                                            A
                                        @elseif ($murid->nilai_tugas >= 80)
                                            B
                                        @elseif ($murid->nilai_tugas >= 68)
                                            C
                                        @elseif ($murid->nilai_tugas >= 50)
                                            D
                                        @else
                                            E
                                        @endif
                                    </td>
                                    <td class="text-center align-middle">{{ $murid->nilai_ujian }}</td>
                                    <td class="text-center align-middle">
                                        @if ($murid->nilai_ujian >= 90)
                                            A
                                        @elseif ($murid->nilai_ujian >= 80)
                                            B
                                        @elseif ($murid->nilai_ujian >= 68)
                                            C
                                        @elseif ($murid->nilai_ujian >= 50)
                                            D
                                        @else
                                            E
                                        @endif
                                    </td>
                                    <td class="text-center align-middle">
                                        @if ($murid->id_kelas < 4)
                                    <form action="{{ route('murid.naikKelas', $murid->id_murid) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Naik Kelas</button>
                                    </form>
                                @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            @if ($kelas->onFirstPage())
                                <li class="page-item disabled">
                                    <a class="page-link">Previous</a>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $kelas->previousPageUrl() }}">Previous</a>
                                </li>
                            @endif

                            @for ($i = 1; $i <= $kelas->lastPage(); $i++)
                                @if ($i == $kelas->currentPage())
                                    <li class="page-item active" aria-current="page">
                                        <a class="page-link" href="#">{{ $i }}</a>
                                    </li>
                                @else
                                    <li class="page-item"><a class="page-link" href="{{ $kelas->url($i) }}">{{ $i }}</a></li>
                                @endif
                            @endfor

                            @if ($kelas->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $kelas->nextPageUrl() }}">Next</a>
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

@endsection

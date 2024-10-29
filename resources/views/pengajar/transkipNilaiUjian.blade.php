@extends('lyout/nilai.transNilai')

@section('konten')


<div class="container mt-5">
    <div class="card mb-3 TranskTugas">
        <div class="card-body">
            <h5 class="card-title">
                <img src="{{ asset('storage/foto-siswa/' . $siswa->fotoSiwa) }}" class="profile-picture">
            </h5>
        </div>
        <div class="tengah">
            <p class="card-text" style="margin-top: 1rem">Nama: {{ $siswa->nama_lengkap }}</p>
            <p class="card-text">Kelas: {{ $siswa->kelas->n_kelas }}</p>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" class="text-center">No</th>
                    <th scope="col" class="text-center">Mapel</th>
                    <th scope="col" class="text-center">kelas</th>
                    <th scope="col" class="text-center">Nilai</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($siswa->jawabanUjian as $index => $jawaban)
                <tr>
                    <td class="text-center align-middle">{{ $loop->iteration }}</td>
                    <td class="text-center align-middle">{{ $jawaban->ujian->mapel->nama_mapel }}</td>
                    <td class="text-center align-middle">{{ $jawaban->kelas->n_kelas}}</td>
                    <td class="text-center align-middle">{{ $jawaban->nilai_ujian}}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">Tidak ada nilai tugas.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
    
@endsection
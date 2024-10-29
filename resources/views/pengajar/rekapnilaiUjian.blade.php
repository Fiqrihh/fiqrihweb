@extends('lyout/nilai.rekapSiswaNilai')

@section('konten')
<div class="container mt-5">
    <h1>Daftar Santri</h1>
    @forelse ($siswa as $item)
        <div class="card mb-3 TranskTugas">
            <div class="card-body">
                <h5 class="card-title"><img src="{{ asset('storage/foto-siswa/' . $item->fotoSiwa) }} "  class="profile-picture"></h5>
                               <!-- Tambahkan properti lain sesuai kebutuhan -->
            </div>
            <div class="tengah">
                <p class="card-text" style="margin-top: 1rem">Nama : {{ $item->nama_lengkap }}</p>
                <p class="card-text">kelas : {{ $item->kelas->n_kelas }}</p>
                <p class="card-text">Mapel Diajar:
                    @foreach ($user->mapels as $mapel)
                        {{ $mapel->nama_mapel }},
                    @endforeach
                </p>

                <p class="card-text">nilai avrg :  {{ $item->rataRataNilai ? number_format($item->rataRataNilai, 2) : 'Belum ada nilai' }}<p>
                </div> 
                <div class="kanan">
                    @if ($item->jawabanUjian->isNotEmpty())
                        {{-- Ambil id_mapel dari jawaban tugas pertama --}}
                        @php
                            $id_mapel = $item->jawabanUjian->first()->ujian->mapel->id_mapel ?? null;
                        @endphp
                        @if ($id_mapel)
                            <a href="/trans/ujian/{{ $item->id_murid }}/{{ $id_mapel }}/lihat" class="btn btn-info transkip-btn">Detail</a>
                        @endif
                    @endif
                </div>
        </div>
       
    @empty
        <p>Tidak ada data siswa.</p>
    @endforelse

    <!-- Link paginasi -->
    <div class="mt-4">
        {{ $siswa->links() }}
    </div>
</div>
@endsection
@extends('lyout/ujian.ujian_murid')

@section('konten')
<h2>{{  $mapel->nama_mapel }}</h2>
    
<div class="card" style="margin-top: 2rem">
    <div class="card bungkus-tugas ">
        @forelse ($tugas as $item)
        <div class="card-body tampilan-ujian ">
            <div class="kiri">
                <p>exp: {{ \Carbon\Carbon::parse($item->waktu_mulai)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</p>
                <p>mulai: {{ \Carbon\Carbon::parse($item->waktu_mulai)->locale('id')->isoFormat('HH:mm') }}</p>
                <p>berakhir: {{ \Carbon\Carbon::parse($item->waktu_berakhir)->locale('id')->isoFormat('HH:mm') }}</p>
            </div>
            <div class="tengah">
                <p class="card-text deskripsi">{{ $item->Deskripsi }}</p>
            </div>
            <div class="kanan">
                @if (\Carbon\Carbon::now()->lt(\Carbon\Carbon::parse($item->waktu_mulai, 'Asia/Jakarta')))
                    <button class="btn btn-warning" disabled>Belum Waktunya</button>
                @elseif ($item->is_done_by_user($user->id_murid))
                    <button class="btn btn-success" disabled>Sudah Dikerjakan</button>
                @elseif (\Carbon\Carbon::parse($item->waktu_berakhir, 'Asia/Jakarta')->isPast())
                    <button class="btn btn-danger" disabled>Berakhir</button>
                @else
                    <a href="/ujianpros/{{ $item->id_ujian }}/murid" class="btn btn-primary">Kerjakan</a>
                @endif
            </div>
        </div>
        @empty
        <div class="card-body">
            <p>Belum ada Ujian.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
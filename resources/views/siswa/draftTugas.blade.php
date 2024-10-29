@extends('lyout.allmurid')

@section('konten1')

    <h2>Draft Tugas {{  $mapel->nama_mapel }}</h2>
    
<div class="card">
    
  <div class="card">
  
      @forelse ($tugas as $item)
          
      <div class="card-body tampilan-tugas">
          <div class="kiri">
              <h5 class="card-title nama">{{ $item->no_tugas }}</h5>
              <p>exp: {{ \Carbon\Carbon::parse($item->dateline)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</p>
              <p>jam: {{ \Carbon\Carbon::parse($item->dateline)->locale('id')->isoFormat('HH:mm') }}</p>
          </div>
          <div class="tengah">
              <p class="card-text deskripsi">{{ $item->deskripsi }}</p>
          </div>
          <div class="kanan">
              @if ($item->is_done_by_user($user->id_murid))
                  <button class="btn btn-success" disabled>Sudah Dikerjakan</button>
              @elseif (\Carbon\Carbon::parse($item->dateline, 'Asia/Jakarta')->isPast())
                  <button class="btn btn-danger" disabled>Kadaluarsa</button>
              @else
                  <a href="/murid/tugas/{{ $item->id_tugas }}/p" class="btn btn-primary">Kerjakan</a>
              @endif
          </div>
      </div>
  
      @empty
      <div class="card-body">
          <p>Belum ada tugas.</p>
      </div>
      @endforelse
  </div>

  
    
@endsection
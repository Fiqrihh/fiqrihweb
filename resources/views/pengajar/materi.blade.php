@extends('lyout.leotpengajar')

@section('konten')

<div class="search-form">
  <form action="{{ route('pengajar.materi') }}" method="GET" class="form-inline">
      <div class="input-group">
          <input type="text" class="form-controll" placeholder="Cari materi..." name="cari" value="{{ request('cari') }}">
          <div class="input-group-append">
              <button class="btn btn-primary" type="submit" id="button-addon2">Cari</button>
          </div>
      </div>
  </form>
</div>


<div class="card" style="width: 80rem;">
  <div class="card-body">
    <h5 class="card-title">Data Materi</h5>

    <div class="tombol-tambah btn btn-success">
      <a href="{{ route('tambah.materi') }}"><i class='bx bxs-folder-plus'></i> Tambah </a>
    </div>
  
    
    <div class="table-responsive">
<table class="table table-success table-bordered">
  <thead>
   <tr>
     <th scope="col" class="text-center">Nomor</th>
     <th scope="col" class="text-center align-middle">Mata pelajaran</th>
     <th scope="col" class="text-center align-middle">Materi</th>
     <th scope="col" class="text-center align-middle">status</th>
     <th scope="col" class="text-center align-middle">Deskripsi</th>
     <th scope="col" class="text-center align-middle">publish</th>
     <th scope="col" class="text-center ">aksi</th>
   </tr>
  </thead>
     <tbody>
      <tr>
        @forelse ($materii as $item)
        <td class="text-center align-middle">{{ $loop->index + 1 }}</td>
        <td class="text-center align-middle">{{ $item->mapel->nama_mapel }}</td>
        <td class="text-center align-middle">{{ $item->judul_materi }}</td>
        <td class="text-center align-middle">{{ $item->status }}</td>
        <td class="text-center align-middle">{{ $item->deskripsi }}</td>
        <td class="text-center align-middle">{{ $item->created_at }}</td>
        <td class=" text-center" style="width:16rem" >
          <a href="{{ route('materi.showw', $item->id_materi) }}" class="btn btn-info btn-sm"><i class='bx bx-show'></i> Lihat</a>
          <a href="/materi/edit/{{ $item->id_materi }}" class="btn btn-primary btn-sm"><i class='bx bx-edit'></i> Edit</a>
          <a href="/pengajar/materi/hapus/{{ $item->id_materi }}" class="btn btn-danger delete-btn" class="fa fa-trash" ><i class='bx bx-trash'></i></a>
          <a href="{{ route('materi.draft', $item->id_materi) }}" class="btn btn-warning btn-sm">
            <i class='bx bx-save'></i> Draft
        </a>
        <a href="{{ route('materi.post', $item->id_materi) }}" class="btn btn-success btn-sm">
            <i class='bx bx-check'></i> Post
        </a>
        
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="6" class="text-center">Tidak ada data yang materi.</td>
    </tr>
    @endforelse
    <!-- More rows as needed -->
</tbody>
 </table>
 <div class="mt-4">
  {{ $materii->links() }}
</div>
  </div>
</div>
</div>
</tr>


@endsection

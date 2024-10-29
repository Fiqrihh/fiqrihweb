@extends('lyout/nilai.rekapmuridnilai')

@section('konten')



<div class="table-responsive">
    <table class="table table-bordered border-primary">
        <thead>
            <h4>Data Tugas</h4>
            <tr>
                <th scope="col" class="text-center">no</th>
                <th scope="col" class="text-center">No Tugas</th>
                <th scope="col" class="text-center">tingkatan</th>
                <th scope="col" class="text-center">Mapel</th>
                <th scope="col" class="text-center">nilai</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($nilai as $item)
            <tr> 
                <td class="text-center align-middle">{{ $loop->index + 1 }}</td>
                <td class="text-center">{{ $item->tugas->no_tugas }}</td>
                <td class="text-center">{{ $item->kelas->n_kelas }}</td>
                <td class="text-center">{{ $item->mapel->nama_mapel }}</td>
                <td class="text-center">{{ $item->nilai_tugas }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Tidak ada data nilai tugas.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

    
@endsection
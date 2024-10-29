@extends('lyout/ujian.ujian')

@section('konten')
<div class=" ujian-add">
    <a href="/ujian/{{ $mapel->id_mapel }}/add" class="btn btn-success" style="margin-bottom: 10px"><i class='bx bxs-file-plus '></i> Ujian</a>
<div class="table-responsive" >
    <table class="table table-bordered table-striped" style="background-color: white">
        <thead>
            <tr>
                <th scope="col" class="text-center">No</th>
                <th scope="col" class="text-center align-middle">mapel</th>
                <th scope="col" class="text-center align-middle">kelas</th>
                <th scope="col" class="text-center align-middle">deskripsi</th>
                <th scope="col" class="text-center align-middle">tanggal</th>
                <th scope="col" class="text-center align-middle">waktu mulai</th>
                <th scope="col" class="text-center align-middle">waktu berakhir</th>
                <th scope="col" class="text-center align-middle">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ujian as $ujiann)
                <tr>
                    <td class="text-center align-middle">{{ $loop->index + 1 }}</td>
                    <td class="text-center align-middle">{{ $ujiann->mapel->nama_mapel }}</td>
                    <td class="text-center align-middle">{{ $ujiann->kelas->n_kelas }}</td>
                    <td class="text-center align-middle">{{ $ujiann->Deskripsi }}</td>
                    <td class="text-center align-middle">
                        {{ \Carbon\Carbon::parse($ujiann->waktu_mulai)->locale('id')->timezone('Asia/Jakarta')->format('d F Y') }}
                    </td>
                    <td class="text-center align-middle">
                        {{ \Carbon\Carbon::parse($ujiann->waktu_mulai)->format('H:i') }}
                    </td>
                    <td class="text-center align-middle">
                        {{ \Carbon\Carbon::parse($ujiann->waktu_berakhir)->format('H:i') }}
                    </td>
                    <td class="text-center align-middle">
                        <a href="/pengajar/info/{{ $ujiann->id_ujian }}" class="btn btn-info btn-sm tgs-btn " title="Detail"><i class='bx bx-detail'></i></a> 
                        <a href="/pengajar/ujian/edit/{{ $ujiann->id_ujian }}" class="btn btn-secondary btn-sm tgs-btn" title="edit"><i class='bx bx-edit-alt' ></i></a>
                        <a href="" class="btn btn-danger btn-sm tgs-btn" onclick="confirmDeletion({{ $ujiann->id_ujian }})" title="hapus"><i class='bx bxs-trash' > </i></a>
                        <a href="/ujian/detail/{{ $ujiann->id_ujian }}" class="btn btn-dark btn-sm tgs-btn" title="cek siswa"><i class='bx bx-list-check'></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="d-flex justify-content-center">
    {{ $ujian->links() }}
</div>
</div>


<script>
    function confirmDeletion(id) {
        if (confirm('Apakah Anda yakin ingin menghapus ujian ini?')) {
            window.location.href = '/ujian/hapus/'+id;
        }
    }
</script>
@endsection
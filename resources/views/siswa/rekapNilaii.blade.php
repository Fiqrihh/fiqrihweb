@extends('lyout/nilai.rekapnilaimur')

@section('konten')

<div class="card rekapNilai">
    <div class="card-body kiri">
      <h5 class="text-center">Rekap nilai Tugas</h5>
      <span>Berisi tentang seluruh nilai tugas siswa yang telah mengerjakan silahkan cek dengan menekan tombol Masuk </span>
      <p><a href="/murid/rekapNilai" class="btn btn-info masuk-btn " style="margin-top: 12px">Masuk</a></p>
    </div>
  </div>
  <div class="card rekapNilai">
    <div class="card-body kiri">
      <h5 class="text-center">Rekap nilai Ujian</h5>
      <span>Berisi tentang seluruh nilai Ujian siswa yang telah mengerjakan silahkan cek dengan menekan tombol Masuk </span>
      <p><a href="/murid/rekapNilai/ujian/siswa" class="btn btn-info masuk-btn " style="margin-top: 12px">Masuk</a></p>
    </div>
  </div>
    
@endsection
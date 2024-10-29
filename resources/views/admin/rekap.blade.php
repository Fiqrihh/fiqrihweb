@extends('lyout.leotuang')

@section('contener')

<div class="container-fluid">
   <!-- Rekap Form -->
   <div class="row justify-content-center">
   <form action="/rekapad" method="GET" class="form-inline">
    <div class="input-group">
        <select class="form-control mr-2" name="bulan">
            <option value="">Pilih Bulan</option>
            @foreach($bulanIndonesia as $key => $bulan)
                <option value="{{ $key }}" @if(request('bulan') == $key) selected @endif>{{ $bulan }}</option>
            @endforeach
        </select>
        <select class="form-control mr-2" name="tahun">
            <option value="">Pilih Tahun</option>
            @foreach($tahunDatabase as $tahun)
                <option value="{{ $tahun }}" @if(request('tahun') == $tahun) selected @endif>{{ $tahun }}</option>
            @endforeach
        </select>
        <div class="input-group-append">
            <button class="btn btn-primary" type="submit" id="button-addon2">Rekap</button>
        </div>
    </div>
</form>
</div>


<div class="row justify-content-center mt-5">

    <!-- Content Column -->
    <div class="col-lg-9 mb-4">

      <!-- Project Card Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-center">Pemasukan</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table">
            
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Bulan</th>
              <th scope="col">Total Pemasukan</th>
              <th scope="col">Total Pengeluaran</th>
              <th scope="col">print</th>
              

            </tr>
          </thead>
         
          <tbody>
            @foreach($totalPemasukan as $pemasukan)
                @php
                    $pengeluaran = $totalPengeluaran->where('tahun', $pemasukan->tahun)->where('bulan', $pemasukan->bulan)->first();
                @endphp
                <tr>
                  <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $pemasukan->tahun }}-{{ $bulanIndonesia[$pemasukan->bulan] }}</td>
                    <td>{{ $pemasukan->total_pemasukan }}</td>
                    <td>{{ $pengeluaran ? $pengeluaran->total_pengeluaran : 0 }}</td>
                    <td>
                      <a href="{{ route('print.rekap', ['bulan' => $pemasukan->bulan, 'tahun' => $pemasukan->tahun]) }}" class="btn btn-primary" target="_blank">Print</a>
                  </td> 
                  
                </tr>
            @endforeach
        </tbody>
           </td>
         </tr>
       </tfoot>
       
        </table>
      </div>
        </div>
      </div>
</div>




@endsection




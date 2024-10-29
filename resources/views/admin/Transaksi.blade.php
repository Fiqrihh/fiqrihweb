@extends('lyout.leotuang')

@section('contener')

    	        <!-- Begin Page Content -->
        <div class="container-fluid">
   <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->
            <div class="col-lg-6 mb-4">

              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Pengeluaran terkini</h6>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">kategori</th>
                      <th scope="col">Nama</th>
                      <th scope="col">Harga</th>
                      <th scope="col">tanggal</th>

                    </tr>
                  </thead>
                  @php      
                       
                   @endphp
                  <tbody>
                    @foreach ($belanja as $out)
                    <tr>
                      <td>{{ $loop->index + 1 }}</td>
                      <td>{{ $out->nama_kategori }}</td>
                      <td>{{ $out->nama }}</td>
                      <td>{{ $out->jumlah_peng }}</td>
                      <td>{{ $out->tanggal_peng }}</td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
                <a href="/transaksi/pengeluaran"  class="btn btn-primary">tampilkan lebih banyak</a>
              </div>
                </div>
              </div>
			  </div>
               
<div class="col-lg-6">
                <!-- Collapsable Card Example -->
  <div class="card shadow mb-4">
    <!-- Card Header - Accordion -->
    <a class="card-header py-3" >
      <h6 class="m-0 font-weight-bold text-primary">Pemasukan terkini</h6>
    </a>
    <!-- Card Content - Collapse -->
    <div class="collapse show" id="collapseCardExample">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table">
            
        <thead>
          <tr>
              <th scope="col">No</th>
              <th scope="col">kategori</th>
              <th scope="col">Nama</th>
              <th scope="col">Harga</th>
              <th scope="col">tanggal</th>
          </tr>
        </thead>
       
        <tbody>
            @foreach ($dibeli as $in)
                    <tr>
                      <td>{{ $loop->index + 1 }}</td>
                      <td>{{ $in->nama_kategori }}</td>
                      <td>{{ $in->nama }}</td>
                      <td>{{ $in->jumlah_pem }}</td>
                      <td>{{ $in->tanggal_pem }}</td>
                    @endforeach
          </tr>
        
      </tbody>
      </table>
      <a href="/transaksi/pemasukan"  class="btn btn-primary">tampilkan lebih banyak</a>
    </div>
      </div>
    </div>
  </div>
 
  



@endsection

    
    
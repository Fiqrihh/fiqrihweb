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
                  <h6 class="m-0 font-weight-bold text-primary">Surat Masuk</h6>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">pengirim</th>
                      <th scope="col">judul</th>
                      <th scope="col">tanggal</th>
                    </tr>
                  </thead>
                  @php      
                       
                   @endphp
                  <tbody>
                    @foreach ($sm as $out)
                    <tr>
                      <td>{{ $loop->index + 1 }}</td>
                      <td>{{ $out->Pengirim }}</td>
                      <td>{{ $out->judulSuratM }}</td>
                      <td>{{ $out->tglSuratM }}</td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
                <a href="/sMasuk"  class="btn btn-primary">tampilkan lebih banyak</a>
              </div>
                </div>
              </div>
			  </div>
               
<div class="col-lg-6">
                <!-- Collapsable Card Example -->
  <div class="card shadow mb-4">
    <!-- Card Header - Accordion -->
    <a class="card-header py-3" >
      <h6 class="m-0 font-weight-bold text-primary">Surat Keluar</h6>
    </a>
    <!-- Card Content - Collapse -->
    <div class="collapse show" id="collapseCardExample">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table">
            
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">pengirim</th>
            <th scope="col">judul</th>
            <th scope="col">tanggal</th>
          </tr>
        </thead>
       
        <tbody>
            @foreach ($sk as $in)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $in->Penerima }}</td>
                        <td>{{ $in->judulSuratK }}</td>
                        <td>{{ $in->tglSuratK }}</td>
                       
                    @endforeach
          </tr>
        
      </tbody>
      </table>
      <a href="/sKeluar"  class="btn btn-primary">tampilkan lebih banyak</a>
    </div>
      </div>
    </div>
  </div>
 
  



@endsection


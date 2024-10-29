<script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctxPemasukan = document.getElementById('chartPemasukan').getContext('2d');
        var chartPemasukan = new Chart(ctxPemasukan, {
            type: 'pie',
            data: {
                labels: ['Pemasukan', 'Pengeluaran', 'sisa'],
                datasets: [{
                    data: [{{ $tPemasukan }}, {{ $tPengeluaran }}, {{ $sisa_d }}],
                    backgroundColor: ['#36a2eb', '#ff6384','#ffcc29'],
                    borderWidth: 1
                }]
            }
        });
        
        var ctxPengeluaran = document.getElementById('chartPengeluaran').getContext('2d');
        var chartPengeluaran = new Chart(ctxPengeluaran, {
            type: 'doughnut',
            data: {
                labels: ['Surat Masuk', 'Surat Keluar'],
                datasets: [{
                    data: [{{ $suratm }}, {{ $suratk }}],
                    backgroundColor: ['#DC143C', '#FF7F50'],
                    borderWidth: 1
                }]
            }
        });
        
    });
</script>


<script src="https://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript">
    var pendapatan = <?php echo json_encode($jumlah_pem) ?>;
    var bulan = <?php echo json_encode($bulan) ?>;
    
    Highcharts.chart('chartLine', {
        title : {
            text: 'Grafik Pendapatan per Bulan'
        },
        xAxis : {
            categories : bulan
        },
        yAxis : {
            title: { 
                text : 'Nominal Pendapatan Bulanan (IDR)'
            },
            labels: {
                formatter: function() {
                    return 'Rp ' + Highcharts.numberFormat(this.value, 0, ',', '.');
                }
            }
        },
        tooltip: {
            formatter: function() {
                return '<b>' + this.series.name + '</b><br/>' +
                    this.x + ': Rp ' + Highcharts.numberFormat(this.y, 0, ',', '.');
            }
        },
        series: [
            {
                name: 'Nominal Pendapatan',
                data: pendapatan
            }
        ]
    });
</script>

</script>
$file = $request->file('fileSuratK');

// Periksa apakah file berhasil diunggah
if ($file) {
    // Ubah format tanggal jika diinginkan
    $filename = date('Y-m-d') . '_' . $file->getClientOriginalName();
    $path = 'filekeluar/' . $filename;

    // Simpan file
    Storage::disk('public')->put($path, file_get_contents($file));}


    <tr>
                     <td>{{ $loop->index + 1 }}</td>
                     <td>{{ $out->Penerima }}</td>
                     <td>{{ $out->judulSuratK	 }}</td>
                     <td>{{ $out->nomorSuratK }}</td>
                     <td>{{ $out->isiSuratK }}</td>
                     <td>{{ $out->tglSuratK }}</td>
                     <td><a href="/pdff/{{ $out->id}}" target="_blank">{{ $out->fileSuratK }}</a></td>
                     <td class="text-center align-middle">
                      <a href="/sKeluar/{{ $out->id }}/edit" class="btn btn-primary"><i class="fa fa-edit" >Edit</i></a> ||
                      <a href="/sKeluar/{{ $out->id }}/delete" class="btn btn-danger delete-btn" class="fa fa-trash"  data-id="{{ $out->id }}">delete</a>
                  
                  </td>
                   </tr>
                   


<!DOCTYPE html>
<html>
<head>
    <title>Surat Keluar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20mm 10mm;
        }

        h2 {
            text-align: center;
        }

        p {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h2>{{ $surat->judulSuratK  }}</h2>

    <p><strong>Nomor Surat:</strong> {{ $surat->nomorSuratK }}</p>
    <p><strong>Tanggal Surat:</strong> {{ $surat->tglSuratK }}</p>
    <p><strong>Penerima:</strong> {{ $surat->penerima }}</p>
    <p><strong>Isi Surat:</strong></p>
    <p>{{ $surat->isiSuratK }}</p>
    <p><strong>ttd</strong></p>
    <p></p>
    <p></p>
    <p></p>
    <p><strong>{{ $surat->fileSuratK }}</strong></p>

    <!-- Tambahkan lebih banyak informasi sesuai kebutuhan -->


    <div class="container-fluid">
    <div class="row  justify-content-center">
      <div class="col-md-4 mb-4">
        <!-- Search Form -->
        <form action="/rekapad" class="form-inline">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="cari.." name="cari" value="{{ request('cari') }}">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit" id="button-addon2">Cari</button>
                </div>
            </div>
        </form>
    </div>
    </div>


    public function index()
    {$untung = Pemasukan::join('kategoris', 'pemasukans.id_kategori', '=', 'kategoris.id_kategori')
        ->select('pemasukans.*', 'kategoris.nama_kategori')
        ->whereIn('pemasukans.id_kategori', [3, 4]) // Menambahkan kondisi WHERE untuk kategori_id 3 dan 4
        ->orderByDesc('pemasukans.id')
        ->Cari()
        ->paginate(5);
    
    $user = Auth::user();
    $kategori = Kategori::all();
    $totd = Pemasukan::all();
    $totalData = Pemasukan::count();
    $masuk = Pemasukan::paginate(10);
    $itemsPerPage = 10; // Jumlah data yang ingin ditampilkan per halaman
    $totalPages = ceil($totalData / $itemsPerPage);
    
    $peng = Pemasukan::all();
    
    return view('admin/rekapPembayaran', [
        'title' => 'rekap Pembayaran Siswa',
        'masuk' => $untung,
        'kate' => $kategori,
        'user' =>$user,
    ]);
    
    }


</body>
</html>

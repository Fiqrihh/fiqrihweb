<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Bulanan - {{ $bulan }}/{{ $tahun }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .detail {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 20px;
        }
        .detail p {
            margin: 5px 0;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Laporan Keuangan Pondok Pesantren Darul Lughah Waddirasatil Islamiyah</h1>
            <h2>Rekap Bulanan - {{ $bulanIndonesia[$bulan] }}/{{ $tahun }}</h2>
        </div>
        <div class="detail">
            <h2>Total Pemasukan: Rp. {{ number_format($totalPemasukan, 2) }}</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Jumlah</th>
                        <th>Nama</th>
                        <th>kategori</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pemasukan as $index => $data)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $data->tanggal_pem }}</td>
                            <td>{{ $data->jumlah_pem }}</td>
                            <td>{{ $data->nama }}</td>
                            <td>{{ $data->kategori->nama_kategori }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
           
        </div>
        <div class="detail">
            <h2>Total Pengeluaran: Rp. {{ number_format($totalPengeluaran, 2) }}</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Jumlah</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengeluaran as $index => $data)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $data->tanggal_peng }}</td>
                            <td>{{ $data->jumlah_peng }}</td>
                            <td>{{ $data->nama }}</td>
                            <td>{{ $data->kategori->nama_kategori }}</td>
                        </tr>
                        </tr>
                    @endforeach
                </tbody>
            </table>
          
        </div>
    </div>
</body>
</html>

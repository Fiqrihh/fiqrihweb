<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pembayaran</title>
    <style>
         body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 180mm; /* Mengatur lebar kontainer */
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
        .footer {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Bukti Pembayaran</h1>
            <h2>Peserta Kursus Bahasa Arab Darul Lughah Waddirasatil Islamiyah</h2>
        </div>
        <div class="detail">
            <p><strong>Nama:</strong> {{ $baru->nama }}</p>
            <p><strong>Jumlah Pembayaran:</strong> Rp. {{ number_format($baru->jumlah_pem, 2) }}</p>
            <p><strong>Tanggal Pembayaran:</strong> {{ $baru->tanggal_pem }}</p>
        </div>
        <div class="footer">
            <p>peserta kursus yang bernama {{ $baru->nama }} telah melakukan pembayaran</p>   

               <p style="margin-top: 100px">ttd</p>
        </div>
    </div>
</body>
</html>

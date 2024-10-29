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
    <h2>Surat Keluar</h2>

    <p><strong>Judul:</strong> {{ $surat->judul }}</p>
    <p><strong>Nomor Surat:</strong> {{ $surat->nomorSuratK }}</p>
    <p><strong>Tanggal Surat:</strong> {{ $surat->tglSuratK }}</p>
    <p><strong>Penerima:</strong> {{ $surat->penerima }}</p>
    <p><strong>Isi Surat:</strong></p>
    <p>{{ $surat->isi }}</p>

    <!-- Tambahkan lebih banyak informasi sesuai kebutuhan -->

</body>
</html>

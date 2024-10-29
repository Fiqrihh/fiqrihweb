<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inknut+Antiqua:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&family=EB+Garamond:wght@400;800&display=swap" rel="stylesheet">
    <title>Detail Jawaban</title>
    <link rel="stylesheet" href="{{ asset('css/csspengajar/jawabaTugas.css') }}"> <!-- Include your CSS file if needed -->
</head>
<body>
    <div class="container">
        <h1>Detail Jawaban</h1>

        <!-- Menampilkan detail jawaban -->
        <div class="jawaban-detail">
            <h2>Nama : {{ $jawaban->murid->nama_lengkap }}</h2>
            <h2>Mata Pelajaran: {{ $jawaban->mapel->nama_mapel }}</h2>
            <h2>Kelas: {{ $jawaban->kelas->n_kelas }}</h2>
            <h2>Jawaban:</h2>
            <p style="white-space: pre-wrap;">{{ $jawaban->jawaban_text }}</p>
            <p>Tanggal: {{ $jawaban->created_at->format('d M Y, H:i') }}</p>
            <!-- Tambahkan elemen lain sesuai kebutuhan -->
        </div>
        @if ($jawaban && pathinfo($jawaban->jawaban_file, PATHINFO_EXTENSION) == 'pdf')
    <div class="jawaban_file">
        <a href="{{ asset('/storage//' . $jawaban->jawaban_file) }}" target="_blank" style="color: rgb(208, 0, 0); font-size:50px; padding:10px">
            <i class='bx bxs-file-pdf'></i>
        </a>
    </div>
@else
    <p>File tidak tersedia atau bukan PDF.</p>
@endif

        <!-- Tambahkan tombol atau link lain jika diperlukan -->
        <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>
    </div>
</body>
</html>

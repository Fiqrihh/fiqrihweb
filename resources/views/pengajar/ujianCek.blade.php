<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Jawaban Ujian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f7f6;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .card-header {
            border-radius: 15px 15px 0 0;
            background-color: #0d6efd;
            color: white;
            padding: 15px;
        }

        .card-body {
            padding: 25px;
        }

        .btn-back {
            background-color: #6c757d;
            color: white;
            border-radius: 25px;
            padding: 10px 20px;
            transition: background-color 0.3s ease;
            margin-top: 20px;
        }

        .btn-back:hover {
            background-color: #5a6268;
        }

        .btn-edit-nilai {
            background-color: #0d6efd;
            color: white;
            transition: transform 0.2s ease;
            margin-top: 10px;
        }

        .btn-edit-nilai:hover {
            transform: scale(1.05);
        }

        .btn-simpan {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            transition: background-color 0.3s ease;
        }

        .btn-simpan:hover {
            background-color: #218838;
        }

        h1 {
            color: #0d6efd;
            font-weight: bold;
        }

        p {
            margin-bottom: 10px;
        }

        .jawaban {
            margin-top: 20px;
        }

        .jawaban p {
            background-color: #e9ecef;
            padding: 15px;
            border-radius: 10px;
            font-weight: bold;
        }

    </style>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Cek Jawaban Ujian</h1>
        <div class="card">
            <div class="card-header">
                <h4>Detail Ujian</h4>
            </div>
            <div class="card-body">
                <p><strong>Nama Murid:</strong> {{ $jawaban->murid->nama_lengkap }}</p>
                <p><strong>Mata Pelajaran:</strong> {{ $jawaban->mapel->nama_mapel }}</p>
                <p><strong>Kelas:</strong> {{ $jawaban->kelas->nama_kelas }}</p>
                <p><strong>Tanggal Ujian:</strong> {{ $jawaban->created_at }}</p>

                <div class="jawaban">
                    <p><strong>Jawaban Murid:</strong> {{ $jawaban->student_ans }}</p>
                </div>

                <a href="{{ url()->previous() }}" class="btn btn-back">Kembali</a>
            </div>
        </div>
    </div>
</body>

</html>

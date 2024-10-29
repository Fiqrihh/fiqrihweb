<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Selamat! Kamu Sudah Terdaftar</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
         .foto {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin-left: 140px
        }
        .foto img{
            width: 60px;
            height: 60px;
            border-radius: 50%;
        }
    </style>
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="card mx-auto" style="max-width: 400px;">
            <div class="card-header bg-success text-white">
                <h5 class="card-title">Selamat! Kamu Sudah Terdaftar</h5>
            </div>
            <div class="card-body">
                <p class="card-text">Terima kasih atas pendaftaranmu. Data kamu telah berhasil kami terima.</p>
                <p class="card-text">Segera lakukan pembayaran, agar terverifikasi</p>
                <p class="card-text">Berikut adalah detail pendaftaran kamu:</p>

                    <div class="foto">
                        <img src="{{ asset('storage/foto-siswa/' . $murid->fotoSiwa) }}" class="profile-picture">
                    </div>
                    <li class="list-group-item">Nama: {{ $murid->nama_lengkap }}</li>
                    <li class="list-group-item">Alamat: {{ $murid->alamat }}</li>
                    <li class="list-group-item">Tanggal Lahir: {{ $murid->tanggal_lahir }}</li>
                    <li class="list-group-item">NO. HP: {{ $murid->nohp }}</li>
                    <li class="list-group-item">Jenis Kelamin: {{ $murid->jenis_kelamin }}</li>
                </ul>
                <a href="/pendaftaranspos"> Keluar</a>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

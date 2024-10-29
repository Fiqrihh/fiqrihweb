@extends('lyout.leotpengajar')

@section('konten')

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
    }
    .jumbotron {
        background-color: #007bff;
        color: #ffffff;
        padding: 2rem;
        margin-bottom: 2rem;
    }
    .card {
        margin-bottom: 20px;
    }
    .card-header {
        background-color: #007bff;
        color: #ffffff;
    }
</style>
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Jawaban Siswa</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Tugas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Nilai</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Keluar</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="container mt-4">
    <!-- Jumbotron -->
    <div class="jumbotron">
        <div class="container">
            <h1 class="display-4">Jawaban Siswa untuk Tugas</h1>
            <p class="lead">Lihat jawaban yang telah diberikan oleh siswa untuk setiap tugas.</p>
        </div>
    </div>

    <!-- List Jawaban Siswa -->
    <div class="card">
        <div class="card-header">
            Tugas Pemrograman Web
        </div>
        <div class="card-body">
            <h5 class="card-title">Nama Siswa: John Doe</h5>
            <p class="card-text">Jawaban Siswa:</p>
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla pretium est sed tortor congue ultricies. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Mauris vehicula est sit amet dui ultricies, eget eleifend erat efficitur.</p>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#nilaiModal">
                Beri Nilai
            </button>
        </div>
    </div>

    <!-- Modal Beri Nilai -->
    <div class="modal fade" id="nilaiModal" tabindex="-1" role="dialog" aria-labelledby="nilaiModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="nilaiModalLabel">Beri Nilai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="nilai">Nilai:</label>
                            <input type="number" class="form-control" id="nilai" placeholder="Masukkan nilai">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary">Simpan Nilai</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center mt-4">
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#">Next</a>
            </li>
        </ul>
    </nav>
</div>

<!-- Footer -->
<footer class="footer py-3 bg-dark text-center">
    <div class="container">
        <span class="text-muted">&copy; 2024 Jawaban Siswa. All rights reserved.</span>
    </div>
</footer>
@endsection
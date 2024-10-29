<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Kursus bahasa Arab Pondok Pesantren Darul Lughah Waddirasatil</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #48D1CC;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            overflow-x: hidden;
        }

        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 400px;
            margin: auto;
        }

        h1 {
            text-align: center;
            color: #ffffff;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input,
        select {
            margin-bottom: 16px;
            width: 100%;
        }

        button {
            background-color: #4caf50;
            color: #ffffff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        
        <form action="/daftarverf" method="POST" class="mx-auto mt-4" enctype="multipart/form-data">
            <h3>Form Pendaftaran</h3>

            @csrf

            
            <div class="mb-3 text-center">
                <label for="">foto diri</label>
                <input class="form-control" type="file" id="fotoSiwa" name="fotoSiwa" required>
              </div>
            
            <div class="form-group">
                <label for="nama_lengkap">Nama:</label>
                <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <input type="text" id="alamat" name="alamat" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="tanggal_lahir">Tanggal Lahir:</label>
                <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="nohp">NO. HP:</label>
                <input type="text" id="nohp" name="nohp" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="email_murid">Email:</label>
                <input type="email" id="email_murid" name="email_murid" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>

            <div class="form-group">
                <input id="status" name="status" class="form-control" value="belum_verifikasi" hidden required>
            </div>
            
            <div class="form-group">
                <input id="id_kelas" name="id_kelas" class="form-control" value="1" hidden required>
            </div>

            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin:</label>
                <select id="jenis_kelamin" name="jenis_kelamin" class="form-control" required>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Daftar</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

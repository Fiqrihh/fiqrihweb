<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="gambar/logoo.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">Buat akun</div>
    
                    <div class="card-body">
                        <form method="POST" action="/register" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3 text-center">
                                <img id="profileImage" src="placeholder.jpg" class="rounded-circle img-thumbnail" alt="Profile Image" style="max-width: 150px; max-height: 150px;">
                                <input class="form-control" type="file" id="fotoAdmin" name="fotoAdmin" required>
                              </div>

                            <label for="name">Nama:</label>
                            <input type="text" id="name" name="name" class="form-control rounded-top @error('name') is-invalid @enderror"  value="{{ old('name') }}" required>
                            @error('name')
                            <div class="invalid-feedback">
                                nama tidak boleh kosong
                            </div>
                            @enderror

                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                           @error('email')
                            <div class="invalid-feedback">
                                masukkan tipe email
                            </div>

                            @enderror
                            <label for="password">Password:</label>
                            <input type="password" id="password" name="password" class="form-control " required >
                            @error('password')
                            <div class="invalid-feedback">
                                password harus lebih dari 5
                            </div>
                            @enderror
                            
                            <div class="form-group row mb-0">
                                <div class="">
                                    <button type="submit" class="btn btn-success" >Daftar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <script>
        document.getElementById('fotoAdmin').addEventListener('change', function (event) {
          var input = event.target;
          var profileImage = document.getElementById('profileImage');
      
          if (input.files && input.files[0]) {
            var reader = new FileReader();
      
            reader.onload = function (e) {
              profileImage.src = e.target.result;
            };
      
            reader.readAsDataURL(input.files[0]);
          }
        });
      </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>
</html>


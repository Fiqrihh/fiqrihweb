<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Annie+Use+Your+Telescope&family=Edu+TAS+Beginner:wght@400..700&family=Rubik+Glitch&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styleLoginUser.css') }}">
    <title>Halaman Login</title>
   
    

</head>
<body>
    
    <div class="institut">
            <h3> <img src="{{ asset('gambar/logoo.png') }}"> Aplikasi Belajar Ponpes-DLWI</h3>
    </div>

    <div class="card">
        <div class="hd-card">
            <h4>PONDOK PESANTREN DLWI</h4>
        </div>
        <div class="card-body">

            <form  action="/LoginUser" method="post">
                @csrf 
              <div class="mb-3">
                  <label for="username" class="form-label">Username <text style="color: #5A72A0">pengajar/murid</text> :</label>
                  <input type="text" class="form-control" id="username" name="username" aria-describedby="username" placeholder="masukkan username ">
                  {{-- <div id="username" class="form-text">We'll never share your email with anyone else.</div> --}}
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="*********">
                </div>
                <div class="mb-3 form-check">
                  <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                  <label for="remember">Remember Me</label>
              </div>
                <button type="submit" class="btn btn-primary">Masuk</button>
              </form>

        </div>
      </div>

      <div class="footer">
        <h6>@2024. Kursus bahasa arab DLWI</h6>
      </div>

      @if($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
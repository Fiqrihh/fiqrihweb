<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="gambar/logoo.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Poppins:ital,wght@1,300&display=swap" rel="stylesheet">
    <title> Login | Admin</title>
    <style>
        body{
    font-family: 'Poppins', sans-serif;
    background: #ececec;
}
/*------------ Login container ------------*/
.box-area{
    width: 930px;
}
/*------------ Right box ------------*/
.right-box{
    padding: 40px 30px 40px 40px;
}
/*------------ Custom Placeholder ------------*/
::placeholder{
    font-size: 16px;
}
.rounded-4{
    border-radius: 20px;
}
.rounded-5{
    border-radius: 30px;
}
/*------------ For small screens------------*/
@media only screen and (max-width: 768px){
     .box-area{
        margin: 0 10px;
     }
     .left-box{
        height: 100px;
        overflow: hidden;
     }
     .right-box{
        padding: 20px;
     }
}
    </style>
</head>
<body>
   
    @if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session()->has('loginError'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert" >
    {{ session('loginError') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <!----------------------- Main Container -------------------------->

     <div class="container d-flex justify-content-center align-items-center min-vh-100">
        

    <!----------------------- Login Container -------------------------->

       <div class="row border rounded-5 p-3 bg-white shadow box-area">

    <!--------------------------- Left Box ----------------------------->

       <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background: #312A2A;">
           <div class="featured-image mb-3">
            <img src="{{ asset('gambar/logoo.png') }}" class="img-fluid" style="width: 250px;">
           </div>
           <p class="text-white fs-2" style="font-family: 'Courier New', Courier, monospace; font-weight: 600;">Halaman Login</p>
           <small class="text-white text-wrap text-center" style="width: 17rem;font-family: 'Courier New', Courier, monospace;">Selamat Datang di pondok Darul Lughah Wddirasatil Islamiyah</small>
       </div> 

    <!-------------------- ------ Right Box ---------------------------->
        
       <div class="col-md-6 right-box">
          <div class="row align-items-center">
                <div class="header-text mb-4">
                     <h2>Halo,Min</h2>
                     <p>Selamat Menjalankan Tugas</p>
                </div>
                <form action="/login" method="post">
                    @csrf
                <div class="input-group mb-3">
                    <input type="email" name="email" id="email" class="form-control form-control-lg bg-light fs-6" placeholder="Email address" autofocus required>
                </div>
                <div class="input-group mb-1">
                    <input type="password" name="password" id="password" class="form-control form-control-lg bg-light fs-6" placeholder="Password">
                </div>
                
                    
                </div>
                <div class="input-group mb-3 mt-3">
                    <button class="btn btn-lg btn-primary w-100 fs-6">Login</button>
                </div>
            
                <div class="row">
                    <small>kamu tidak memiliki akun? <a href="/register">Buat akun</a></small>
                </div>
            </form>
          </div>
       </div> 

      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"></script>

</body>
</html>
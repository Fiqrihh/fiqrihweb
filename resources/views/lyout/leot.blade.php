<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="gambar/logoo.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin || {{ $title }}</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-xd/UZK4i6NAJY4J8rXd8/x8kTGw3nDLkjMqHr+3AZZL4oYjeQ3Qq1M0X8dF5i0O2w/yZ0+bbUm8YT82+ZsKmJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-ezUHStUwz5htTLONf4ntGmHTz7duAgGMKAeE+HxxP8yfGe7Y8t0pFb1pWzO2nKM" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@1,300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="stylesheet" href="css/style1.css">


   <style>
        body {
            background-color: #8FBC8F;
            max-width: 100%;
            margin: auto;
            clear: both;
            font-family: 'Poppins', sans-serif;
           
        }

        .sidebar {
            margin: 0;
            padding: 0;
            width: 200px;
            background-color: #2F4F4F;
            position: fixed;
            height: 100%;
            overflow: auto;
            color: aliceblue;
        }

        .sidebar a {
            display: block;
            color: aliceblue;
            padding: 16px;
            text-decoration: none;
            z-index: 1;
        }

        .sidebar a.active {
            background-color: #04AA6D;
            color: white;
        }

        .sidebar a:hover:not(.active) {
            background-color: #555;
            color: white;
        }

        .profile {
            text-align: center;
            padding-top: 20px;
            margin-right: 30px;
        }

        .profile-picture {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
        }

        .profile-name {
            margin-top: 10px;
            font-size: 16px;
            font-weight: bold;
        }

        div.content {
            margin-left: 200px;
            padding: 1px 16px;
            height: 1000px;
        }

        @media screen and (max-width: 700px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .sidebar a {
                float: left;
            }

            div.content {
                margin-left: 0;
            }
        }

        @media screen and (max-width: 400px) {
            .sidebar a {
                text-align: center;
                float: none;
            }
        }

        /* CSS untuk Footer */
footer {
    color: #333;
    text-align: center;
    padding: 20px;
    position: fixed;
    bottom: 0;
    width: 100%;
    border-top: 1px solid #ccc;
}


        
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="profile">
            <img src="{{ asset('storage/' . $user->fotoAdmin) }}" class="profile-picture">
            <p class="profile-name">{{ $user->name }}</p>
        </div>
    
        <a href="/profile"  class="fa fa-user"> Profile</a>
        <a href="/"  class="fa fa-home"> Dashboard</a>
        <div class="menu">
    
        <div class="item">
        <a class="sub-btn"><i class='bx bx-money-withdraw'></i> Keuangan <i class='bx bxs-down-arrow dropdown' > </i></a>
        <div class="sub-menu">
            <a href="/transaksi" class="sub-item" class="fa fa-money"> Keuangan</a>
            <a href="/rekap" class="sub-item"> <i class='bx bxs-wallet'></i> bayar Siswa</a>
            <a href="/kategori" class="fa fa-book"  class="sub-item" > Kategori</a>
            <a href="/rekapad" class="sub-item"><i class='bx bxs-report' ></i> laporan</a>
        </div>
        </div>
    
        <div class="item">  
            <a class="sub-btn"><i class='bx bxs-balloon' ></i> Kursus <i class='bx bxs-down-arrow dropdown' ></i></a>
            <div class="sub-menu">
            <a href="/murid" class="fa fa-users" class="sub-item" > Siswa</a>
            <a href="/data-pengajar" class="fa fa-users" class="sub-item" > Pengajar</a>
            {{-- <a href="/alumni"><i class='bx bxs-graduation' class="sub-item"></i> Alumni</a> --}}
            <a href="/mapel" class="fa fa-users" class="sub-item" > Mapel</a>
            {{-- <a href="/angkatan" class="fa fa-users" class="sub-item" > angkatan</a> --}}
            <a href="/Mkelas"  class="sub-item" ><i class='bx bxs-school'></i> Kelas</a>
            </div>
        </div>
    
        <div class="item">
            
            <a class="sub-btn"><i class='bx bxs-user-account' ></i> Akun <i class='bx bxs-down-arrow dropdown' ></i></a>
        <div class="sub-menu">
            <a href="/akun-pengajar" class="sub-item" ><i class='bx bxs-graduation' class="sub-item"></i> pengajar</a>
            <a href="/akun-murid"  class="fa fa-users"></i> murid</a>
        </div>
        </div>
    
    </div>    
        {{-- <a href="/dasboradSurat" class="fa fa-envelope"> Surat Menyurat</a> --}}
        
        
        <a href="/logout" class="fa fa-sign-out" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </a>   
        <form id="logout-form" action="/logout" method="post" style="display: none;">
            @csrf
        </form>
    </div>

<div class="container-fluid" style="padding-left: 17%;">
    <h1 style="margin-top: 0;"></h1>

    <div class="container mt-2">
        <div class="container-fluid" >
            <nav class="navbar navbar-expand navbar-light bg-white  static-top shadow  ">
                <!-- Sidebar Toggle (Topbar) -->
                <!-- Topbar Search -->
                <h1 style="margin-left: 2%"> Selamat Datang</h1>
            
            </nav>
            </div>
        </div>
        <h1 class="mt-5 mb-3"></h1>
        @yield('contener')
    </div>

    <div class="container mt - 4">
        @yield('konten')
    </div>
</div>

        
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script type="text/javascript">
   $(document).ready(function(){
  $('.sub-btn').click(function(){
    $(this).next('.sub-menu').slideToggle();
    $(this).find('.dropdown').toggleClass('up-arrow');
    $(this).parent().siblings().find('.sub-menu').slideUp(); // tambahkan baris ini untuk menyembunyikan submenu lainnya
  });
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous">
</script>


</body>
</html>

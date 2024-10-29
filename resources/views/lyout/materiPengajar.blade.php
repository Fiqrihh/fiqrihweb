<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inknut+Antiqua:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&family=EB+Garamond:wght@400;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style5.css') }}">
    <title>Halaman || pengajar || {{ $title }}</title>
</head>
<body>

  <div class="container-fluid">
  
    {{-- aside section --}}
    
    <aside>
      <div class="sb">
      <div class="atas">
        <div class="logo">
          <img src="{{ asset('gambar/logoo.png') }}">
          <p class="nama-Pondok">DLWI</p>
        </div>
        <div class="close" id="close-btn"><i class='bx bxs-left-arrow'></i></div>
      </div>

    <div class="sidebar">
      <ul class="menu">
        <li class="item"><a href="/pengajar/dashboard"><i class='bx bxs-dashboard'></i><span class="text">Dashboard</span></a></li>
        <li class="item"><a href="/pengajar/materi"><i class='bx bx-library'></i><span class="text">Materi</span></a></li>
        <li class="item"><a href="/tugas"><i class='bx bxs-book-bookmark'></i><span class="text">Tugas </span></a></li>
        <li class="item"><a href="/pengajar/ujian"><i class='bx bx-book-open' ></i><span class="text"> Ujian</span></a></li>
        <li class="item"><a href="/rekapNilai"><i class='bx bx-notepad' ></i></i><span class="text">Rekap</span></a></li>
        <li  class="item"><a>
          <form id="logoutForm" action="{{ route('pengajar.logout') }}" method="POST">
              @csrf
              <button type="submit" class="tombol" style="border: none; background: none; padding: 0; margin: 0; cursor: pointer; color: inherit; font: inherit;"> <i class='bx bx-log-out'> </i> <span class="text"> LogOut</span></button>
          </form>
          <li class="profile">
            <a href="#">      
                <div class="foto">
                    @if ($user->jenis_kelaminP == 'Laki-laki')
                        <img src="{{ asset('gambar/profile_ustad.jpg') }}" alt="Profile Ustad">
                    @else
                        <img src="{{ asset('gambar/ustadah.jpeg') }}" alt="Profile Ustadzah">
                    @endif
                </div>
            </a>
            <span>{{ $user->namaP }}</span>
        </li>
      </li>
     

      </ul>
    </div>
  </div>
    </aside>
    
    {{-- //aside section --}}

    {{-- main section --}}

    <main>
      <div class="page">
        <h3>{{ $title }}</h3>
      </div>

      <div class="info-page"> 
        <nav class="navbar navbar-expand navbar-light bg-white  static-top shadow  ">
          <!-- Sidebar Toggle (Topbar) -->
          <!-- Topbar Search -->
          <h1 style="margin-left: 2%">{{ $materi->judul_materi }}</h1>
      
      </nav>  
      </div>

      <div class="konten-utama">
     
        @yield('konten')
      </div>
    
    </main>

     {{-- //main section --}}
{{-- 
     <div class="kanan">
      <h1>kanan</h1>
     </div> --}}

  </div>  {{-- penutup layar/container --}}

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>

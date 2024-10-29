<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Pondok Pesantren Darul Lughah Waddirasatil</title>
    
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333; /* Warna teks */
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo {
            max-width: 150px;
        }
        .divider {
            border-top: 2px solid #333; /* Warna garis pembatas */
            margin: 20px 0;
        }
        .content {
            margin: 10px 0; /* Mengurangi margin pada konten */
            line-height: 1.4; /* Mengurangi line-height untuk membuat teks lebih rapat */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="" alt="Logo Pondok Pesantren" class="logo">
            <h2 style="color: #000000;">Pondok Pesantren Darul Lughah Waddirasatil</h2>
            <h6>VFMC+4VQ, Senenan, Akkor, Kec. Palengaan, Kabupaten Pamekasan, Jawa Timur 69362</h6>
            <b></b>
        </div>
        <div class="divider"></div>
        <div class="content">
            <p>Pamekasan, {{ $surat->tglSuratK }}</p>
            <p style=" color: #333;">No: {{ $surat->nomorSuratK }}/{{ date('m', strtotime($surat->tglSuratK)) }}/{{ date('Y', strtotime($surat->tglSuratK)) }}</p>
            <p style=" color: #333;">Perihal: {{ $surat->judulSuratK  }}</p>
           <p style=" color: #333; margin-top:50px">Yth. {{ $surat->Penerima }},</p></strong>
           <p>Di</p>
           <p>{{ $surat->tempat }}</p>  

            <p style="margin-top: 50px">Assalamualaikum Wr, Wb.
                Salam silaturahmi dari kami, semoga Alloh SWT Senantiasa melimpahkan rahmat dan hidayah Nya kepada kita, Amiin
            </p>
            
            <p>{{ $surat->isiSuratK  }}</p>
            
            <div class="signature" style="margin-bottom:10px; margin-top:100px">
                <p style="color: #333; ">Hormat kami,</p>
            </div>
            <div style="margin-top:70px;">
                <p style="font-weight: bold" >{{ $surat->fileSuratK }}</p>
                <p>Penanggung Jawab</p>
            </div>
        </div>
    </div>
</body>
</html>

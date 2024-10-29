@extends('lyout.materiPengajar')


@section('konten')
<div class="container">

    <p style="margin-top: 1rem">{{ $materi->deskripsi }}</p>

    <div class="penjelasan" style="width: 100%">
    <span style="white-space: pre-wrap;">{{ $materi->konten }}</span>
    </div>


    <div class="video" style="margin-top: 3rem">
        @if (!empty($materi->video_url))
            @php
                $videourl = $materi->video_url;
                
                if (strpos($videourl, "watch?v=") !== false) {
                    $coverturl = str_replace("watch?v=", "embed/", $videourl);
                } elseif (strpos($videourl, "youtu.be/") !== false) {
                    $video_id = explode("youtu.be/", $videourl)[1];
                    $coverturl = "https://www.youtube.com/embed/" . $video_id;
                }
            @endphp
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="{{ $coverturl }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        @endif
    </div>


   
    <!-- Embed video YouTube -->
    {{-- @if (!empty($materi->video_url))
    <div class="embed-responsive embed-responsive-16by9">
        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{ $materi->video_url }}" allowfullscreen></iframe>
    </div>
@endif --}}


    <!-- Informasi tambahan lainnya sesuai kebutuhan -->
    <p>Tanggal Pembuatan: {{ $materi->created_at }}</p>
    <!-- Tambahkan informasi lainnya yang perlu ditampilkan -->

</div>
@endsection

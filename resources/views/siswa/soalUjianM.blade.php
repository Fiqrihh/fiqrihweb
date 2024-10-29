@extends('lyout/ujian.ujianSoal')

@section('konten')
    <h3>mata pelajaran : {{ $ujian->mapel->nama_mapel }}</h3>
    <div class="pertanyaan">
       <h6>Soal:</h6>
       <p>{{ $ujian->pertanyaan }}</p>
    </div>
    @if ($ujian->audio_ujian)
    <div class="audio">
        <audio id="audioPlayer" src="{{ asset('storage/'.$ujian->audio_ujian) }}" preload="metadata"></audio>
        <div class="audio-controls">
            <button id="playPauseButton" class="play" style="font-size: 40px"><i class='bx bx-play' id="playPauseIcon"></i></button>
            <input type="range" id="progressBar" value="0" max="100" disabled>
            <div class="audio-progress">
                <span id="currentTime">00:00</span> / <span id="duration">00:00</span>
            </div>
        </div>
    </div>
    @endif
    <div class="jawaban">
        <form  action="/jawabanujian/murid"  method="POST" enctype="multipart/form-data">

            @csrf

            <input type="hidden" name="id_ujian" value="{{ $ujian->id_ujian }}">
            <input type="hidden" name="id_kelas" value="{{ $ujian->id_kelas }}">
            <input type="hidden" name="id_mapel" value="{{ $ujian->id_mapel }}">
            <input type="hidden" name="id_murid" value="{{ $user->id_murid }}">
            <input type="hidden" name="nilai_ujian" value="0">

            <div class="keyboardVirtual">
                <div id="app">
                    <div class="container">
                        <div class="jumbotron">
                            <h1></h1>
                            <div id="screen-component">
                                <textarea id="screen" placeholder="الجواب هنا"  dir="rtl" class="form-control" rows="5" autofocus name="student_ans"></textarea>
                            </div>
                            <div id="keyboard-component">
                                <div id="numbers">
                                    <!-- Numbers will be inserted here by JavaScript -->
                                </div>
                                <br>
                                <div id="keys">
                                    <!-- Keys will be inserted here by JavaScript -->
                                </div>
                                <div id="sp">
                                    <!-- Special keys will be inserted here by JavaScript -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <button type="submit" class="btn btn-primary" style="margin-top: 1rem">Kirim Jawaban</button>
        </form>
    </div>
   
    
    <script src="{{ asset('js/scriptkeyboard.js') }}"></script>

    </div>
    {{-- <div class="audio">
        <audio id="audioPlayer" src="{{ asset('storage/'.$ujian->audio_ujian) }}" preload="metadata"></audio>
        <div class="audio-controls">
            <button id="playPauseButton" class="play" style="font-size: 40px"><i class='bx bx-play' id="playPauseIcon"></i></button>
            <input type="range" id="progressBar" value="0" max="100" disabled>
            <div class="audio-progress">
                <span id="currentTime">00:00</span> / <span id="duration">00:00</span>
            </div>
        </div>
    </div> --}}
    
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const audioPlayer = document.getElementById('audioPlayer');
        const playPauseButton = document.getElementById('playPauseButton');
        const playPauseIcon = document.getElementById('playPauseIcon');
        const progressBar = document.getElementById('progressBar');
        const currentTimeDisplay = document.getElementById('currentTime');
        const durationDisplay = document.getElementById('duration');
    
        let isScrubbing = false;
    
        // Toggle Play/Pause
        playPauseButton.addEventListener('click', () => {
            if (audioPlayer.paused) {
                audioPlayer.play();
                playPauseIcon.classList.remove('bx-play');
                playPauseIcon.classList.add('bx-pause');
            } else {
                audioPlayer.pause();
                playPauseIcon.classList.remove('bx-pause');
                playPauseIcon.classList.add('bx-play');
            }
        });
    
        // Update duration when metadata is loaded
        audioPlayer.addEventListener('loadedmetadata', () => {
            durationDisplay.textContent = formatTime(audioPlayer.duration);
            progressBar.max = Math.floor(audioPlayer.duration);
        });
    
        // Update current time and progress bar during playback
        audioPlayer.addEventListener('timeupdate', () => {
            if (!isScrubbing) {
                progressBar.value = Math.floor(audioPlayer.currentTime);
                currentTimeDisplay.textContent = formatTime(audioPlayer.currentTime);
            }
        });
    
        // Scrubbing
        progressBar.addEventListener('input', () => {
            isScrubbing = true;
            const value = progressBar.value;
            currentTimeDisplay.textContent = formatTime(value);
        });
    
        progressBar.addEventListener('change', () => {
            audioPlayer.currentTime = progressBar.value;
            isScrubbing = false;
        });
    
        progressBar.addEventListener('mousedown', () => {
            isScrubbing = true;
        });
    
        progressBar.addEventListener('mouseup', () => {
            isScrubbing = false;
            audioPlayer.currentTime = progressBar.value;
        });
    
        // Reset play button when audio ends
        audioPlayer.addEventListener('ended', () => {
            playPauseIcon.classList.remove('bx-pause');
            playPauseIcon.classList.add('bx-play');
        });
    
        // Format time to MM:SS
        function formatTime(seconds) {
            const minutes = Math.floor(seconds / 60);
            const secs = Math.floor(seconds % 60);
            return `${String(minutes).padStart(2, '0')}:${String(secs).padStart(2, '0')}`;
        }
    });
    </script>
@endsection


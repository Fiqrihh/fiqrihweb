@extends('lyout/ujian.ujian')

@section('konten')
<div class="card">
    <div class="card-body">
        <h4>Mata Pelajaran: {{ $ujian->mapel->nama_mapel }}</h4>
        <h5>Deskripsi : {{ $ujian->Deskripsi }}</h5>
        <p>Pertanyaan:</p>
        <p>{{ $ujian->pertanyaan }}</p>
    </div>
    <div class="audio" style="">
        <audio id="audioPlayer" src="{{ asset('storage/'.$ujian->audio_ujian) }}" preload="metadata"></audio>
        <div class="audio-controls">
            <button id="playPauseButton" class="play" style="font-size: 40px"><i class='bx bx-play' id="playPauseIcon"></i></button>
            <input type="range" id="progressBar" value="0" max="100" disabled>
            <div class="audio-progress">
                <span id="currentTime">00:00</span> / <span id="duration">00:00</span>
            </div>
        </div>
    </div>
</div>

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

@extends('lyout.tugasMuridD')

@section('konten1')
<div class="container mt-3">
    <div class="row mt-3">
        <div class="col-12">
            <h1 class="text-center">{{ $tugas->no_tugas }}</h1>
        </div>
    </div>

    <div class="row task-card mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h6>{{ $tugas->deskripsi}}<h6>
                </div>
                <div class="card-body">
                    <div class="Soal">
                        <h5>Soal :</h5>
                    </div>
                    <span style="white-space: pre-wrap;">{{ $tugas->konten }}</span>
                    
                    <form  action="{{ route('tugas.jawabantugasM') }}"  method="POST" enctype="multipart/form-data">

                        @csrf

                        <input type="hidden" name="id_tugas" value="{{ $tugas->id_tugas }}">
                        <input type="hidden" name="id_kelas" value="{{ $tugas->id_kelas }}">
                        <input type="hidden" name="id_mapel" value="{{ $tugas->id_mapel }}">
                        <input type="hidden" name="id_murid" value="{{ $user->id_murid }}">
                        <input type="hidden" name="nilai_tugas" value="0">

                        <div class="form-group mt-3">
                            <label for="jawaban_text">Jawaban:</label>
                            <textarea class="form-control" id="jawaban_text" name="jawaban_text" rows="5" placeholder="Tulis jawaban Anda di sini...&#10;Jika jawaban berbentuk pdf, isi ngasal saja di sini" required></textarea>
                        </div>
                        <div class="form-group mt-3">
                            <label for="jawaban_file">Upload PDF:</label>
                            <input type="file" class="form-control-file" id="jawaban_file" name="jawaban_file"  required >
                        </div>
                        <button type="submit" class="btn btn-primary" style="margin-top: 1rem">Kirim Jawaban</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="fileTypeModal" tabindex="-1" aria-labelledby="fileTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fileTypeModalLabel">Peringatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Hanya file PDF, JPG, dan PNG yang diizinkan.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>


<script>
    document.getElementById('jawaban_file').addEventListener('change', function() {
        var file = this.files[0];
        var fileType = file.type.toLowerCase();
        if (!fileType.includes('pdf') && !fileType.includes('jpeg') && !fileType.includes('png')) {
            var fileTypeModal = new bootstrap.Modal(document.getElementById('fileTypeModal'));
            fileTypeModal.show(); // Show Bootstrap modal
            this.value = ''; // Clear the file input to allow re-selection
        }
    });
</script>



    
@endsection
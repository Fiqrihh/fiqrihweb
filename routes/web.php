<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\rekapController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\alumniController;
use App\Http\Controllers\rekaAdController;
use App\Http\Controllers\SantriController;
use App\Http\Controllers\SuratDController;
use App\Http\Controllers\SuratKController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\pengajarController;
use App\Http\Controllers\pengajarController2;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminPengController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginUserController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\AngkatanController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\akunUserController;
use App\Http\Controllers\MuridController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\WaktuPendaftaranController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

route::get('/pendaftaranspos',[PendaftaranController::class, 'index'])->name('pendaftaranspos');
route::post('/daftarverf',[PendaftaranController::class, 'store']);

// route::get('/pe',[NyobaController::class, 'index']);

//login admin
route::get('/logadminin/kali/ponpes/Dlwi', [AdminController::class, 'showLoginForm'])->name('login')->middleware('guest');
route::post('/login', [AdminController::class, 'login']);
// login User 
route::get('/LoginUser',[LoginUserController::class, 'index']);
route::post('/LoginUser',[LoginUserController::class, 'loginMultiUser'])->name('LoginUser')->middleware('guest');;


Route::middleware('auth.santri')->group(function () {

    route::post('/logoutM', [LoginUserController::class, 'logout'])->name('santri.logout');
    route::get('/MuridDash',[MuridController::class, 'index'])->name('santri.dashboard');
    route::get('/MuriMapel',[MuridController::class, 'mapel'])->name('santri.mapel');
    route::get('/mapel/{id}/materi',[MuridController::class, 'showMateri'])->name('santri.showMateri');
    Route::get('/murid/materi/{id}', [MuridController::class, 'show'])->name('materi.show');
    Route::get('/murid/tugasMrd', [MuridController::class, 'TugasMurid'])->name('tugas.muridTugas');
    // Route::get('/tugas/{id}/tugas', [MuridController::class, 'ShowTugasMurid'])->name('tugas.draftTugas');
    Route::get('/tugas/{id}/tugas', [MuridController::class, 'ShowTugasMurid'])->name('tugas.draftTugas');
    Route::get('/murid/tugas/{id}/p', [MuridController::class, 'soalTugas'])->name('tugas.soalTugasM');
    Route::post('/murid/tugas/ans', [MuridController::class, 'submitAnswer'])->name('tugas.jawabantugasM');
    
    Route::get('/murid/rekapNilai/awal', [MuridController::class, 'OpsiRekapNilai'])->name('tugas.mopsi');

    Route::get('/murid/rekapNilai', [MuridController::class, 'rekapNilaiMurid'])->name('tugas.NilaiDiri');
    
    Route::get('/murid/rekapNilai', [MuridController::class, 'rekapNilaiMurid'])->name('tugas.NilaiDiriujian');
    Route::get('/ujian/murid', [MuridController::class, 'UjianMurid'])->name('ujian.murid');
    Route::get('/ujianmurd/{id}', [MuridController::class, 'draftUjianMurid'])->name('ujian.asa');
    Route::get('/ujianpros/{id}/murid', [MuridController::class, 'soalujian'])->name('ujian.soall');
    Route::post('/jawabanujian/murid', [MuridController::class, 'jawabUjian'])->name('ujian.jawabMurid');
    Route::get('/murid/rekapNilai/ujian/siswa', [MuridController::class, 'rekapNilaiujianMurid'])->name('ujian.NilaiDiri');
   
    

    
    
    // Tambahkan route lain yang perlu diakses hanya oleh pengajar di sini
});

Route::middleware('auth.pengajar')->group(function () {

    route::post('/logoutP', [LoginUserController::class, 'logout'])->name('pengajar.logout');
    Route::get('/pengajar/dashboard', [PengajarController::class, 'index'])->name('pengajar.dashboard');
    Route::get('/pengajar/materi', [PengajarController::class, 'materi'])->name('pengajar.materi');
    Route::get('/pengajar/materi/add', [PengajarController::class, 'addMateriPage'])->name('tambah.materi');
    Route::post('/pengajar/materi/tambah', [PengajarController::class, 'storeMateri']);
    Route::get('/pengajar/materi/{id}', [PengajarController::class, 'showw'])->name('materi.showw');
    Route::get('/pengajar/materi/hapus/{id}', [PengajarController::class, 'hapusMateri'])->name('materi.hapus');
    Route::get('/materi/edit/{id_materi}', [PengajarController::class, 'edit'])->name('materi.edit');
    Route::put('/materi/update/{id_materi}', [PengajarController::class, 'update'])->name('materi.update');
    Route::get('/materi/{id}/draft', [PengajarController2::class, 'setStatusDraft'])->name('materi.draft');
    Route::get('/materi/{id}/post', [PengajarController2::class, 'setStatusPost'])->name('materi.post');


    Route::get('/tugas', [PengajarController::class, 'tugas'])->name('materi.tugas');
    Route::get('/mapel/{id}/tugas', [PengajarController::class, 'materiByMapel'])->name('materi.byMapel');
    
    Route::get('/add-tugas/{id}/add', [PengajarController::class, 'addTugas'])->name('materi.addTugas');
    Route::post('/add-tugas/{id}', [PengajarController::class, 'storeAddTugas'])->name('tugas.addTugass');
    Route::get('/detail/{id}', [PengajarController::class, 'detailTugas'])->name('tugas.detail');
    Route::get('/edit-tugas/{id}', [PengajarController::class, 'editTugas'])->name('tugas.editTugas');
    Route::put('/tugas/update/{id}', [PengajarController::class, 'tugasUpdate'])->name('tugas.update');
    Route::get('/tugas/hapus/{id}', [PengajarController::class, 'hapusTugas'])->name('tugas.hapus');
    Route::get('/tugas/{id}/siswa', [PengajarController::class, 'detailSiswa'])->name('tugas.detailSiswa');
    Route::put('/tugas/simpan-nilai/{id}', [PengajarController::class, 'updateNilai'])->name('tugas.simpanNilai');
    Route::get('/tugas/{id}/siswa/belum', [PengajarController::class, 'siswaTidakMengerjakan'])->name('tugas.siswaBeluM');
    Route::get('jawaban-tugas/{id}', [PengajarController::class, 'showPdfView']);

    Route::get('/rekapNilai', [PengajarController::class, 'rekapNilai'])->name('tugas.rekapNilai');
    Route::get('/rekapNilai/siswa', [PengajarController::class, 'rekapNilaiMurid'])->name('tugas.datarekapNilai');
    route::get('/trans/nilai/{id_murid}/{id_mapel}/lihat',[pengajarController::class, 'transkipNilaiPeng'])->name('tugas.transkip');
    Route::get('/pengajar/ujian', [PengajarController::class, 'ujianP'])->name('ujian.pengajar');
    Route::get('/mapel/{id}/ujian', [PengajarController::class, 'ujianDraft'])->name('ujian.draft');
    Route::get('/ujian/{id}/add', [PengajarController::class, 'formAddUjian'])->name('ujian.add');
    Route::post('/ujian', [PengajarController::class, 'addUjian'])->name('ujian.submitadd');
    Route::get('/pengajar/info/{id}', [PengajarController::class, 'infoUjian'])->name('ujian.infoo');
    Route::get('/pengajar/ujian/edit/{id}', [PengajarController::class, 'editUjian'])->name('ujian.edit');
    Route::put('/update/ujian/{id}', [PengajarController::class, 'updateUjian'])->name('ujian.update');
    Route::get('/ujian/hapus/{id}', [PengajarController::class, 'destroyUjian'])->name('ujian.hapus');
    Route::get('/ujian/detail/{id}', [PengajarController::class, 'detailSiswaujian'])->name('ujian.aneh');
    Route::get('/ujian/detail/{id}/belum', [PengajarController2::class, 'detailSiswaujianbelum'])->name('ujian.belum');
    Route::put('/submit/jawaban-ujian/{id}', [PengajarController2::class, 'submitNilaiUjian'])->name('ujian.submitNilai');
    Route::get('/rekapNilai/ujian/siswa', [PengajarController2::class, 'rekapNilaiujianMurid'])->name('ujian.datarekapNilai');
    Route::get('/jawaban-ujian/{id}', [PengajarController2::class, 'ujianCek'])->name('ujian.datarekapNilai');
    route::get('/trans/ujian/{id_murid}/{id_mapel}/lihat',[pengajarController2::class, 'transkipNilaiUjian'])->name('ujian.transkipp');
    
  





   
    // Tambahkan route lain yang perlu diakses hanya oleh pengajar di sini
});

    route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
    route::post('/register', [RegisterController::class, 'store']);
    
route::prefix('/')->middleware('auth')->group(function(){
    
    route::post('/logout', [AdminController::class, 'logout']);
    route::get('/', [DashboardController::class, 'index']);
    route::get('/transaksi', [KeuanganController::class, 'index']);
    route::get('/transaksi/pengeluaran', [PengeluaranController::class, 'index']);
    route::get('/transaksi/pemasukan', [PemasukanController::class, 'index']);
    route::post('/transaksi/peng', [PengeluaranController::class, 'store']);
    route::post('/transaksi/pem', [PemasukanController::class, 'store']);
    Route::get('/transaksi/pengeluaran/{id}/edit', [PengeluaranController::class, 'edit']);
    Route::put('/transaksi/pengeluaran/{id}', [PengeluaranController::class, 'update']);
    Route::get('/transaksi/pemasukan/{id}/edit', [PemasukanController::class, 'edit']);
    Route::put('/transaksi/pemasukan/{id}', [PemasukanController::class, 'update']);
    // Route::get('/murid/{id}/edit', [SantriController::class, 'edit']);
    Route::put('/murid/{id}/edit', [SantriController::class, 'update']);
    route::put('/transaksi/{id}/update', [PengeluaranController::class, 'update']);
    route::get('/transaksi/semua', [DashboardController::class, 'create']);
// angkatan
    route::get('/angkatan',[AngkatanController::class,'index']);
    route::post('/angkatan',[AngkatanController::class,'store']);
    route::get('/angkatan/{id}/edit',[AngkatanController::class,'edit']);
    route::put('/angkatan/edit/{id}',[AngkatanController::class,'update']);
    route::get('/angkatan/{id}/hapus',[AngkatanController::class, 'destroy']);
    //murid
    Route::post('/toggle-registration', [PendaftaranController::class, 'toggleRegistration'])->name('toggle.registration');
    route::get('/murid', [SantriController::class, 'index1'])->name('muridd');
    route::post('/murid', [SantriController::class, 'store']);
    route::get('/murid/{id}/delete', [SantriController::class, 'destroy']);
    route::put('/murid/edit/{id}', [SantriController::class, 'update']);
    Route::get('/murid/{id}/verifikasi', [SantriController::class, 'verifikasi']);
    Route::get('/murid/{id}/tidak-verifikasi',  [SantriController::class, 'tidakVerivikasi']);

    Route::post('/toggle-pendaftaran', [WaktuPendaftaranController::class,'togglePendaftaran'])->name('toggle.pendaftaran');

    //kelas
    route::get('/Mkelas', [KelasController::class, 'index']);
    route::post('/Mkelas', [KelasController::class, 'store']);
    route::put('/Mkelas/{id}/edit',[KelasController::class,'update']);
    route::get('/Mkelas/{id}/delete',[KelasController::class,'destroy']);
    Route::get('/kelas/{id_kelas}/murid', [KelasController::class, 'kelasMurid']);

    Route::post('/murid/naik-kelas/{id}', [KelasController::class, 'naikKelas'])->name('murid.naikKelas');


    route::get('/transaksi/{id}/peng/delete', [PengeluaranController::class, 'destroy']);
    route::get('/transaksi/{id}/pem/delete', [PemasukanController::class, 'destroy']);
    route::get('/profile', [ProfileController::class, 'index']);
    route::get('/editaku', [ProfileController::class, 'editt']);
    route::post('/updateprofile', [ProfileController::class, 'update']);
    // pengajar
    route::get('/data-pengajar',[AdminPengController::class,'index']);
    route::post('/data-pengajar',[AdminPengController::class,'store']);
    route::put('/data-pengajar/{id}/edit',[AdminPengController::class,'updatee']);
    route::get('/data-pengajar/{id}/hapus', [AdminPengController::class, 'destroy']);

    // akun

    // akun pengajar
    route::get('/akun-pengajar',[akunUserController::class,'indexpengajar']);
    Route::put('/update-pengajar', [akunUserController::class, 'addPengajar']);
    Route::put('/brbresetpassword', [akunUserController::class, 'updatePasswordPengajar']);
    // akun murid
    route::get('/akun-murid',[akunUserController::class,'indexmurid']);
    Route::put('/add-Murid', [akunUserController::class, 'addMurid']);
    Route::put('/brbresetpassword', [akunUserController::class, 'updatePasswordMurid']);

    // endakun
    route::get('/kategori', [KategoriController::class, 'index']);
    Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit']);
    Route::put('/kategori/{id}', [PengeluaranController::class, 'update']);
    route::get('/kategori/{id}/delete', [KategoriController::class, 'destroy']);
    route::post('/kategori', [KategoriController::class, 'store']);
    // mapel
    route::get('/mapel', [MapelController::class, 'index']);
    route::post('/mapel', [MapelController::class, 'store']);
    route::get('/mapel/edit/{id}', [MapelController::class, 'edit']);
    route::put('/mapel/{id}/edit', [MapelController::class, 'update']);
    route::get('/mapel/{id}/hapus', [MapelController::class, 'destroy']);
    route::get('/dasboradSurat', [SuratDController::class, 'index']);
    route::get('/sMasuk', [SuratController::class, 'index']);
    route::post('/sMasuk', [SuratController::class, 'store']);
    // Route::get('/pdf/{id}', [pdfcController::class, 'show'])->name('pdf.show');
    // Route::get('/pdff/{id}', [pdfController::class, 'show'])->name('pdf.show');
    Route::get('/sMasuk/{id}/edit', [SuratController::class, 'edit']);
    Route::put('/sMasuk/{id}', [SuratController::class, 'update']);
    route::get('/surat/{id}/masuk/delete', [SuratController::class, 'destroy']);

    route::get('/sKeluar', [SuratKController::class, 'index']);
    route::post('/sKeluar', [SuratKController::class, 'store']);
    Route::get('/sKeluar/{id}/edit', [SuratKController::class, 'edit']);
    Route::put('/sKeluar/{id}', [SuratKController::class, 'update']);
    route::get('/sKeluar/{id}/delete', [SuratKController::class, 'destroy']);
    Route::put('/verifikasi-kelas/{id}', [SantriController::class, 'verif'])->name('verifikasi-kelas');;
    Route::get('/sKeluar/{id}/print', [SuratKController::class, 'printPDF'])->name('sKeluar.print');

    route::get('/rekap', [rekapController::class, 'index']);
    route::post('/rekap', [rekapController::class, 'store']);
    Route::get('/cetak_pdf/{id}', [rekapController::class, 'cetakPDF'])->name('cetak_pdf');

    route::get('/alumni', [alumniController::class, 'index']);
    route::get('/alumni/{id}/delete', [alumniController::class, 'destroy']);
    route::get('/rekapad', [rekaAdController::class, 'index']);
    route::get('/rekapad/{id}', [rekaAdController::class, 'printRekap'])->name('print.rekap');
    Route::get('/rekapad/print', [rekaAdController::class, 'printRekap'])->name('print.rekap');
    });
// Route::get('/p', function () {
//     return view('welcome');
// });
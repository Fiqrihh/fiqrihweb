<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use App\Models\Surat;


class pdfcController extends Controller
{

public function show($id)
{
    $data = Surat::find($id); // Gantilah sesuai model dan struktur aplikasi Anda
    
    if (!$data) {
        abort(404);
    }

    $pdfPath = 'filemasuk/'. $data->fileSuratM ; // Gantilah sesuai dengan lokasi penyimpanan file PDF

    return response()->file(Storage::path($pdfPath));
}

}

<?php

namespace App\Http\Controllers;

use App\Models\WaktuPendaftaran;
use Illuminate\Http\Request;
use App\Http\Requests\StoreWaktuPendaftaranRequest;
use App\Http\Requests\UpdateWaktuPendaftaranRequest;

class WaktuPendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function togglePendaftaran(Request $request)
    {
        $pendaftaran = WaktuPendaftaran::first();

        if ($pendaftaran) {
            // Update status dan teks_pendaftaran sesuai input dari tombol
            $pendaftaran->status = $request->status;
            $pendaftaran->teks_pendaftaran = $request->status == 'buka' ? 'pendaftaran di buka' : 'pendaftaran di tutup';
        } else {
            // Jika data tidak ada, buat baru dengan status 'buka'
            $pendaftaran = new WaktuPendaftaran();
            $pendaftaran->status = 'buka';
            $pendaftaran->teks_pendaftaran = 'pendaftaran di buka';
        }

        $pendaftaran->save();

        return response()->json(['success' => true, 'status' => $pendaftaran->status, 'teks_pendaftaran' => $pendaftaran->teks_pendaftaran]);
    }

}

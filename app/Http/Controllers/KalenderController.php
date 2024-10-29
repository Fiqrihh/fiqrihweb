<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class KalenderController extends Controller
{
    public function index()
    {
        $today = Carbon::now();
        $daysInMonth = $today->daysInMonth;
        $startOfMonth = $today->startOfMonth();

        return view('dashboard',[
            'daysInMonth' => $daysInMonth,
            'startOfMonth' => $startOfMonth
        ]);
    }
}

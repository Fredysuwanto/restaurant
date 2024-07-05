<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller

{
    public function index() {
    $jumlah_kasir = DB::select("SELECT kasirs.no_kasir, COUNT(*) as jumlah FROM pembayarans
    JOIN kasirs ON pembayarans.kasir_id = kasirs.id
    GROUP BY kasirs.no_kasir");

    return view('dashboard')->with('jumlah_kasir', $jumlah_kasir);
    }
}
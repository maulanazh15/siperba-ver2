<?php

namespace App\Http\Controllers;

use App\Models\LaporanBarangMasuk;
use Illuminate\Http\Request;
use PDF;

class LaporanBarangMasukController extends Controller
{
    public function index() {
        $laporanbarangMasuk = laporanbarangMasuk::all();
        return view('laporan-barang-masuk.index', compact('laporanbarangMasuk'));
    }

    public function exportPDF()
    {
        $laporanbarangMasuk = laporanbarangMasuk::all();
        $pdf = PDF::loadView('laporan-barang-masuk.pdf', compact('laporanbarangMasuk'));

        return $pdf->download('laporan-barang-masuk.pdf');
    }
}

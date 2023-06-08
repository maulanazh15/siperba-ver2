<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use PDF;

class LaporanBarangMasukController extends Controller
{
    public function index() {
        $laporanbarangMasuk = BarangMasuk::all();
        return view('laporan-barang-masuk.index', compact('laporanbarangMasuk'));
    }

    public function exportPDF()
    {
        $laporanbarangMasuk = BarangMasuk::all();
        $pdf = PDF::loadView('laporan-barang-masuk.pdf', compact('laporanbarangMasuk'));

        return $pdf->download('laporan-barang-masuk.pdf');
    }
}

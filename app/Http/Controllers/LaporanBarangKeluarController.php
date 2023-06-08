<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use Illuminate\Http\Request;
use PDF;

class LaporanBarangKeluarController extends Controller
{
    public function index() {
        $laporanbarangKeluar = BarangKeluar::all();
        return view('laporan-barang-keluar.index', compact('laporanbarangKeluar'));
    }

    public function exportPDF()
    {
        $laporanbarangKeluar = BarangKeluar::all();
        $pdf = PDF::loadView('laporan-barang-keluar.pdf', compact('laporanbarangKeluar'));

        return $pdf->download('laporan-barang-keluar.pdf');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use PDF;

class LaporanBarangMasukController extends Controller
{
    public function __construct()
    {
        // Apply middleware to the controller actions
        $this->middleware('permission:view laporan-barang-masuk')->only('index');
        $this->middleware('permission:export laporan-barang-masuk')->only('exportPDF');
    }

    public function index()
    {
        // Only allow access if user has permission
        $this->authorize('view laporan-barang-masuk');

        $laporanbarangMasuk = BarangMasuk::all();
        return view('laporan-barang-masuk.index', compact('laporanbarangMasuk'));
    }

    public function exportPDF()
    {
        // Only allow access if user has permission
        $this->authorize('export laporan-barang-masuk');

        $laporanbarangMasuk = BarangMasuk::all();
        $pdf = PDF::loadView('laporan-barang-masuk.pdf', compact('laporanbarangMasuk'));

        return $pdf->download('laporan-barang-masuk.pdf');
    }
}

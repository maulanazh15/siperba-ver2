<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use PDF;

class LaporanBarangKeluarController extends Controller
{
    public function __construct()
    {
        // Apply middleware to the controller actions
        $this->middleware('permission:view laporan-barang-keluar')->only('index');
        $this->middleware('permission:export laporan-barang-keluar')->only('exportPDF');
    }

    public function index()
    {
        // Only allow access if user has permission
        $this->authorize('view laporan-barang-keluar');

        $laporanbarangKeluar = BarangKeluar::all();
        return view('laporan-barang-keluar.index', compact('laporanbarangKeluar'));
    }

    public function exportPDF()
    {
        // Only allow access if user has permission
        $this->authorize('export laporan-barang-keluar');

        $laporanbarangKeluar = BarangKeluar::all();
        $pdf = PDF::loadView('laporan-barang-keluar.pdf', compact('laporanbarangKeluar'));

        return $pdf->download('laporan-barang-keluar.pdf');
    }
}

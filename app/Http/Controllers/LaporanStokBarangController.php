<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

use PDF;

class LaporanStokBarangController extends Controller
{
    public function __construct()
    {
        // Apply middleware to the controller actions
        $this->middleware('permission:view laporan-stok-barang')->only('index');
        $this->middleware('permission:export laporan-stok-barang')->only('exportPDF');
    }

    public function index()
    {
        // Only allow access if user has permission
        $this->authorize('view laporan-stok-barang');

        $barangs = Barang::all();
        return view('laporan-stok-barang.index', compact('barangs'));
    }

    public function exportPDF()
    {
        // Only allow access if user has permission
        $this->authorize('export laporan-stok-barang');

        $barangs = Barang::all();
        $pdf = PDF::loadView('laporan-stok-barang.pdf', compact('barangs'));

        return $pdf->download('laporan-stok-barang.pdf');
    }
}

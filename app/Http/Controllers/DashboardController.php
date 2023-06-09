<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Klien;


class DashboardController extends Controller
{
    public function index()
    {
        $total_klien = klien::count();
        $total_supplier = Supplier::count();
        $total_data_barang = Barang::count();
        $total_stok_barang = Barang::sum('stok');
        return view('dashboard.index', compact('total_data_barang', 'total_stok_barang', 'total_klien', 'total_supplier'));
    }
}

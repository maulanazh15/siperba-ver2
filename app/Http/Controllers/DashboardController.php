<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $total_data_barang = Barang::count();
        $total_stok_barang = Barang::sum('stok');
        return view('dashboard.index', compact('total_data_barang', 'total_stok_barang'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Project;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    public function __construct()
    {
        // Apply middleware to the controller actions
        $this->middleware('permission:view barang-keluar')->only('index');
        $this->middleware('permission:create barang-keluar')->only('create', 'store');
    }

    public function index() {
        // Only allow access if user has permission
        $this->authorize('view barang-keluar');
        $barangKeluar = BarangKeluar::all();

        return view('transaksi.barang-keluar.index', compact('barangKeluar'));
    }

    public function create()
    {
        // Only allow access if user has permission
        $this->authorize('create barang-keluar');
        // Menampilkan halaman form tambah barang keluar
        $projects = Project::where('status','Pending')->get(); // Mengambil semua data project

        return view('transaksi.barang-keluar.tambah', compact('projects'));
    }

    public function store(Request $request)
    {
        // Only allow access if user has permission
        $this->authorize('create barang-keluar');
        // Validasi inputan
        $request->validate([
            'tanggal_keluar' => 'required|date',
            'project_id' => 'required',
            'jumlah_keluar' => 'required',
            'total_stok' => 'required',
        ]);

        // Simpan data barang keluar ke database
        $barangKeluar = new BarangKeluar;
        $barangKeluar->tanggal_keluar = $request->tanggal_keluar;
        $barangKeluar->project_id = $request->project_id;
        $barangKeluar->barang_id = $request->barang_id;
        $barangKeluar->jumlah_keluar = $request->jumlah_keluar;

        // Simpan data barang masuk
        if ($barangKeluar->save()) {
            Barang::where('id', $request->barang_id)->update(['stok' => $request->total_stok]);
            Project::where('id', $request->project_id)->update(['status' => 'Proses']);
        }

        // Redirect ke halaman daftar barang keluar dengan pesan sukses
        return redirect()->route('barang-keluar.index')->with('success', 'Data barang keluar berhasil disimpan.');
    }
}

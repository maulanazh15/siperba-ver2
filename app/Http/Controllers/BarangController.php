<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\LokasiBarang;
use Illuminate\Http\Request;
use App\Models\KelompokBarang;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        // Apply middleware to the controller actions
        $this->middleware('permission:view barang')->only('index');
        $this->middleware('permission:create barang')->only('create', 'store');
        $this->middleware('permission:edit barang')->only('edit', 'update');
        $this->middleware('permission:delete barang')->only('destroy');
    }
    public function index()
    {
        $this->authorize('view barang');

        $barang = Barang::all();
        
        return view('barang.index', compact('barang'));
    }

    public function create()
    {
        $this->authorize('create barang');
        $kelompokBarang = KelompokBarang::all();
        $lokasiBarang = LokasiBarang::all();
        return view('barang.create', compact('kelompokBarang', 'lokasiBarang'));
    }

    public function store(Request $request)
    {
        $this->authorize('create barang');
        $request->validate([
            'nama_barang' => 'required',
            'kelompok_barang' => 'required',
            // 'harga_beli' => 'required',
            // 'harga_jual' => 'required',
            'lokasi_barang' => 'required',
            'keterangan' => 'required',
        ]);

        Barang::create([
            'nama_barang' => $request->nama_barang,
            'kelompok_barang_id' => $request->kelompok_barang,
            // 'harga_beli' => $request->harga_beli,
            // 'harga_jual' => $request->harga_jual,
            'lokasi_barang_id' => $request->lokasi_barang,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    public function edit(Barang $barang)
    {
        $this->authorize('edit barang');
        $kelompokBarang = KelompokBarang::all();
        $lokasiBarang = LokasiBarang::all();
        return view('barang.edit', compact('barang', 'kelompokBarang', 'lokasiBarang'));
    }

    public function update(Request $request, Barang $barang)
    {
        $this->authorize('edit barang');
        $request->validate([
            'nama_barang' => 'required',
            'kelompok_barang' => 'required',
            // 'harga_beli' => 'required',
            // 'harga_jual' => 'required',
            'lokasi_barang' => 'required',
            'keterangan' => 'required',
        ]);

        $barang->update([
            'nama_barang' => $request->nama_barang,
            'kelompok_barang' => $request->kelompok_barang,
            // 'harga_beli' => $request->harga_beli,
            // 'harga_jual' => $request->harga_jual,
            'lokasi_barang' => $request->lokasi_barang,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy(Barang $barang)
    {
        $this->authorize('delete barang');
        $barang->delete();
        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus.');
    }
}

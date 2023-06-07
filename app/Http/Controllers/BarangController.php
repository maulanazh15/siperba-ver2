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
    public function index()
    {
        $barang = Barang::all();
        
        return view('barang.index', compact('barang'));
    }

    public function create()
    {
        $kelompokBarang = KelompokBarang::all();
        $lokasiBarang = LokasiBarang::all();
        return view('barang.create', compact('kelompokBarang', 'lokasiBarang'));
    }

    public function store(Request $request)
    {
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
        $kelompokBarang = KelompokBarang::all();
        $lokasiBarang = LokasiBarang::all();
        return view('barang.edit', compact('barang', 'kelompokBarang', 'lokasiBarang'));
    }

    public function update(Request $request, Barang $barang)
    {
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
        $barang->delete();
        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus.');
    }
}

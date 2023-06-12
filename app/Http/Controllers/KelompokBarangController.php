<?php

namespace App\Http\Controllers;

use App\Models\KelompokBarang;
use Illuminate\Http\Request;

class KelompokBarangController extends Controller
{
    public function __construct()
    {
        // Apply middleware to the controller actions
        $this->middleware('permission:view kelompok-barang')->only('index');
        $this->middleware('permission:create kelompok-barang')->only('create', 'store');
        $this->middleware('permission:edit kelompok-barang')->only('edit', 'update');
        $this->middleware('permission:delete kelompok-barang')->only('destroy');
    }

    public function index()
    {
        // Only allow access if user has permission
        $this->authorize('view kelompok-barang');

        $kelompokBarangs = KelompokBarang::all();
        return view('kelompok-barang.index', compact('kelompokBarangs'));
    }

    public function create()
    {
        // Only allow access if user has permission
        $this->authorize('create kelompok-barang');

        return view('kelompok-barang.create');
    }

    public function store(Request $request)
    {
        // Only allow access if user has permission
        $this->authorize('create kelompok-barang');

        $validatedData = $request->validate([
            'nama_kelompok' => 'required|string|max:255',
        ]);

        $kelompokBarang = new KelompokBarang();
        $kelompokBarang->nama_kelompok = $request->nama_kelompok;
        $kelompokBarang->save();

        return redirect()->route('kelompok-barang.index')->with('success', 'Kelompok Barang has been created successfully');
    }

    public function edit(KelompokBarang $kelompokBarang)
    {
        // Only allow access if user has permission
        $this->authorize('edit kelompok-barang');

        return view('kelompok-barang.edit', compact('kelompokBarang'));
    }

    public function update(Request $request, KelompokBarang $kelompokBarang)
    {
        // Only allow access if user has permission
        $this->authorize('edit kelompok-barang');

        $request->validate([
            'nama_kelompok' => 'required|max:255',
        ]);

        $kelompokBarang->update([
            'nama_kelompok' => $request->nama_kelompok,
        ]);

        return redirect()->route('kelompok-barang.index')->with('success', 'Kelompok barang berhasil diperbarui.');
    }

    public function destroy(KelompokBarang $kelompokBarang)
    {
        // Only allow access if user has permission
        $this->authorize('delete kelompok-barang');

        $kelompokBarang->delete();

        return redirect()->route('kelompok-barang.index')->with('success', 'Kelompok barang berhasil dihapus.');
    }
}

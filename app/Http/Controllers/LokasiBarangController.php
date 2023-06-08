<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LokasiBarang;
use Spatie\Permission\Models\Permission;

class LokasiBarangController extends Controller
{
    public function __construct()
    {
        // Apply middleware to the controller actions
        $this->middleware('permission:view lokasi-barang')->only('index');
        $this->middleware('permission:create lokasi-barang')->only('create', 'store');
        $this->middleware('permission:edit lokasi-barang')->only('edit', 'update');
        $this->middleware('permission:delete lokasi-barang')->only('destroy');
    }

    public function index()
    {
        // Only allow access if user has permission
        $this->authorize('view lokasi-barang');

        $lokasiBarangs = LokasiBarang::all();
        return view('lokasi-barang.index', compact('lokasiBarangs'));
    }

    public function create()
    {
        // Only allow access if user has permission
        $this->authorize('create lokasi-barang');

        return view('lokasi-barang.create');
    }

    public function edit(LokasiBarang $lokasiBarang)
    {
        // Only allow access if user has permission
        $this->authorize('edit lokasi-barang');

        return view('lokasi-barang.edit', compact('lokasiBarang'));
    }

    public function store(Request $request)
    {
        // Only allow access if user has permission
        $this->authorize('create lokasi-barang');

        $validatedData = $request->validate([
            'nama_lokasi' => 'required',
        ]);

        LokasiBarang::create($validatedData);

        return redirect()->route('lokasi-barang.index')
            ->with('success', 'Lokasi barang berhasil ditambahkan.');
    }

    public function update(Request $request, LokasiBarang $lokasiBarang)
    {
        // Only allow access if user has permission
        $this->authorize('edit lokasi-barang');

        $validatedData = $request->validate([
            'nama_lokasi' => 'required',
        ]);

        $lokasiBarang->update($validatedData);

        return redirect()->route('lokasi-barang.index')
            ->with('success', 'Lokasi barang berhasil diperbarui.');
    }

    public function destroy(LokasiBarang $lokasiBarang)
    {
        // Only allow access if user has permission
        $this->authorize('delete lokasi-barang');

        $lokasiBarang->delete();

        return redirect()->route('lokasi-barang.index')
            ->with('success', 'Lokasi barang berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LokasiBarang;

class LokasiBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lokasiBarangs = LokasiBarang::all();
        return view('lokasi-barang.index', compact('lokasiBarangs'));        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('lokasi-barang.create');
    }

   /**
     * Display the specified resource edit form.
     */
    public function edit(LokasiBarang $lokasiBarang)
    {
        return view('lokasi-barang.edit', compact('lokasiBarang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_lokasi' => 'required',
        ]);

        LokasiBarang::create($validatedData);

        return redirect()->route('lokasi-barang.index')
            ->with('success', 'Lokasi barang berhasil ditambahkan.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LokasiBarang $lokasiBarang)
    {
        $validatedData = $request->validate([
            'nama_lokasi' => 'required',
        ]);

        $lokasiBarang->update($validatedData);

        return redirect()->route('lokasi-barang.index')
            ->with('success', 'Lokasi barang berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LokasiBarang $lokasiBarang)
    {
        $lokasiBarang->delete();

        return redirect()->route('lokasi-barang.index')
            ->with('success', 'Lokasi barang berhasil dihapus.');
    }
}

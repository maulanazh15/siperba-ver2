<?php

namespace App\Http\Controllers;

use App\Models\KelompokBarang;
use Illuminate\Http\Request;

class KelompokBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelompokBarangs = KelompokBarang::all();
        return view('kelompok-barang.index', compact('kelompokBarangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kelompok-barang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_kelompok' => 'required|string|max:255',
        ]);
    
        $kelompokBarang = new KelompokBarang();
        $kelompokBarang->nama_kelompok = $request->nama_kelompok;
        $kelompokBarang->save();
    
        return redirect()->route('kelompok-barang.index')->with('success', 'Kelompok Barang has been created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(KelompokBarang $kelompokBarang)
    {
        //
    }

     /**
     * Show the form for editing the specified resource.
     */
    public function edit(KelompokBarang $kelompokBarang)
    {
        return view('kelompok-barang.edit', compact('kelompokBarang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KelompokBarang $kelompokBarang)
    {
        $request->validate([
            'nama_kelompok' => 'required|max:255',
        ]);

        $kelompokBarang->update([
            'nama_kelompok' => $request->nama_kelompok,
        ]);

        return redirect()->route('kelompok-barang.index')->with('success', 'Kelompok barang berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KelompokBarang $kelompokBarang)
    {
        $kelompokBarang->delete();

        return redirect()->route('kelompok-barang.index')->with('success', 'Kelompok barang berhasil dihapus.');
    }
}

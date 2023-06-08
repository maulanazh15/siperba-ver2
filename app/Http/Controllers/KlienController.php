<?php

namespace App\Http\Controllers;

use App\Models\Klien;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Permission;

class KlienController extends Controller
{
    public function __construct()
    {
        // Apply middleware to the controller actions
        $this->middleware('permission:view klien')->only('index');
        $this->middleware('permission:create klien')->only('create', 'store');
        $this->middleware('permission:edit klien')->only('edit', 'update');
        $this->middleware('permission:delete klien')->only('destroy');
    }

    public function index()
    {
        // Only allow access if user has permission
        $this->authorize('view klien');

        $kliens = Klien::all();
        return view('klien.index', compact('kliens'));
    }

    public function create()
    {
        // Only allow access if user has permission
        $this->authorize('create klien');

        return view('klien.create');
    }

    public function store(Request $request)
    {
        // Only allow access if user has permission
        $this->authorize('create klien');

        $request->validate([
            'nama_klien' => 'required',
            'perusahaan' => 'required',
            'divisi' => 'required',
            'no_telepon' => 'required',
            'alamat' => 'required',
        ]);

        Klien::create($request->all());

        return redirect()->route('klien.index')->with('success', 'Klien berhasil ditambahkan');
    }

    public function edit(Klien $klien)
    {
        // Only allow access if user has permission
        $this->authorize('edit klien');

        return view('klien.edit', compact('klien'));
    }

    public function update(Request $request, Klien $klien)
    {
        // Only allow access if user has permission
        $this->authorize('edit klien');

        $request->validate([
            'nama_klien' => 'required',
            'perusahaan' => 'required',
            'divisi' => 'required',
            'no_telepon' => 'required',
            'alamat' => 'required',
        ]);

        $klien->update($request->all());

        return redirect()->route('klien.index')->with('success', 'Klien berhasil diperbarui');
    }

    public function destroy(Klien $klien)
    {
        // Only allow access if user has permission
        $this->authorize('delete klien');

        $klien->delete();

        return redirect()->route('klien.index')->with('success', 'Klien berhasil dihapus');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();
        return view('supplier.index', compact('suppliers'));
    }

    public function create()
    {
        return view('supplier.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_supplier' => 'required',
            'alamat' => 'required',
            'no_telepon' => 'required',
            'rekening' => 'required',
        ]);

        Supplier::create($request->all());

        return redirect()->route('supplier.index')
            ->with('success', 'Supplier created successfully');
    }

    public function edit(Supplier $supplier)
    {
        return view('supplier.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'nama_supplier' => 'required',
            'alamat' => 'required',
            'no_telepon' => 'required',
            'rekening' => 'required',
        ]);

        $supplier->update($request->all());

        return redirect()->route('supplier.index')
            ->with('success', 'Supplier updated successfully');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect()->route('supplier.index')
            ->with('success', 'Supplier deleted successfully');
    }
}

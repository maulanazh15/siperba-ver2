<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use Spatie\Permission\Models\Permission;

class SupplierController extends Controller
{
    public function __construct()
    {
        // Apply middleware to the controller actions
        $this->middleware('permission:view suppliers')->only('index');
        $this->middleware('permission:create suppliers')->only('create', 'store');
        $this->middleware('permission:edit suppliers')->only('edit', 'update');
        $this->middleware('permission:delete suppliers')->only('destroy');
    }

    public function index()
    {
        // Only allow access if user has permission
        $this->authorize('view suppliers');

        $suppliers = Supplier::all();
        return view('supplier.index', compact('suppliers'));
    }

    public function create()
    {
        // Only allow access if user has permission
        $this->authorize('create suppliers');

        return view('supplier.create');
    }

    public function store(Request $request)
    {
        // Only allow access if user has permission
        $this->authorize('create suppliers');

        $request->validate([
            'nama_supplier' => 'required',
            'alamat' => 'required',
            'no_telepon' => 'required',
            'rekening' => 'required',
        ]);

        Supplier::create($request->all());

        return redirect()->route('supplier.index')->with('success', 'Supplier created successfully');
    }

    public function edit(Supplier $supplier)
    {
        // Only allow access if user has permission
        $this->authorize('edit suppliers');

        return view('supplier.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        // Only allow access if user has permission
        $this->authorize('edit suppliers');

        $request->validate([
            'nama_supplier' => 'required',
            'alamat' => 'required',
            'no_telepon' => 'required',
            'rekening' => 'required',
        ]);

        $supplier->update($request->all());

        return redirect()->route('supplier.index')->with('success', 'Supplier updated successfully');
    }

    public function destroy(Supplier $supplier)
    {
        // Only allow access if user has permission
        $this->authorize('delete suppliers');

        $supplier->delete();

        return redirect()->route('supplier.index')->with('success', 'Supplier deleted successfully');
    }
}

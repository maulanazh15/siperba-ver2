<?php

namespace App\Http\Controllers;

use App\Models\PO;
use App\Models\Barang;
use App\Models\Supplier;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Permission;

class POController extends Controller
{
    public function __construct()
    {
        // Apply middleware to the controller actions
        $this->middleware('permission:view po')->only('indexPO');
        $this->middleware('permission:create po')->only('tambahPO', 'prosesPO');
        $this->middleware('permission:edit po')->only('ambilDataPO');
    }

    public function indexPO()
    {
        // Only allow access if user has permission
        $this->authorize('view po');

        $poBarang = PO::all();
        return view('transaksi.po.index', compact('poBarang'));
    }

    public function tambahPO()
    {
        // Only allow access if user has permission
        $this->authorize('create po');

        $barang = Barang::all();
        $supplier = Supplier::all(); 
        return view('transaksi.po.tambah', compact('barang', 'supplier'));
    }

    public function prosesPO(Request $request)
    {
        // Only allow access if user has permission
        $this->authorize('create po');

        $request->validate([
            'barang_id' => 'required',
            'supplier_id' => 'required',
            'tanggal' => 'required',
            'harga_barang' => 'required|numeric',
            'jumlah_barang' => 'required|numeric',
            'detail' => 'nullable',
        ]);
    
        $po = new PO();
        $po->barang_id = $request->barang_id;
        $po->supplier_id = $request->supplier_id;
        $po->harga_barang = $request->harga_barang;
        $po->jumlah_barang = $request->jumlah_barang;
        $po->detail = $request->detail;
        $po->tanggal = $request->tanggal;
        $po->status = 'Dipesan';
        $po->save();
    
        // Redirect to success page or show success message
        return redirect()->route('po.index')->with('success', 'PO Barang berhasil ditambahkan');
    }
    
    public function ambilDataPO($kode_po)
    {
        // Only allow access if user has permission
        $this->authorize('edit po');

        $po = PO::where('kode_po', $kode_po)->first();
        $data = [
            'barang_id'=> $po->barang_id,
            'nama_barang' => $po->barang->nama_barang,
            'stok_barang' => $po->barang->stok,
            'jumlah_masuk' => $po->jumlah_barang,
        ];
        return response()->json($data);
    }
}
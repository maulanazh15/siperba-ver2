<?php

namespace App\Http\Controllers;

use App\Models\PO;
use App\Models\Barang;
use App\Models\Supplier;
use Illuminate\Http\Request;

class TransaksiMasukController extends Controller
{
    public function indexPO() {
        $poBarang = PO::all();

        return view('transaksi.po.index', compact('poBarang'));

    }

    public function tambahBarangMasuk() {
        return view('transaksi.barang-masuk.tambah');
    }

    public function tambahPO() {
        $barang = Barang::all();
        $supplier = Supplier::all(); 
        return view('transaksi.po.tambah', compact('barang', 'supplier'));
    }

    public function prosesPO(Request $request) {
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
        $po->save();
    
        // Redirect to success page or show success message
        return redirect()->route('po.index')->with('success', 'PO Barang berhasil ditambahkan');
    }
    


}

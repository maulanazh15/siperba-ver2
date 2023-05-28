<?php

namespace App\Http\Controllers;

use App\Models\PO;
use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\Supplier;
use Illuminate\Http\Request;

class TransaksiMasukController extends Controller
{
    public function indexPO() {
        $poBarang = PO::all();

        return view('transaksi.po.index', compact('poBarang'));

    }

    public function indexBarangMasuk() { 
        $barangMasuk = BarangMasuk::all();

        return view('transaksi.barang-masuk.index', compact('barangMasuk'));

    }

    public function tambahBarangMasuk() {
        $po = PO::all();
        
        return view('transaksi.barang-masuk.tambah', compact('po'));
    }

    public function prosesBarangMasuk(Request $request)
    {
        // Validasi data masukan
        $request->validate([
            'tanggal_masuk' => 'required|date',
            'kode_po' => 'required',
            'barang_id' => 'required',
            'total_stok' => 'required|numeric',
            'jumlah_masuk' => 'required|numeric',
        ]);
    
        // Buat objek BarangMasuk dan isi dengan data masukan
        $barangMasuk = new BarangMasuk();
        $barangMasuk->tanggal_masuk = $request->tanggal_masuk;
        $barangMasuk->kode_po = $request->kode_po;
        $barangMasuk->barang_id = $request->barang_id;
        $barangMasuk->jumlah_masuk = $request->jumlah_masuk;

        // Simpan data barang masuk
        if ($barangMasuk->save()) {
            Barang::where('id', $request->barang_id)->update(['stok' => $request->total_stok]);
        }
       

        // Redirect atau berikan respons sesuai kebutuhan Anda
        return redirect()->route('barang-masuk.index')->with('success', 'Data barang masuk berhasil disimpan.');
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
    
    public function ambilDataPO($kode_po) { 
        $po = PO::where('kode_po', $kode_po)->first();
        $data = [
            'barang_id'=> $po->barang_id,
            'nama_barang' => $po->barang->nama_barang,
            'stok_barang' => $po->barang->stok,
            'jumlah_masuk' => $po->jumlah_barang,
        ];
        // dd($po);
        return response()->json($data);
    }


}

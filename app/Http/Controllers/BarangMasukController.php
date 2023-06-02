<?php

namespace App\Http\Controllers;

use App\Models\PO;
use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\Supplier;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    

    public function indexBarangMasuk() { 
        $barangMasuk = BarangMasuk::all();

        return view('transaksi.barang-masuk.index', compact('barangMasuk'));

    }

    public function tambahBarangMasuk() {
        $po = PO::where('status', 'Dipesan')->get();
        
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
            PO::where('kode_po',$request->kode_po)->update(['status' => 'Masuk']);
        }
       
        // Redirect atau berikan respons sesuai kebutuhan Anda
        return redirect()->route('barang-masuk.index')->with('success', 'Data barang masuk berhasil disimpan.');
    }

}

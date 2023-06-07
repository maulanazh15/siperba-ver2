<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table = 'barang';
    protected $fillable = [
        'nama_barang',
        'kelompok_barang_id',
        'harga_beli',
        'harga_jual',
        'stok',
        'lokasi_barang_id',
        'keterangan',
    ];

    public function kelompokBarang()
    {
        return $this->belongsTo(KelompokBarang::class, 'kelompok_barang_id');
    }

    public function lokasiBarang()
    {
        return $this->belongsTo(LokasiBarang::class, 'lokasi_barang_id');
    }

    public function poBarang() {
        return $this->hasMany(PO::class);
    }
}

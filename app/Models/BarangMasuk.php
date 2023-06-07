<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;

    protected $table = 'barang_masuk'; // Nama tabel dalam basis data

    protected $fillable = [
        'tanggal_masuk',
        'kode_po',
        'barang_id',
        'jumlah_masuk',
    ];

    // Relasi dengan model Barang
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}

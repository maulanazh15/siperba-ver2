<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_project',
        'tanggal_pesan',
        'barang_id',
        'klien_id',
        'harga_jual',
        'jumlah_pesanan',
        'status',
        'detail',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function klien()
    {
        return $this->belongsTo(Klien::class);
    }
}

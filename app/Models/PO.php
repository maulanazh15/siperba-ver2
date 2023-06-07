<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PO extends Model
{
    use HasFactory;

    protected $table = 'po';
    protected $primaryKey = 'kode_po';
    public $incrementing = true;
    protected $fillable = [
        'kode_po',
        'tanggal',
        'barang_id',
        'supplier_id',
        'harga_barang',
        'jumlah_barang',
        'detail',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokasiBarang extends Model
{
    use HasFactory;

    protected $table = 'lokasi_barang';

    protected $fillable = [
        'nama_lokasi',
    ];

    // Relationship with Barang
    public function lokasi()
    {
        return $this->hasMany(Barang::class);
    }
}

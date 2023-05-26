<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelompokBarang extends Model
{
    use HasFactory;

    protected $table = 'kelompok_barang';

    protected $fillable = [
        'nama_kelompok',
    ];

    // Relationship with Barang
    // public function barang()
    // {
    //     return $this->hasMany(Barang::class);
    // }
}

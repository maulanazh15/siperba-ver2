<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Barang;
use App\Models\LokasiBarang;
use App\Models\KelompokBarang;
use Illuminate\Database\Seeder;

class KelompokBarangSeeder extends Seeder
{
    public function run()
    {
        // Menambahkan data ke dalam tabel kelompok_barang
        KelompokBarang::create([
            'nama_kelompok' => 'Kelompok 1',
        ]);

        KelompokBarang::create([
            'nama_kelompok' => 'Kelompok 2',
        ]);

        // Tambahkan data lainnya sesuai kebutuhan
    }
}

class LokasiBarangSeeder extends Seeder
{
    public function run()
    {
        // Menambahkan data ke dalam tabel lokasi_barang
        LokasiBarang::create([
            'nama_lokasi' => 'Lokasi 1',
        ]);

        LokasiBarang::create([
            'nama_lokasi' => 'Lokasi 2',
        ]);

        // Tambahkan data lainnya sesuai kebutuhan
    }
}

class BarangSeeder extends Seeder
{
    public function run()
    {
        // Menambahkan data ke dalam tabel barang
        Barang::create([
            'nama_barang' => 'Barang 1',
            'kelompok_barang_id' => 1,
            'harga_beli' => 1000,
            'harga_jual' => 2000,
            'lokasi_barang_id' => 1,
            'keterangan' => 'Keterangan barang 1',
        ]);

        Barang::create([
            'nama_barang' => 'Barang 2',
            'kelompok_barang_id' => 2,
            'harga_beli' => 1500,
            'harga_jual' => 2500,
            'lokasi_barang_id' => 2,
            'keterangan' => 'Keterangan barang 2',
        ]);

        // Tambahkan data lainnya sesuai kebutuhan
    }
}

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@material.com',
            'password' => ('secret')
        ]);

        // Menjalankan seeder untuk kelompok_barang
        $this->call(KelompokBarangSeeder::class);

        // Menjalankan seeder untuk lokasi_barang
        $this->call(LokasiBarangSeeder::class);

        // Menjalankan seeder untuk barang
        $this->call(BarangSeeder::class);
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Klien;
use App\Models\Barang;
use App\Models\Project;
use App\Models\Supplier;
use App\Models\LokasiBarang;
use App\Models\KelompokBarang;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as FakerFactory;

class KelompokBarangSeeder extends Seeder
{
    public function run()
    {
        $faker = FakerFactory::create();

        for ($i = 0; $i < 100; $i++) {
            KelompokBarang::create([
                'nama_kelompok' => $faker->word,
            ]);
        }
    }
}

class LokasiBarangSeeder extends Seeder
{
    public function run()
    {
        $faker = FakerFactory::create();

        for ($i = 0; $i < 100; $i++) {
            LokasiBarang::create([
                'nama_lokasi' => $faker->word,
            ]);
        }
    }
}

class BarangSeeder extends Seeder
{
    public function run()
    {
        $faker = FakerFactory::create();

        for ($i = 0; $i < 100; $i++) {
            Barang::create([
                'nama_barang' => $faker->word,
                'kelompok_barang_id' => $faker->numberBetween(1, 100),
                'lokasi_barang_id' => $faker->numberBetween(1, 100),
                'keterangan' => $faker->sentence,
            ]);
        }
    }
}

class SupplierSeeder extends Seeder
{
    public function run()
    {
        $faker = FakerFactory::create();

        for ($i = 0; $i < 100; $i++) {
            Supplier::create([
                'nama_supplier' => $faker->company,
                'alamat' => $faker->address,
                'rekening' => $faker->bankAccountNumber,
                'no_telepon' => $faker->phoneNumber,
            ]);
        }
    }
}

class KlienSeeder extends Seeder
{
    public function run()
    {
        $faker = FakerFactory::create();

        for ($i = 0; $i < 100; $i++) {
            Klien::create([
                'nama_klien' => $faker->name,
                'perusahaan' => $faker->company,
                'alamat' => $faker->address,
                'divisi' => $faker->word,
                'no_telepon' => $faker->phoneNumber,
            ]);
        }
    }
}

class ProjectSeeder extends Seeder
{
    public function run()
    {
        $faker = FakerFactory::create();

        for ($i = 0; $i < 100; $i++) {
            Project::create([
                'nama_project' => $faker->word,
                'tanggal_pesan' => $faker->date,
                'barang_id' => $faker->numberBetween(1, 100),
                'klien_id' => $faker->numberBetween(1, 100),
                'harga_jual' => $faker->numberBetween(1000, 5000),
                'jumlah_pesanan' => $faker->numberBetween(1, 50),
                'status' => $faker->randomElement(['Pending','Proses', 'Selesai']),
                'detail' => $faker->sentence,
            ]);
        }
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
            'password' => Hash::make('secret')
        ]);

        // Menjalankan seeder untuk kelompok_barang
        $this->call(KelompokBarangSeeder::class);

        // Menjalankan seeder untuk lokasi_barang
        $this->call(LokasiBarangSeeder::class);

        // Menjalankan seeder untuk barang
        $this->call(BarangSeeder::class);

        // Menjalankan seeder untuk supplier
        $this->call(SupplierSeeder::class);

        // Menjalankan seeder untuk klien
        $this->call(KlienSeeder::class);

        // Menjalankan seeder untuk project
        $this->call(ProjectSeeder::class);
    }
}

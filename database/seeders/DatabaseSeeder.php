<?php

namespace Database\Seeders;

use App\Models\PO;
use App\Models\User;
use App\Models\Klien;
use App\Models\Barang;
use App\Models\Project;
use App\Models\Supplier;
use App\Models\BarangMasuk;
use Illuminate\Support\Str;
use App\Models\BarangKeluar;
use App\Models\LokasiBarang;
use App\Models\KelompokBarang;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
                'stok'=> $faker->numberBetween(1000,10000)
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

class POSeeder extends Seeder {
    public function run() {
        $faker = FakerFactory::create();
        for($i = 0; $i < 50; $i++) {
            PO::create([
                'barang_id' => $faker->numberBetween(1, 100),
                'tanggal'=> $faker->date,
                'supplier_id' => $faker->numberBetween(1, 100),
                'harga_barang' => $faker->numberBetween(10000, 500000),
                'jumlah_barang' => $faker->numberBetween(100, 5000),
                'status' => $faker->randomElement(['Dipesan']),
                'detail' => $faker->word
            ]);
        }
    }
}

class BarangMasukSeeder extends Seeder {
    public function run() { 
        $faker = FakerFactory::create();
        for($i = 0; $i < 40; $i++) {
            $dummyData = [
                'tanggal_masuk'=> $faker->date,
                'kode_po' => $faker->numberBetween(1, 50),
                'jumlah_masuk'=> $faker->numberBetween(50, 1000),
            ];
            $dummyData['barang_id'] = PO::where('kode_po', $dummyData['kode_po'])->first()->barang_id;
            BarangMasuk::create($dummyData);
            Barang::where('id', $dummyData['barang_id'])->update(['stok'=> Barang::find($dummyData['barang_id'])->first()->stok + $dummyData['jumlah_masuk']]);
            PO::where('kode_po', $dummyData['kode_po'])->update(['status'=> 'Masuk']);
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
                'status' => $faker->randomElement(['Pending']),
                'detail' => $faker->sentence,
            ]);
        }
    }
}

class BarangKeluarSeeder extends Seeder {
    public function run() { 
        $faker = FakerFactory::create();
        for($i = 0; $i < 40; $i++) {
            $dummyData = [
                'tanggal_keluar'=> $faker->date,
                'project_id' => $faker->numberBetween(1, 100),
                'jumlah_keluar'=> $faker->numberBetween(50, 1000),
            ];
            $dummyData['barang_id'] = Project::where('id', $dummyData['project_id'])->first()->barang_id;
            BarangKeluar::create($dummyData);
            Barang::where('id', $dummyData['barang_id'])->update(['stok'=> Barang::find($dummyData['barang_id'])->first()->stok - $dummyData['jumlah_keluar']]);
            Project::where('id', $dummyData['project_id'])->update(['status'=> 'Dalam Proses']);
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
        
        // User::factory()->create([
        //     'name' => 'Admin',
        //     'email' => 'admin@material.com',
        //     'password' => ('secret')
        // ]);
        $this->call(RoleSeeders::class);

        $this->call(UserSeeders::class);

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
        // Menjalankan seeder untuk po barang
        $this->call(POSeeder::class);
        // Menjalankan seeder untuk barang masuk
        $this->call(BarangMasukSeeder::class);

        // Menjalankan seeder untuk project
        $this->call(ProjectSeeder::class);

        // Menjalankan seeder untuk barang keluar
        $this->call(BarangKeluarSeeder::class);
    }
}

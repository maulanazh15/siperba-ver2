<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // reset cache roles dan permission
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        // buat permissions
        Permission::create(['name' => 'view barang']);
        Permission::create(['name' => 'create barang']);
        Permission::create(['name' => 'edit barang']);
        Permission::create(['name' => 'delete barang']);

        Permission::create(['name' => 'view barang-keluar']);
        Permission::create(['name' => 'create barang-keluar']);
        Permission::create(['name' => 'view barang-masuk']);
        Permission::create(['name' => 'create barang-masuk']);

        Permission::create(['name' => 'view kelompok-barang']);
        Permission::create(['name' => 'create kelompok-barang']);
        Permission::create(['name' => 'edit kelompok-barang']);
        Permission::create(['name' => 'delete kelompok-barang']);

        Permission::create(['name' => 'view klien']);
        Permission::create(['name' => 'create klien']);
        Permission::create(['name' => 'edit klien']);
        Permission::create(['name' => 'delete klien']);

        Permission::create(['name' => 'view laporan-barang-keluar']);
        Permission::create(['name' => 'export laporan-barang-keluar']);

        Permission::create(['name' => 'view laporan-barang-masuk']);
        Permission::create(['name' => 'export laporan-barang-masuk']);

        Permission::create(['name' => 'view lokasi-barang']);
        Permission::create(['name' => 'create lokasi-barang']);
        Permission::create(['name' => 'edit lokasi-barang']);
        Permission::create(['name' => 'delete lokasi-barang']);

        Permission::create(['name' => 'view po']);
        Permission::create(['name' => 'create po']);
        Permission::create(['name' => 'edit po']);

        Permission::create(['name' => 'view projects']);
        Permission::create(['name' => 'create projects']);
        Permission::create(['name' => 'edit projects']);
        Permission::create(['name' => 'delete projects']);

        Permission::create(['name' => 'view suppliers']);
        Permission::create(['name' => 'create suppliers']);
        Permission::create(['name' => 'edit suppliers']);
        Permission::create(['name' => 'delete suppliers']);

        Permission::create(['name' => 'view user management']);
        Permission::create(['name' => 'create user management']);
        Permission::create(['name' => 'edit user management']);
        Permission::create(['name' => 'delete user management']);

        $pemilikRole = Role::create([
            'name' => 'pemilik',
            'guard_name' => 'web',
        ]);
    
        // Assign permissions to the pemilik role
        $pemilikRole->syncPermissions([
            'view laporan-barang-keluar',
            'export laporan-barang-keluar',
            'view laporan-barang-masuk',
            'export laporan-barang-masuk',
            'view user management',
            'create user management',
            'edit user management',
            'delete user management',
        ]);
    
        $manajerRole = Role::create([
            'name' => 'manajer',
            'guard_name' => 'web',
        ]);
    
        // Assign all permissions to the manajer role
        $manajerRole->syncPermissions(Permission::pluck('name')->toArray());
    
        $staffRole = Role::create([
            'name' => 'staff',
            'guard_name' => 'web',
        ]);
    
        // Assign permissions to the staff role
        $staffRole->syncPermissions([
            'view barang',
            'create barang',
            'edit barang',
            'delete barang',
            'view kelompok-barang',
            'create kelompok-barang',
            'edit kelompok-barang',
            'delete kelompok-barang',
            'view klien',
            'create klien',
            'edit klien',
            'delete klien',
            'view suppliers',
            'create suppliers',
            'edit suppliers',
            'delete suppliers',
            'view lokasi-barang',
            'create lokasi-barang',
            'edit lokasi-barang',
            'delete lokasi-barang',
        ]);
    }
}

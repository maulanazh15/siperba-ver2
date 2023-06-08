<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class UserSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create users with roles
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@material.com',
            'password' => ('secret'),
            'akses'=> 'Staff'
        ]);

        $admin->assignRole('staff');
        
        $pemilik = User::create([
            'name' => 'Pemilik User',
            'email' => 'pemilik@example.com',
            'password' => ('password'),
            'akses'=> 'Pemilik'
        ]);
        $pemilik->assignRole('pemilik');

        $manajer = User::create([
            'name' => 'Manajer User',
            'email' => 'manajer@example.com',
            'password' => ('password'),
            'akses'=> 'Pemilik'
        ]);
        $manajer->assignRole('manajer');

        $staff = User::create([
            'name' => 'Staff User',
            'email' => 'staff@example.com',
            'password' => ('password'),
            'akses'=> 'Staff'
        ]);
        $staff->assignRole('staff');
    }
}

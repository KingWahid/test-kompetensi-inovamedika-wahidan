<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions (using firstOrCreate to avoid duplicates)
        $permissions = [
            'manage-users',
            'manage-patients',
            'manage-appointments',
            'view-medical-records',
            'create-medical-records',
            'manage-billing',
            'view-reports',
            'manage-settings',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles and assign permissions (using firstOrCreate to avoid duplicates)
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->syncPermissions(Permission::all());

        $registrationRole = Role::firstOrCreate(['name' => 'petugas']);
        $registrationRole->syncPermissions([
            'manage-patients',
            'manage-appointments',
        ]);

        $doctorRole = Role::firstOrCreate(['name' => 'dokter']);
        $doctorRole->syncPermissions([
            'view-medical-records',
            'create-medical-records',
            'manage-appointments',
        ]);

        $cashierRole = Role::firstOrCreate(['name' => 'kasir']);
        $cashierRole->syncPermissions([
            'manage-billing',
            'view-reports',
        ]);

        // Create default admin user (using firstOrCreate to avoid duplicates)
        $admin = User::firstOrCreate(
            ['email' => 'admin@clinic.com'],
            [
                'name' => 'Administrator 1',
                'password' => bcrypt('password'),
            ]
        );
        $admin->assignRole('admin');

        // Create sample users for each role
        $petugas = User::firstOrCreate(
            ['email' => 'petugas@clinic.com'],
            [
                'name' => 'Petugas Pendaftaran 1',
                'password' => bcrypt('password'),
            ]
        );
        $petugas->assignRole('petugas');

        $dokter = User::firstOrCreate(
            ['email' => 'dokter@clinic.com'],
            [
                'name' => 'Dr. Amira',
                'password' => bcrypt('password'),
            ]
        );
        $dokter->assignRole('dokter');

        $kasir = User::firstOrCreate(
            ['email' => 'kasir@clinic.com'],
            [
                'name' => 'Juwita',
                'password' => bcrypt('password'),
            ]
        );
        $kasir->assignRole('kasir');
    }
}

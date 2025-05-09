<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermission extends Seeder
{
    public function run(): void
    {
        // Buat Permissions
        $permissions = [
            'manage-role',
            'manage-permission',
            'view-guru',
            'manage-guru',
            'view-siswa',
            'manage-siswa',
            'view-matapelajaran',
            'manage-matapelajaran'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Buat Roles
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $guru = Role::firstOrCreate(['name' => 'guru']);
        $siswa = Role::firstOrCreate(['name' => 'siswa']);

        $admin->syncPermissions($permissions);

        $guru->syncPermissions([
            'view-guru',
            'view-siswa',
            'view-matapelajaran'
        ]);

        $siswa->syncPermissions([
            'view-matapelajaran'
        ]);

        // $user = \App\Models\User::find(1);
        // $user->assignRole('admin');
    }
}

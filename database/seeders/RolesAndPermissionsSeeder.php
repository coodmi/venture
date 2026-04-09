<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create roles
        $admin   = Role::firstOrCreate(['name' => 'admin']);
        $investor = Role::firstOrCreate(['name' => 'investor']);
        $seeker  = Role::firstOrCreate(['name' => 'seeker']);
        $member  = Role::firstOrCreate(['name' => 'member']);

        // Create admin user
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@venturematch.com'],
            [
                'name'              => 'VentureMatch Admin',
                'password'          => bcrypt('Admin@123!'),
                'status'            => 'active',
                'email_verified_at' => now(),
            ]
        );
        $adminUser->assignRole('admin');
    }
}

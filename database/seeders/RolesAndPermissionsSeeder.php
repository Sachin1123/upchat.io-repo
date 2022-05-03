<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $roleUser = Role::updateOrCreate(['name' => 'Customer']);
        $roleAdmin = Role::updateOrCreate(['name' => 'Admin']);
        $roleStaff = Role::updateOrCreate(['name' => 'Staff']);

       

        $userAdmin = User::updateOrCreate(
                        [
                            'name' => 'Admin',
                            'email' => 'admin@admin.com',
                        ],
                        [
                            'password' => bcrypt('admin123')
        ]);
        
       
        $user = User::updateOrCreate(
                        [
                            'name' => 'User',
                            'email' => 'user@user.com',
                        ],
                        [
                            'password' => bcrypt('admin123')
        ]);
        $staff = User::updateOrCreate(
            [
                'name' => 'staff',
                'email' => 'staff@staff.com',
            ],
            [
                'password' => bcrypt('admin123')
        ]);
        $userAdmin->assignRole($roleAdmin);
        $user->assignRole($roleUser);
        $staff->assignRole($roleStaff);

    }

}

<?php

use App\Admin;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $permissions = \Spatie\Permission\Models\Permission::all()->pluck('name');
        $role = Role::updateOrCreate(['name' => 'super-admin']);

        foreach ($permissions as $permission) {
            $role->givePermissionTo($permission);
        }
        $user = Admin::updateOrCreate(['name' => 'admin', 'email' => 'admin@admin.com', 'password' => Hash::make('password')]);

//        $user = Admin::findOrFail(4);
      
        if (!$user->hasRole('super-admin')) {
            $user->assignRole('super-admin');
        }

        if (!$user) {
//            $user = Admin::updateOrCreate(['name' => 'admin', 'email' => 'admin@admin.com', 'password' => Hash::make('password')]);
            $user->assignRole('super-admin');
        }


    }
}

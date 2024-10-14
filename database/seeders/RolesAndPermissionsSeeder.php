<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // permission products
        Permission::firstOrCreate(['name' => 'edit products']);
        Permission::firstOrCreate(['name' => 'delete products']);
        Permission::firstOrCreate(['name' => 'create products']);

        // permission users
        Permission::firstOrCreate(['name' => 'create users']);
        Permission::firstOrCreate(['name' => 'delete users']);

        // permission jobs
        Permission::firstOrCreate(['name' => 'create jobs']);
        Permission::firstOrCreate(['name' => 'delete jobs']);
        Permission::firstOrCreate(['name' => 'edit jobs']);

        $roleWrite = Role::firstOrCreate(['name' => 'writer']);
        $roleWrite->givePermissionTo('edit products');

        $roleMod = Role::firstOrCreate(['name' => 'mod']);

        $roleSuperAdmin = Role::firstOrCreate(['name' => 'super-admin']);

        // $user = User::factory()->create([
        //     'name' => "admin",
        //     'email' => 'admin@gmail.com',
        //     'password' => Hash::make("123456"),
        // ]);
        // $user->assignRole($roleSuperAdmin);

        $user2 = User::factory()->create([
            'name' => "cuong1",
            'email' => 'cuong1@gmail.com',
            'password' => Hash::make("123456"),
        ]);
        $user2->assignRole($roleWrite);
    }
}

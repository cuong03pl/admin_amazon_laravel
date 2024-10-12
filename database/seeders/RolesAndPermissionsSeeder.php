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
        Permission::create(['name' => 'edit products']);
        Permission::create(['name' => 'delete products']);
        Permission::create(['name' => 'create products']);

        // permission users
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'delete users']);

        // permission jobs
        Permission::create(['name' => 'create jobs']);
        Permission::create(['name' => 'delete jobs']);
        Permission::create(['name' => 'edit jobs']);

        $roleWrite = Role::create(['name' => 'writer']);
        $roleWrite->givePermissionTo('edit products');

        $roleSuperAdmin = Role::create(['name' => 'super-admin']);

        $user = User::factory()->create([
            'name' => "admin",
            'email' => 'admin@gmail.com',
            'password' => Hash::make("123456"),
        ]);
        $user->assignRole($roleSuperAdmin);
    }
}

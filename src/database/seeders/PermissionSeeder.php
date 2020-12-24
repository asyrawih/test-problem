<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset Cache semua permission
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        //Generate Permission nya 
        Permission::create(['name' => 'finance']);
        Permission::create(['name' => 'all permission']);
        Permission::create(['name' => 'editor']);

        /**
         * Available Role
         * 
         * Administrator
         * Finance
         * Supervisor
         * Editor
         * 
         */
        // ADMIN ROLE
        $role1 = Role::create(['name' => 'Administrator']);
        $role1->givePermissionTo('all permission');
        
        // FINACE ROLE
        $role2 = Role::create(['name' => 'Finance']);
        $role2->givePermissionTo('finance');

        // Editor Permission
        $role3 = Role::create(['name' => 'editor']);
        $role3->givePermissionTo('editor');

        $user = User::factory()->create([
            'name' => 'admin',
            'email' => 'test@example.com',
        ]);
        $user->assignRole($role1);
        
        $user = User::factory()->create([
            'name' => 'finance',
            'email' => 'finance@example.com',
        ]);
        $user->assignRole($role2);
        
        // Editor
        $user = User::factory()->create([
            'name' => 'editor',
            'email' => 'editor@example.com',
        ]);
        $user->assignRole($role3);

    }
}

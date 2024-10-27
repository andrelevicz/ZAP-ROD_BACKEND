<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {

        Permission::create(['name' => 'create-transaction']);
        Permission::create(['name' => 'edit-transaction']);
        Permission::create(['name' => 'delete-transaction']);
        Permission::create(['name' => 'view-transaction']);
 
        Permission::create(['name' => 'view-report']);

        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo(Permission::all());

        $financeManager = Role::create(['name' => 'finance_manager']);
        $financeManager->givePermissionTo(['create-transaction', 'edit-transaction', 'delete-transaction', 'view-transaction']);

        $accountant = Role::create(['name' => 'accountant']);
        $accountant->givePermissionTo(['view-report']);

        $user = Role::create(['name' => 'user']);
        $user->givePermissionTo(['view-transaction']);
    }
}

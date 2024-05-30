<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Enums\ApplicationRole;
use App\Enums\Permissions\UserPermission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        //CALL OTHER SEEDERS

        //ROLES
        $admin = Role::firstOrCreate(['name' => ApplicationRole::Admin]);
        $support = Role::firstOrCreate(['name' => ApplicationRole::Support]);

        //CREATE IF NOT EXIST AN USER ADMIN AND ASSIGN ADMIN ROLE
        User::firstOrCreate(
            ['email' =>  'admin@mail.com'],
            [
                'name' => 'Administrador',
                'last_name' => 'admin',
                'password' => Hash::make('secret')
            ],
        )->assignRole($admin->name);


        //PERMISSIONS

        // Users
        Permission::firstOrCreate(['name' => UserPermission::ViewAny])->syncRoles([$admin, $support]);
        Permission::firstOrCreate(['name' => UserPermission::View])->syncRoles([$admin, $support]);
        Permission::firstOrCreate(['name' => UserPermission::Create])->syncRoles([$admin, $support]);
        Permission::firstOrCreate(['name' => UserPermission::Update])->syncRoles([$admin, $support]);
        Permission::firstOrCreate(['name' => UserPermission::Delete])->syncRoles([$admin, $support]);
        Permission::firstOrCreate(['name' => UserPermission::Restore])->syncRoles([$admin]);
        Permission::firstOrCreate(['name' => UserPermission::ForceDelete])->syncRoles([$admin]);

        //Default Users

        //Support
        User::firstOrCreate(
            ['email' =>  'support@mail.com'],
            [
                'name' => 'Soporte',
                'last_name' => 'Admin',
                'password' => Hash::make('secret')
            ],
        )->assignRole($support->name);
    }
}

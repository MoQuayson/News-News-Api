<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use SebastianBergmann\Environment\Console;
use Symfony\Component\Console\Output\ConsoleOutput;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => Role::ADMIN]);
        //$userRole = Role::create(['name' => Role::USERS]);

        $permissions = Permission::all();

        $user = User::create([
            'name'=> 'Administrator',
            'email' => 'admin@example.com',
            'password' => 'password',
        ]);

        $role->syncPermissions($permissions);

        $user->assignRole([$role->name]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => Role::USERS]);

        $permissions = [
            'view user',
            'read articles',
            'personalize feeds',

        ];

        $role->syncPermissions($permissions);
    }
}

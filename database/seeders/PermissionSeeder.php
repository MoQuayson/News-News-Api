<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = collect([
            //user permissions
            'add user',
            'edit user',
            'delete user',
            'list users',
            'view user',

            //permissions
            'add permission',
            'edit permission',
            'delete permission',
            'list permissions',
            'view permission',

            //roles
            'add role',
            'edit role',
            'delete role',
            'list roles',
            'view role',
            'assign roles',
            'revoke roles',

            //feeds
            'read articles',
            'personalize feeds',
        ])->map(fn ($permission) => Permission::create(['name' => $permission]))
            ->map(fn ($permission) => $permission->name);

    }
}

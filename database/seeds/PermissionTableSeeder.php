<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    public function run()
    {
        //Make some dufault permissions
        $permissions = [
            'create',
            'edit',
            'delete'
        ];

        foreach ($permissions as $key => $permission) {
            Permission::create(['name' => $permission]);
        }
    }

    //php artisan db:seed --class=PermissionTableSeeder
    //php artisan migrate:fresh --seed
}

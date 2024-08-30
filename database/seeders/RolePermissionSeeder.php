<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Role::create(['name' => 'superadmin']);
       Role::create(['name' => 'admin']);
       Role::create(['name' => 'sale']);
       Permission::create(['name' => 'customers']);
       Permission::create(['name' => 'products']);
    }
}

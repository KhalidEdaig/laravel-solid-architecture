<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'name'=>'companies.*'
        ]);
        Permission::create([
            'name'=>'companies.create'
        ]);
        Permission::create([
            'name'=>'companies.edit'
        ]);
        Permission::create([
            'name'=>'companies.delete'
        ]);
        Permission::create([
            'name'=>'companies.view'
        ]);
    }
}

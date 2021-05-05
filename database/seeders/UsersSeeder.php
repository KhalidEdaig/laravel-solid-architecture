<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $user = User::create([
            'username' => 'admin',
            'email' => 'admin@app.com',
            'email_verified_at' => now(),
            'password' => 'password',
        ]);
        $role=Role::findOrCreate('super_admin');
        $user->assignRole($role);
    }
}

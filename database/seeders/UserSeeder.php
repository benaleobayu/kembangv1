<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaultValue = ([
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(16)
        ]);
        
        $admins = User::create(array_merge([
            'name' => 'Super Admin',
            'username' => 'Super.Admin',
            'email' => 'admin@test.com'
        ],$defaultValue));
        $user1 = User::create(array_merge([
            'name' => 'Priska',
            'username' => 'Officer.Priska',
            'email' => 'priska@test.com'
        ],$defaultValue));
        $user2 = User::create(array_merge([
            'name' => 'Eka',
            'username' => 'Officer.Eka',
            'email' => 'eka@test.com'
        ],$defaultValue));
        $user3 = User::create(array_merge([
            'name' => 'Beno',
            'username' => 'User.Beno',
            'email' => 'beno@test.com'
        ],$defaultValue));

        $role = Role::create(['name' => 'Admin']);
        $role = Role::create(['name' => 'Officer']);
        $role = Role::create(['name' => 'User']);

     

        $user1->assignRole('Officer');
        $user2->assignRole('Officer');
        $user3->assignRole('User');
        $admins->assignRole('Admin');


        
    }
}

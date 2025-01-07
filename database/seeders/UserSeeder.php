<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    public function run()
    {
        $superAdminRole = Role::where('name', 'Super Admin')->first();

        //create an superadmin user
        $superAdminUser = User::create([
            'name' => "superadmin",
            'email' => 'superadmin@superadmin.com',
            'email_verified_at' =>  now(),
            'password' => Hash::make('password'),
            'is_active' => 1,
            'role' => 1,
            'is_approved' => 1,
            'created_by_admin' => 1
        ]);

        $superAdminRole = Role::where('name', 'superadmin')->first();
        $superAdminUser->assignRole($superAdminRole);
    }
}
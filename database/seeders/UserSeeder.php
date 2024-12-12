<?php

namespace Database\Seeders;

// use App\Models\User;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);
        $admin->assignRole('administrator');

        $manager = User::create([
            'name' => 'Project Manager',
            'email' => 'manager@example.com',
            'password' => bcrypt('password'),
        ]);
        $manager->assignRole('project manager');

        $member = User::create([
            'name' => 'Team Member',
            'email' => 'member@example.com',
            'password' => bcrypt('password'),
        ]);
        $member->assignRole('team member');
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    // database/seeders/DatabaseSeeder.php
    public function run()
    {
        User::create([
            'name' => 'Bengkel User',
            'email' => 'bengkel@example.com',
            'password' => bcrypt('password'),
            'usertype' => 'bengkel',
        ]);
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'usertype' => 'admin',
        ]);
        User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
            'usertype' => 'user',
        ]);
    }
}

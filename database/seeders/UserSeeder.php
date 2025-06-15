<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'usertype' => 'admin',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Regular User',
                'email' => 'user@example.com',
                'usertype' => 'user',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Bengkel Owner 1',
                'email' => 'bengkel1@example.com',
                'usertype' => 'bengkel',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Bengkel Owner 2',
                'email' => 'bengkel2@example.com',
                'usertype' => 'bengkel',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Bengkel Owner 3',
                'email' => 'bengkel3@example.com',
                'usertype' => 'bengkel',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Bengkel Owner 4',
                'email' => 'bengkel4@example.com',
                'usertype' => 'bengkel',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Bengkel Owner 5',
                'email' => 'bengkel5@example.com',
                'usertype' => 'bengkel',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Bengkel Owner 6',
                'email' => 'bengkel6@example.com',
                'usertype' => 'bengkel',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Bengkel Owner 7',
                'email' => 'bengkel7@example.com',
                'usertype' => 'bengkel',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Bengkel Owner 8',
                'email' => 'bengkel8@example.com',
                'usertype' => 'bengkel',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Bengkel Owner 9',
                'email' => 'bengkel9@example.com',
                'usertype' => 'bengkel',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Bengkel Owner 10',
                'email' => 'bengkel10@example.com',
                'usertype' => 'bengkel',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}

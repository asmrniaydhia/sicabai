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
    public function run()
    {
        $users = [
            // User type 'user' (ID 1-5)
            [
                'id' => 1,
                'name' => 'User 1',
                'email' => 'user1@example.com',
                'usertype' => 'user',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'name' => 'User 2',
                'email' => 'user2@example.com',
                'usertype' => 'user',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 3,
                'name' => 'User 3',
                'email' => 'user3@example.com',
                'usertype' => 'user',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 4,
                'name' => 'User 4',
                'email' => 'user4@example.com',
                'usertype' => 'user',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 5,
                'name' => 'User 5',
                'email' => 'user5@example.com',
                'usertype' => 'user',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            
            // User type 'admin' (ID 6-8)
            [
                'id' => 6,
                'name' => 'Admin 1',
                'email' => 'admin1@example.com',
                'usertype' => 'admin',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 7,
                'name' => 'Admin 2',
                'email' => 'admin2@example.com',
                'usertype' => 'admin',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 8,
                'name' => 'Admin 3',
                'email' => 'admin3@example.com',
                'usertype' => 'admin',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            
            // User type 'bengkel' (ID 9-18)
            [
                'id' => 9,
                'name' => 'Bengkel Owner 1',
                'email' => 'bengkel1@example.com',
                'usertype' => 'bengkel',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 10,
                'name' => 'Bengkel Owner 2',
                'email' => 'bengkel2@example.com',
                'usertype' => 'bengkel',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 11,
                'name' => 'Bengkel Owner 3',
                'email' => 'bengkel3@example.com',
                'usertype' => 'bengkel',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 12,
                'name' => 'Bengkel Owner 4',
                'email' => 'bengkel4@example.com',
                'usertype' => 'bengkel',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 13,
                'name' => 'Bengkel Owner 5',
                'email' => 'bengkel5@example.com',
                'usertype' => 'bengkel',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 14,
                'name' => 'Bengkel Owner 6',
                'email' => 'bengkel6@example.com',
                'usertype' => 'bengkel',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 15,
                'name' => 'Bengkel Owner 7',
                'email' => 'bengkel7@example.com',
                'usertype' => 'bengkel',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 16,
                'name' => 'Bengkel Owner 8',
                'email' => 'bengkel8@example.com',
                'usertype' => 'bengkel',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 17,
                'name' => 'Bengkel Owner 9',
                'email' => 'bengkel9@example.com',
                'usertype' => 'bengkel',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 18,
                'name' => 'Bengkel Owner 10',
                'email' => 'bengkel10@example.com',
                'usertype' => 'bengkel',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('users')->insert($users);
    }
}

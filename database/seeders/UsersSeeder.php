<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Mihir Chauhan',
                'email' => 'mihir@gmail.com',
                'password' => Hash::make('12345678'), 
            ],
            [
                'name' => 'User 0',
                'email' => 'user0@gmail.com',
                'password' => Hash::make('01234567'),
            ],
            [
                'name' => 'User 1',
                'email' => 'user1@gmail.com',
                'password' => Hash::make('user12345'),
            ],
            [
                'name' => 'User 2',
                'email' => 'user@gmail.com',
                'password' => Hash::make('user23456'),
            ],
            [
                'name' => 'User 3',
                'email' => 'user3@gmail.com',
                'password' => Hash::make('user34567'),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}

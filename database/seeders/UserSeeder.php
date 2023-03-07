<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'first_name' => "Abdelhak",
                'last_name' => "Lallouche",
                'position' => "Software Developer",
                'email' => 'abdlhaklalouche@gmail.com',
                'role' => 2,
                'password' => Hash::make('123456'),
            ], [
                'first_name' => "John",
                'last_name' => "Newton",
                'position' => "Recruiter",
                'email' => 'john.newton@nabinaholding.com',
                'role' => 2,
                'password' => Hash::make('123456'),
            ]
        ];
        
        DB::table("users")->insert($users);
    }
}

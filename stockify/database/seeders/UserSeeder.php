<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ["name" => "Admin1", 
            "email" => "admin1@gmail.com", 
            "password" => Hash::make("password"), 
            "role" => "admin"],
            ["name" => "Admin2", 
            "email" => "admin2@gmail.com", 
            "password" => Hash::make("password"), 
            "role" => "admin"],
            ["name" => "Manager1", 
            "email" => "manager1@gmail.com", 
            "password" => Hash::make("password"), 
            "role" => "manager"],
            ["name" => "Manager2", 
            "email" => "manager2@gmail.com", 
            "password" => Hash::make("password"), 
            "role" => "manager"],
            ["name" => "Staff1", 
            "email" => "staff1@gmail.com", 
            "password" => Hash::make("password"), 
            "role" => "staff"],
            ["name" => "Staff2", 
            "email" => "staff2@gmail.com", 
            "password" => Hash::make("password"), 
            "role" => "staff"],
            ["name" => "Staff3", 
            "email" => "staff3@gmail.com", 
            "password" => Hash::make("password"), 
            "role" => "staff"],
            ["name" => "Staff4", 
            "email" => "staff4@gmail.com", 
            "password" => Hash::make("password"), 
            "role" => "staff"],
            ["name" => "Staff5", 
            "email" => "staff5@gmail.com", 
            "password" => Hash::make("password"), 
            "role" => "staff"],
            ["name" => "Staff6", 
            "email" => "staff6@gmail.com", 
            "password" => Hash::make("password"), 
            "role" => "staff"],
        ];


        foreach ($users as $user) {
            User::create($user);
        }
    }
}

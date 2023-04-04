<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'first_name' => 'احسان',
                'last_name' => 'قاجار',
                'mobile' => '09362014771',
                'username' => 'ehsanghajar',
                'email' => 'ghajar@gmail.com',
                'password' => '123456789'
            ],
            [
                'first_name' => 'صادق',
                'last_name' => 'سوسهابی',
                'mobile' => '09129439150',
                'username' => 'sadeghsou',
                'email' => 'sou@gmail.com',
                'password' => '123456789'
            ]
        ]);
    }
}

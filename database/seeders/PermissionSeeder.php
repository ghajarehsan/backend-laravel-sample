<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('permissions')->insert([
            [
                'name' => 'deleteUser',
                'persian_name' => 'حذف کاربر',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'addUser',
                'persian_name' => 'افزودن کاربر',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

    }
}

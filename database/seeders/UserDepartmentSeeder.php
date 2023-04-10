<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserDepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_departments')->insert([
            [
                'name' => 'وب سایت',
                'parent_id' => null,
                'creator_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'توسعه سمت فرانت',
                'parent_id' => null,
                'creator_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}

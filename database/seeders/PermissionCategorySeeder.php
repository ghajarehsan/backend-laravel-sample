<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permission_categories')->insert([
            [
                'name' => 'دسته بندی سطح دسترسی های سیستم',
                'creator_id' => User::first()->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'دسته بندی نقش های سیستم',
                'creator_id' => user::first()->id,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}

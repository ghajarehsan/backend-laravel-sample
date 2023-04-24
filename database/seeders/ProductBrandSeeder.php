<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('product_brands')->insert([
            [
                'title' => 'ال جی',
                'title_en' => 'LG',
                'images' => null,
                'creator_id' => User::first()->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'پنتوس',
                'title_en' => 'PANTUS',
                'image' => null,
                'creator_id' => User::first()->id,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

    }
}

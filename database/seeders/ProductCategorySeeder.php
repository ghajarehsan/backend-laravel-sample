<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('product_categories')->insert([
            [
                'order' => 1,
                'title' => 'مانیتور',
                'title_en' => 'Monitor',
                'slug' => 'مانیتور',
                'images' => 'a:3:{i:0;s:70:"storage/Controllers/2023/04/17/image/1532847371/1-08-52-15,orginal.png";i:1;s:70:"storage/Controllers/2023/04/17/image/1532847371/1-08-52-15,100x200.png";i:2;s:70:"storage/Controllers/2023/04/17/image/1532847371/1-08-52-15,200x300.png";}',
                'parent_id' => 0,
                'creator_id' => User::first()->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'order' => 2,
                'title' => 'مانیتور هتلی',
                'title_en' => 'Hotel',
                'slug' => 'مانیتور-هتلی',
                'images' => 'a:3:{i:0;s:70:"storage/Controllers/2023/04/17/image/1532847371/1-08-52-15,orginal.png";i:1;s:70:"storage/Controllers/2023/04/17/image/1532847371/1-08-52-15,100x200.png";i:2;s:70:"storage/Controllers/2023/04/17/image/1532847371/1-08-52-15,200x300.png";}',
                'parent_id' => 1,
                'creator_id' => User::first()->id,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

    }
}

<?php

namespace Database\Seeders;

use App\Models\ProductCategoryFilter;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCategoryFilterOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('product_category_filter_options')->insert([
            [
                'name' => '2 مگا پیکسل',
                'category_filter_id' => ProductCategoryFilter::first()->id,
                'creator_id' => User::first()->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => '5 مگا پیکسل',
                'category_filter_id' => ProductCategoryFilter::first()->id,
                'creator_id' => User::first()->id,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

    }
}

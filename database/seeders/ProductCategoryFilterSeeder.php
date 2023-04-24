<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCategoryFilterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('product_category_filters')->insert([
            [
                'type' => 1,
                'name' => 'رزولوشن',
                'product_category_id' => ProductCategory::first()->id,
                'creator_id' => User::first()->id,
                'created_at'=>now(),
                'updated_at'=>now()
            ]
        ]);

    }
}

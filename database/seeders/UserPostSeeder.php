<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('user_posts')->insert([
            [
                'name' => 'مدیر',
                'value' => 1,
                'creator_id' => User::first()->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'رییس',
                'value' => 1,
                'creator_id' => User::first()->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'کارشناس ارشد',
                'value' => 1,
                'creator_id' => User::first()->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'کارشناس',
                'value' => 1,
                'creator_id' => User::first()->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

    }
}

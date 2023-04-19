<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            UserSeeder::class,
            PermissionSeeder::class,
            RoleSeeder::class,
            UserPostSeeder::class,
            UserDepartmentSeeder::class,
            PermissionCategorySeeder::class,
            GivePermissionToUserSeeder::class,
            ProductBrandSeeder::class,
            ProductCategorySeeder::class,
            ProductCategoryFilterSeeder::class,
            ProductCategoryFilterOptionSeeder::class
        ]);

    }
}

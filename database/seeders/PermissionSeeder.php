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
                'name' => 'givePermissionToUser',
                'persian_name' => 'اساین کردن سطح دسترسی به کاربر',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'detachPermissionTo',
                'persian_name' => 'گرفتن سطح دسترسی از کاربر',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'addPermissionTo',
                'persian_name' => 'افزودن سطح دسترسی به کاربر',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'giveRoleToUser',
                'persian_name' => 'اساین کردن نقش به کاربر',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'detachRoleTo',
                'persian_name' => 'گرفتن نقش از کاربر',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'addRoleTo',
                'persian_name' => 'افزودن نقش به کاربر',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'givePermissionToRole',
                'persian_name' => 'اساین کردن سطح دسترسی به نقش',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'detachPermissionToRole',
                'persian_name' => 'گرفتن سطح دسترسی از نقش',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'addPermissionToRole',
                'persian_name' => 'افزودن سطح دسترسی به نقش',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'newPermissionCategory',
                'persian_name' => 'تعریف دسته بندی سطح دسترسی',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'editPermissionCategory',
                'persian_name' => 'ویرایش دسته بندی سطح دسترسی',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'getAllCategoryPermission',
                'persian_name' => 'دسترسی به کل دسته بندی های سطح دسترسی',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'newUserPost',
                'persian_name' => 'تعریف سمت کاربران',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'getAllPost',
                'persian_name' => 'دسترسی به کل سمت های سیستم',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'newUserDepartment',
                'persian_name' => 'تعریف دپارتمان جدید',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'getAllDepartment',
                'persian_name' => 'دسترسی به کل دپارتمان های سازمان',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

    }
}

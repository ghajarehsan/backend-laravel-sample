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
            [
                'name' => 'newProductBrand',
                'persian_name' => 'اضافه کردن برند های محصولات وب سایت داتیس',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'editProductBrand',
                'persian_name' => 'ویرایش برند های محصولات وب سایت داتیس',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'deleteProductBrand',
                'persian_name' => 'حذف برند های محصولات وب سایت داتیس',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'getAllProductBrand',
                'persian_name' => 'دسترسی به تمام برند های محصولات وب سایت داتیس',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'getAllProductBrand',
                'persian_name' => 'دسترسی به تمام برند های محصولات وب سایت داتیس',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'newProductCategory',
                'persian_name' => 'اضافه کردن کردن دسته بندی محصولات وب شاست داتیس',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'newProductCategory',
                'persian_name' => 'اضافه کردن کردن دسته بندی محصولات وب سایت داتیس',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'editProductCategory',
                'persian_name' => 'ویرایش کردن دسته بندی محصولات وب سایت داتیس',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'deleteProductCategory',
                'persian_name' => 'حذف کردن دسته بندی محصولات وب سایت داتیس',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'getAllProductCategory',
                'persian_name' => 'دسترسی به تمام دسته بندی های محصولات',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'newProductCategoryFilter',
                'persian_name' => 'اضافه کردن فیلتر دسته بندی محصولات',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'editProductCategoryFilter',
                'persian_name' => 'ویرایش فیلتر دسته بندی محصولات',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'deleteProductCategoryFilter',
                'persian_name' => 'حذف فیلتر دسته بندی محصولات',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'newProductCategoryFilterOption',
                'persian_name' => 'اضافه کردن آپشن فیلتر دسته بندی محصولات',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'editProductCategoryFilterOption',
                'persian_name' => 'ویرایش آپشن فیلتر دسته بندی محصولات',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'deleteProductCategoryFilterOption',
                'persian_name' => 'حذف آپشن فیلتر دسته بندی محصولات',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

    }
}

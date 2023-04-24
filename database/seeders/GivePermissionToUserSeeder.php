<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GivePermissionToUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $allPermissions = Permission::all();

        User::where('mobile', '09362014771')->first()->permissions()->sync($allPermissions);

        User::where('mobile', '09351600320')->first()->permissions()->sync($allPermissions);

        User::where('mobile', '09129439150')->first()->permissions()->sync($allPermissions);

    }
}

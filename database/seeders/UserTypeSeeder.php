<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userTypes = [
            ['user_type_name' => 'admin'],
            ['user_type_name' => 'department'],
            ['user_type_name' => 'user'],
        ];

        DB::table('user_types')->insert($userTypes);
    }
}

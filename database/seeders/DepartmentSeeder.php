<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            ['department_name' => 'Social Media'],
            ['department_name' => 'Ministry Block'],
            ['department_name' => 'Assembly Office'],
            ['department_name' => 'Constituency'],
            ['department_name' => 'Direct from Minister'],
            ['department_name' => 'MoE Hotline Number'],
        ];

        DB::table('departments')->insert($departments);
    }
}

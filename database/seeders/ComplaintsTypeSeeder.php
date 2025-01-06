<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComplaintsTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $complaintsTypes = [
            ['complaint_type' => 'Missing Facilities'],
            ['complaint_type' => 'Misconduct'],
            ['complaint_type' => 'Student Teacher Ratio'],
            ['complaint_type' => 'School Infrastructure'],
            ['complaint_type' => 'Transfer'],
            ['complaint_type' => 'Books Not Received'],
            ['complaint_type' => 'Others'],
        ];

        DB::table('complaints_types')->insert($complaintsTypes);
    }
}

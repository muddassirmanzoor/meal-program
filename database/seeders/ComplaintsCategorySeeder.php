<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComplaintsCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $complaintsCategories = [
            ['complaint_category' => 'Social'],
            ['complaint_category' => 'Individual'],
            ['complaint_category' => 'Complaint Related to School']
        ];

        DB::table('complaints_categories')->insert($complaintsCategories);
    }
}

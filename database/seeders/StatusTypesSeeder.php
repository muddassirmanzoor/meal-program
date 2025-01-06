<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statusTypes = [
            ['status_name' => 'Received'],
            ['status_name' => 'Assigned'],
            ['status_name' => 'Processing'],
            ['status_name' => 'Resolved'],
            ['status_name' => 'Declined'],
            ['status_name' => 'Sent Back'],
        ];

        DB::table('status_types')->insert($statusTypes);
    }
}

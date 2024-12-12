<?php

namespace Database\Seeders;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('projects')->insert([
            [
                'name' => 'Project Alpha',
                'start_date' => Carbon::create('2024', '01', '01'),
                'end_date' => Carbon::create('2024', '03', '31'),
                'description' => 'A brief description of Project Alpha.',
                'status' => 'COMPLETED',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Project Beta',
                'start_date' => Carbon::create('2024', '02', '01'),
                'end_date' => Carbon::create('2024', '05', '15'),
                'description' => 'A brief description of Project Beta.',
                'status' => 'STARTED',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Project Gamma',
                'start_date' => Carbon::create('2024', '03', '01'),
                'end_date' => Carbon::create('2024', '06', '30'),
                'description' => 'A brief description of Project Gamma.',
                'status' => 'ONHOLD',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

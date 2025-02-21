<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

        $data = [];
        $now = Carbon::now();

        foreach ($days as $day) {
            $data[] = [
                'practice_schedule' => $day,
                'created_at' => $now,
                'updated_at' => $now
            ];
        }

        DB::table('schedules')->insert($data);
    }
}

<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class MedicationsTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $medications_type = [
            ['medication_type' => 'Generic', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['medication_type' => 'OTC (Over The Counter)', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['medication_type' => 'Herbal', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['medication_type' => 'Prescription', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['medication_type' => 'Supplement', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['medication_type' => 'Homeopathic', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['medication_type' => 'Antibiotic', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['medication_type' => 'Antiviral', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['medication_type' => 'Painkiller', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['medication_type' => 'Antifungal', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['medication_type' => 'Antidepressant', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['medication_type' => 'Antihistamine', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['medication_type' => 'Anti-inflammatory', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['medication_type' => 'Hormonal', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['medication_type' => 'Sedative', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['medication_type' => 'Stimulant', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        DB::table('medications_type')->insert($medications_type);
    }
}

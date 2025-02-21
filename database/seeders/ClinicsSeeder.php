<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClinicsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clinics = [
            'Cardiology', 'Neurology', 'Orthopedic', 'Pediatrics', 'Dermatology',
            'Ophthalmology', 'Radiology', 'Gastroenterology', 'Oncology', 'Endocrinology',
            'Pulmonology', 'Nephrology', 'Rheumatology', 'Psychiatry', 'Urology',
            'Obstetrics and Gynecology', 'Hematology', 'Allergy and Immunology', 
            'Anesthesiology', 'General Surgery', 'Plastic Surgery', 'Otolaryngology (ENT)',
            'Infectious Disease', 'Geriatrics', 'Sports Medicine', 'Emergency Medicine',
            'Pain Management', 'Sleep Medicine', 'Nuclear Medicine', 'Internal Medicine',
            'Family Medicine', 'Occupational Medicine', 'Palliative Care', 'Clinical Pathology',
            'Toxicology', 'Forensic Medicine', 'Rehabilitation Medicine', 'Genetics',
            'Hyperbaric Medicine', 'Preventive Medicine', 'Holistic Medicine', 'Telemedicine',
            'Military Medicine', 'Aerospace Medicine', 'Maritime Medicine', 'Homeopathy',
            'Acupuncture', 'Traditional Medicine', 'Ayurveda', 'Functional Medicine'
        ];

        $data = [];
        $now = Carbon::now();

        foreach ($clinics as $clinic) {
            $data[] = [
                'name' => $clinic,
                'created_at' => $now,
                'updated_at' => $now
            ];
        }

        DB::table('clinics')->insert($data);
    }
}

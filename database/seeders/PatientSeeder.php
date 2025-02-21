<?php

namespace Database\Seeders;

use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;


class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil tanggal hari ini
        $date = Carbon::now()->format('Ymd');

        // Hitung jumlah pasien yang terdaftar hari ini
        $countToday = Patient::whereDate('created_at', Carbon::now()->toDateString())->count() + 1;

        for ($i = 0; $i < 50; $i++) { // Seed 50 pasien
            // Buat kode pasien unik
            $patient_code = 'PAT' . $date . str_pad($countToday, 4, '0', STR_PAD_LEFT);
            $countToday++;

            // Simpan data pasien php artisan db:seed --class=PatientsTableSeeder

            Patient::create([
                'patient_code' => $patient_code,
                'name' => fake()->name(),
                'address' => fake()->address(),
                'birth_date' => fake()->date(),
                'gender' => fake()->randomElement(['male', 'female']),
                'phone' => fake()->phoneNumber(),
                'religion' => fake()->randomElement(['islam', 'kristen', 'hindu','budha','koghucu']),
                'education' => fake()->randomElement(['sd', 'smp','sma', 'diploma', 'sarjana', 'magister','doktor']),
                'occupation' => fake()->jobTitle(),
                'national_id' => fake()->randomNumber(8, true),
                'doctor_id' => rand(1, 10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

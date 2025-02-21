<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $doctors = [
            ['name' => 'Ratna Sari Aida', 'clinic' => 'Cardiology', 'phone' => '081234567890'],
            ['name' => 'Jane Smith', 'clinic' => 'Neurology', 'phone' => '081298765432'],
            ['name' => 'Alice Brown', 'clinic' => 'Orthopedics', 'phone' => '081211223344'],
            ['name' => 'Bob White', 'clinic' => 'Pediatrics', 'phone' => '081255566778'],
            ['name' => 'Charlie Black', 'clinic' => 'Dermatology', 'phone' => '081233344455'],
        ];

        // Ambil semua klinik dari database dan buat array name => id
        $clinics = DB::table('clinics')->pluck('id', 'name')->toArray();
        $schedules = DB::table('schedules')->pluck('id')->toArray();
        $now = Carbon::now();

        $data = [];
        foreach ($doctors as $doctor) {
            if (!isset($clinics[$doctor['clinic']])) {
                dump("❌ Klinik '{$doctor['clinic']}' tidak ditemukan di database!");
                continue; // Skip kalau klinik gak ada
            }

            $data[] = [
                'name' => $doctor['name'],
                'address' => 'Jl. Contoh No. ' . rand(1, 100),
                'clinic_id' => $clinics[$doctor['clinic']], // Pastikan clinic_id valid
                'phone' => $doctor['phone'],
                'schedule_id' => $schedules ? $schedules[array_rand($schedules)] : null, // Pastikan ada schedule
                'created_at' => $now,
                'updated_at' => $now
            ];
        }

        if (!empty($data)) {
            DB::table('doctors')->insert($data);
            dump("✅ Data dokter berhasil di-seed.");
        } else {
            dump("⚠️ Tidak ada data dokter yang bisa di-insert.");
        }
    }
}

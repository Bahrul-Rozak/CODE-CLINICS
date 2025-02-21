<?php

namespace Database\Seeders;

use App\Models\Medication;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MedicationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil tanggal hari ini
        $date = Carbon::now()->format('Ymd');

        // Mapping antara nama obat dan jenisnya
        $medications = [
            ['name' => 'Paracetamol', 'type' => 'Generic', 'dosage' => '500mg', 'price' => 5000, 'stock' => 100],
            ['name' => 'Ibuprofen', 'type' => 'OTC (Over The Counter)', 'dosage' => '200mg', 'price' => 10000, 'stock' => 50],
            ['name' => 'Amoxicillin', 'type' => 'Prescription', 'dosage' => '500mg', 'price' => 20000, 'stock' => 75],
            ['name' => 'Vitamin C', 'type' => 'Supplement', 'dosage' => '1000mg', 'price' => 15000, 'stock' => 120],
            ['name' => 'Echinacea', 'type' => 'Herbal', 'dosage' => '500mg', 'price' => 12000, 'stock' => 60],
            ['name' => 'Cetirizine', 'type' => 'Antihistamine', 'dosage' => '10mg', 'price' => 8000, 'stock' => 90],
            ['name' => 'Fluconazole', 'type' => 'Antifungal', 'dosage' => '150mg', 'price' => 25000, 'stock' => 30],
            ['name' => 'Sertraline', 'type' => 'Antidepressant', 'dosage' => '50mg', 'price' => 30000, 'stock' => 40],
        ];

        foreach ($medications as $med) {
            // Hitung jumlah medication yang terdaftar hari ini
            $countToday = Medication::whereDate('created_at', Carbon::today())->count() + 1;

            // Buat kode obat sesuai format
            $medication_code = 'MED' . $date . str_pad($countToday, 4, '0', STR_PAD_LEFT);

            // Cari type_id berdasarkan nama type obat
            $type = DB::table('medications_type')->where('medication_type', $med['type'])->first();

            // Simpan ke database
            Medication::create([
                'medication_code' => $medication_code,
                'type_id' => $type ? $type->id : null,
                'name' => $med['name'],
                'dosage' => $med['dosage'],
                'price' => $med['price'],
                'stock' => $med['stock'], // Tambahin stock
                'expiration_date' => Carbon::now()->addYear(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}

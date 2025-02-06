<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id();
            $table->integer('patient_id')->references('id')->on('patients');
            $table->string('queue_number');
            $table->date('examination_date')->nullable();
            $table->string('service');
            $table->string('complaint');
            $table->integer('doctor_id')->references('id')->on('doctors');
            $table->string('diagnosis')->nullable();
            $table->integer('medication_id')->references('id')->on('medications')->nullable();
            $table->string('medication_quantity')->nullable();
            $table->string('notes')->nullable();
            $table->string('treatment')->nullable();
            $table->string('new_entry')->nullable();
            $table->string('blood_type')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('waist')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_records');
    }
};

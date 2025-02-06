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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('patient_code')->nullable();
            $table->string('name');
            $table->string('address')->nullable();
            $table->date('birth_date');
            $table->string('gender');
            $table->string('phone');
            $table->string('religion');
            $table->string('education')->nullable();
            $table->string('occupation')->nullable();
            $table->string('national_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};

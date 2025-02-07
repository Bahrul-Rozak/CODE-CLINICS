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
        Schema::create('medications', function (Blueprint $table) {
            $table->id();
            $table->string('medication_code')->nullable();
            $table->integer('stock')->nullable();
            $table->integer('type_id')->references('id')->on('medication_types')->nullable()->constrained();
            $table->string('name');
            $table->string('dosage')->nullable();
            $table->string('price')->nullable();
            $table->date('expiration_date')->nullable();
            $table->string('photo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medications');
    }
};

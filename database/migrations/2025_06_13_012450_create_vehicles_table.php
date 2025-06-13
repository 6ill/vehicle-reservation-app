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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('license_plate')->unique();
            $table->enum('type', ['angkutan_orang', 'angkutan_barang']);
            $table->enum('ownership', ['company', 'rental']);
            $table->decimal('fuel_consumption', 8, 2)->nullable()->comment('Liter per KM');
            $table->date('service_schedule')->nullable();
            $table->enum('status', ['available', 'in_use', 'maintenance'])->default('available');
            $table->foreignId('base_location_id')->constrained('locations');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};

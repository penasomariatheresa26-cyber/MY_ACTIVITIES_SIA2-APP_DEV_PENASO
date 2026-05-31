<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('plants', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Plant name
            $table->string('type'); // Type of plant (Flower, Herb, Succulent)
            $table->integer('water_frequency'); // Days between watering
            $table->string('sunlight'); // e.g., Full sun, Partial shade
            $table->string('image')->nullable(); // optional plant image
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('plants');
    }
};
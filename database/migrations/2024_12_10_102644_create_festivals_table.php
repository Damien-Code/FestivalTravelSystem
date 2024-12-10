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
        Schema::create('info_festivals', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('image');
            $table->timestamps();
        });

        Schema::create('festivals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('info_festival_id')->constrained('info_festivals');
            $table->foreignId('location_id')->constrained('locations');
            $table->dateTime('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('info_festivals');
        Schema::dropIfExists('festivals');
    }
};

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
        Schema::create('festival_info', function (Blueprint $table) {
            $table->id();
            $table->string('title', 45);
            $table->text('description');
            $table->binary('image')->nullable();
            $table->timestamps();
        });

        Schema::create('festivals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('info_festival_id')->constrained('festival_info');
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
        Schema::dropIfExists('festival_info');
        Schema::dropIfExists('festivals');
    }
};

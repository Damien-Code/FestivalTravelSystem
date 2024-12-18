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
        Schema::create('bus_info', function (Blueprint $table) {
            $table->id();
            $table->string('license_plate', 45);
            $table->timestamps();
        });

        Schema::create('bus_in_uses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bus_id')->constrained('bus_info');
            $table->foreignId('route_id')->constrained('routes');
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bus_info');
        Schema::dropIfExists('bus_in_use');
    }
};

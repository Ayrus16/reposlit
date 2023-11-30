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
        Schema::create('athlete_club_histories', function (Blueprint $table) {
            $table->id()->primaryKey();
            $table->foreignId('athlete_id');
            $table->foreignId('club_id');
            $table->date('date_started');
            $table->date('date_ended')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('athlete_club_histories');
    }
};

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
        Schema::create('athletes', function (Blueprint $table) {
            $table->id()->primaryKey();
            $table->timestamps();
            $table->string('name');
            $table->integer('gender')->nullable();
            $table->date('date_of_birth');
            $table->integer('body_height');
            $table->integer('body_weight');
            $table->integer('dribling');
            $table->integer('passing');
            $table->integer('shooting');
            $table->integer('endurance');
            $table->string('recommendation_position')->nullable();
            $table->integer('photo_path')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('athletes');
    }
};

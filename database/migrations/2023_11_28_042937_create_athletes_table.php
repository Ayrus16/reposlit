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
            $table->date('date_of_birth');
            $table->integer('body_height')->nullable();
            $table->integer('body_weight')->nullable();
            $table->integer('photo_path')->nullable();
            $table->integer('dribling')->nullable();
            $table->integer('passing')->nullable();
            $table->integer('shooting')->nullable();
            $table->integer('endurance')->nullable();
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

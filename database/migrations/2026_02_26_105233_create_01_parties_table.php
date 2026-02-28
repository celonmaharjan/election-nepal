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
        Schema::create('parties', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_nepali');
            $table->string('abbreviation');
            $table->string('symbol_image')->nullable();
            $table->integer('founded_year')->nullable();
            $table->string('ideology')->nullable();
            $table->string('website')->nullable();
            $table->text('description')->nullable();
            $table->string('color_hex')->nullable();
            $table->string('logo_image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parties');
    }
};

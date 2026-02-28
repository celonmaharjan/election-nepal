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
        Schema::create('manifestos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('party_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('summary')->nullable();
            $table->longText('full_text')->nullable();
            $table->date('published_date')->nullable();
            $table->string('pdf_url')->nullable();
            $table->json('key_points')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manifestos');
    }
};

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
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_nepali')->nullable();
            $table->string('photo')->nullable();
            $table->foreignId('party_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('constituency_id')->constrained()->onDelete('cascade');
            $table->integer('age')->nullable();
            $table->string('gender')->nullable();
            $table->string('education_level')->nullable();
            $table->text('education_details')->nullable();
            $table->string('occupation')->nullable();
            $table->string('address')->nullable();
            $table->integer('criminal_cases')->default(0);
            $table->json('assets_declared')->nullable();
            $table->text('manifesto_summary')->nullable();
            $table->longText('detailed_manifesto')->nullable();
            $table->json('social_links')->nullable();
            $table->string('website')->nullable();
            $table->json('previous_election_result')->nullable();
            $table->boolean('is_incumbent')->default(false);
            $table->string('slug')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
};

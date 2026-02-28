<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_aliases', function (Blueprint $table) {
            $table->id();
            $table->string('alias')->index(); // The messy name (e.g., 'एम.ए.')
            $table->string('standard_name'); // The clean name (e.g., 'Master\'s Degree')
            $table->string('category');      // To distinguish 'education' from 'party'
            $table->timestamps();
            
            $table->unique(['alias', 'category']); // Prevent duplicate rules
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_aliases');
    }
};

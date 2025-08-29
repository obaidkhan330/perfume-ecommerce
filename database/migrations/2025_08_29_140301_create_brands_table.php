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
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Brand name (Dior, Chanel, Gucci etc.)
            $table->string('slug')->unique(); // For SEO friendly URLs
            $table->string('logo')->nullable(); // Brand logo image path
            $table->text('description')->nullable(); // About the brand
            $table->string('origin_country')->nullable(); // e.g., France, Italy, UK
            $table->string('website')->nullable(); // Official brand website
            $table->boolean('status')->default(true); // Active / Inactive
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brands');
    }
};

<?php
// Migration: Addresses table with phone, area, city selection
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('city_id')->constrained('cities');
            $table->string('area');
            $table->string('postal_code');
            $table->string('full_address');
            $table->string('phone');
            $table->boolean('is_default')->default(false);
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('addresses');
    }
};

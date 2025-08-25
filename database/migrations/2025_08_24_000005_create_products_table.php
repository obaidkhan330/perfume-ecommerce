<?php
// Migration: Products table with all required fields
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('brand_id')->constrained('brands');
            $table->foreignId('category_id')->constrained('categories');
            $table->integer('ml');
            $table->integer('stock');
            $table->decimal('original_price', 10, 2);
            $table->decimal('sale_price', 10, 2);
            $table->boolean('free_delivery')->default(false);
            $table->boolean('active')->default(true);
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('products');
    }
};

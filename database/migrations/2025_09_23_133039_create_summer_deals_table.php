<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::create('summer_deals', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('product_id');
        $table->decimal('real_price', 10, 2);
        $table->decimal('discount_price', 10, 2);
        $table->boolean('is_gift_pack')->default(false);
        $table->timestamps();

        $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
    });
}

    public function down(): void
    {
        Schema::dropIfExists('summer_deals');
    }
};

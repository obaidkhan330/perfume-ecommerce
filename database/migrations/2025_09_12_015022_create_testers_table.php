<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('testers', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Tester ka naam
            $table->string('slug')->unique();
            $table->string('image')->nullable(); // Tester image
            $table->text('description')->nullable();
            $table->unsignedBigInteger('brand_id')->nullable(); // perfume brand ka relation
            $table->timestamps();

            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('set null');
        });

        // tester variations (1, 3, 5 testers)
        Schema::create('tester_variations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tester_id');
            $table->string('pack_size'); // example: "1 Tester", "3 Testers", "5 Testers"
            $table->decimal('price', 10, 2);
            $table->decimal('discount_price', 10, 2)->nullable();
            $table->timestamps();

            $table->foreign('tester_id')->references('id')->on('testers')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tester_variations');
        Schema::dropIfExists('testers');
    }
};


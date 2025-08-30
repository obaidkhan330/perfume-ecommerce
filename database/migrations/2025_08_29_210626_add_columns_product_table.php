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
        //
        Schema::table('products', function (Blueprint $table) {
            $table->string('notes_top')->nullable();          // Top notes
            $table->string('notes_top_image')->nullable();          // Top notes
            $table->string('notes_middle')->nullable();       // Middle notes
            $table->string('notes_middle_image')->nullable();      // Middle notes
            $table->string('notes_base')->nullable();
            $table->string('notes_base_image')->nullable();


            $table->json('gallery')->nullable();              // Extra images (JSON)

            // SEO fields
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();

            // Base notes

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'notes_top',
                'notes_middle',
                'notes_base',
                'gallery',
                'meta_title',
                'meta_keywords',
                'meta_description'
            ]);
        });
    }
};

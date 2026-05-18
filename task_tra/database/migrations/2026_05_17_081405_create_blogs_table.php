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
    Schema::create('blogs', function (Blueprint $table) {

        $table->id();

        // Titles
        $table->string('title_ar');
        $table->string('title_en');

        // Descriptions
        $table->text('description_ar');
        $table->text('description_en');

        // Main Image
        $table->string('main_image');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};

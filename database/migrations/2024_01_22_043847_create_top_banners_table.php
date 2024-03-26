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
        Schema::create('top_banners', function (Blueprint $table) {
            $table->id();
            $table->string('top_banner_title')->nullable();
            $table->string('top_banner_tagline')->nullable();
            $table->string('top_banner_img');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('top_banners');
    }
};

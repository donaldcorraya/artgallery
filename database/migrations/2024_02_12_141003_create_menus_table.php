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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('url')->nullable();
            $table->integer('parent_id')->default(0);
            $table->string('sort_order')->default(0);
            // $table->integer('parent_id')->nullable();
            // $table->string('sort_order')->nullable();
            $table->string('status')->default(1)->comment("1=>ENABLE; 2=>DISABLE");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};

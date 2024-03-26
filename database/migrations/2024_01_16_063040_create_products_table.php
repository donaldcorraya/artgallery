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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');           
            $table->string('size');
            $table->double('regular_price', 11, 2);
            $table->double('selling_price', 11,2);
            $table->integer('stock_amount')->default(0);
            $table->longText('short_description')->nullable();
            $table->longText('long_description')->nullable();            
            $table->string('weight')->nullable();            
            $table->string('slug')->unique();
            $table->string('product_code')->unique();     
            $table->string('product_materials'); 
            $table->integer('architect_id');
            $table->integer('category_id');
            $table->tinyInteger('status')->default(1);
            $table->text('image')->nullable();
            $table->text('otherImage')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

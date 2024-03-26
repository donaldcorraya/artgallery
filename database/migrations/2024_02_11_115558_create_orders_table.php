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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->string('phone');
            $table->string('email');
            $table->string('order_total');
            $table->integer('tax_total');
            $table->integer('shipping_total');
            $table->string('order_date');
            $table->string('order_timestamp');
            $table->string('order_status')->default('0');
            $table->string('delivery_address');
            $table->integer('courier_id')->nullable();
            $table->string('delivery_status')->default('0');
            $table->string('payment_method');
            $table->string('payment_amount')->default(0);
            $table->text('payment_date')->nullable();
            $table->integer('delivery_date')->nullable();
            $table->text('payment_timestamp')->nullable();
            $table->string('payment_status')->default('0');
            $table->string('currency')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('coupon')->nullable();
            $table->longText('product_arr');
            $table->text('billing');
            $table->text('shipping');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

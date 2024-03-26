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
        Schema::create('application_settings', function (Blueprint $table) {
            $table->id();
            $table->string('business_name')->nullable();
            $table->string('business_address')->nullable();
            $table->string('business_number')->nullable();
            $table->string('business_email')->nullable();
            $table->string('time_zone')->nullable();
            $table->string('currency')->nullable();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();

            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_image')->nullable();
            
            $table->string('mail_host')->nullable();
            $table->string('mail_port')->nullable();
            $table->string('mail_username')->nullable();
            $table->string('mail_password')->nullable();
            $table->string('mail_from_name')->nullable();
            $table->string('mail_from_address')->nullable();
            $table->string('mail_encryption')->nullable();
            $table->string('mail_status')->nullable();
           
            $table->string('stripe_payment')->nullable();
            $table->text('stripe_key')->nullable();
            $table->text('stripe_secret')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application_settings');
    }
};
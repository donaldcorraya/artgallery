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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('firstName');
            $table->string('lastName');
            $table->string('image')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->unique();
            $table->text('date_of_birth')->nullable();
            $table->string('gender')->nullable();            
            $table->string('street_address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('post')->nullable();
            $table->string('country')->nullable();
            $table->string('ssn')->nullable();
            $table->string('company')->nullable();
            $table->string('website')->nullable();
            $table->string('facebook')->nullable();
            $table->string('linkedIn')->nullable();
            $table->string('twitter')->nullable();
            $table->string('youtube')->nullable();
            $table->string('instagram')->nullable();
            $table->boolean('marital_status')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
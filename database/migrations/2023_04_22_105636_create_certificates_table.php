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
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('type');
            $table->string('unique_code');
            $table->string('hash');
            $table->boolean('isActive')->default(1)->comment('0 - Inactive , 1 - Active');
            $table->integer('link_click_count')->default(0)->comment('The number of times link has been clicked.');
            $table->integer('isEmailSent')->default(0)->comment('Email has been sent.');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};

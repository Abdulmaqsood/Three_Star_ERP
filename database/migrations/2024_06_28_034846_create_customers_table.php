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
            $table->string('quickbook_id')->nullable();
            $table->string('title')->nullable();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('suffix')->nullable();
            $table->string('company')->nullable();
            $table->string('display_name');
            $table->string('phone_number');
            $table->string('mobile_number')->nullable();
            $table->string('fax')->nullable();
            $table->string('other')->nullable();
            $table->string('website')->nullable();
            $table->string('cheque_print_name')->nullable();
            $table->string('terms')->nullable();
            $table->string('business_number')->nullable();
            $table->unsignedBigInteger('payment_method_id');
            $table->foreign('payment_method_id')->references('id')->on('payment_methods')->onDelete('cascade')->onUpdate('cascade');
            $table->string('image')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            // $table->string('password');
            $table->rememberToken();
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

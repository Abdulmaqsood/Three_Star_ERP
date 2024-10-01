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
        Schema::create('customer_products', function (Blueprint $table) {
            $table->id();
            $table->decimal('assign_price', 8, 2);
            $table->string('profit');
            $table->integer('quantity')->nullable();
            $table->unsignedBigInteger('product_id'); // Store the product ID without a foreign key
            $table->unsignedBigInteger('customer_id'); // Store the customer ID without a foreign key
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_products');
    }
};

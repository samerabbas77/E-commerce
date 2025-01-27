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
            $table->integer('total_price');
            $table->integer('discount')->comment('Carbon fingerprint discount');
            $table->integer('final_price');
            $table->enum('status', ['pending', 'paid', 'shipped', 'delivered', 'canceled']);
            $table->string('order_number')->unique();
            $table->enum('payment_status', ['Pending', 'Completed', 'Failed', 'Refunded', 'Partially_Refunded']);
            $table->enum('payment_method', ['Credit Card', 'PayPal', 'Cash','Strip']);
            $table->string('transaction_id')->nullable();
            $table->string('postal_code');
            $table->foreignId('zone_id')->constrained('zones')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
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

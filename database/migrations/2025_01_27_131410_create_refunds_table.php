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
        Schema::create('refunds', function (Blueprint $table) {
            $table->id();
            $table->text('reason');
            $table->integer('refund_amount')->comment('Amount refunded for this request');
            $table->enum('refund_method', ['Original_Payment_Method', 'Store_Credit']);
            $table->enum('status', ['approved','rejected','pending', 'processed']);
            $table->timestamp('refunded_at')->nullable();
            $table->text('notes');
            $table->enum('refund_type', ['full', 'partial']);
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refunds');
    }
};

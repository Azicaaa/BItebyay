<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('order_code')->unique();

            // Snapshot data customer saat checkout
            $table->string('customer_name');
            $table->string('phone');
            $table->text('address');
            $table->text('notes')->nullable();

            $table->decimal('total_amount', 12, 2);

            $table->enum('payment_status', [
                'pending',
                'paid',
                'rejected'
            ])->default('pending');

            $table->enum('order_status', [
                'pending',
                'processing',
                'completed',
                'cancelled'
            ])->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

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
            $table->string('ref', 64)->unique();
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone')->nullable();
            $table->string('address_line1');
            $table->string('address_line2')->nullable();
            $table->string('city');
            $table->string('postcode');
            $table->string('country')->default('United Kingdom');
            $table->json('items');
            $table->unsignedInteger('subtotal_pence')->default(0);
            $table->unsignedInteger('shipping_pence')->default(0);
            $table->unsignedInteger('discount_pence')->default(0);
            $table->unsignedInteger('total_pence')->default(0);
            $table->string('payment_method')->default('bank_transfer');
            $table->string('status')->default('pending'); // pending, processing, dispatched, completed, cancelled
            $table->text('customer_notes')->nullable();
            $table->text('admin_notes')->nullable();
            $table->timestamp('placed_at')->nullable();
            $table->timestamps();

            $table->index('status');
            $table->index('customer_email');
            $table->index('created_at');
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


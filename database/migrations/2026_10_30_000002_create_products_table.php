<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('products')) {
            Schema::create('products', function (Blueprint $table) {
                $table->id();
                $table->string('slug')->unique();
                $table->string('name');
                $table->string('category'); // peptides, sarms, pen-kits
                $table->string('dose')->nullable();
                $table->string('price')->default('£0.00');
                $table->unsignedInteger('price_pence')->default(0);
                $table->string('purity')->default('≥98%');
                $table->string('subtitle')->nullable();
                $table->string('formula')->nullable();
                $table->string('cas_no')->nullable();
                $table->text('description')->nullable();
                $table->json('contents')->nullable(); // for pen kits contents list
                $table->json('tiers')->nullable();    // for pen kits quantity tiers
                $table->json('details')->nullable();  // technical details (half life, sequence, etc.)
                $table->string('image')->nullable();
                $table->boolean('in_stock')->default(true);
                $table->boolean('is_active')->default(true);
                $table->boolean('featured')->default(false);
                $table->integer('sort_order')->default(0);
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};


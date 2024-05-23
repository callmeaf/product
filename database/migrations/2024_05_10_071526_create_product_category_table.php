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
        Schema::create('product_category', function (Blueprint $table) {
            $table->foreignIdFor(config('callmeaf-product-category.model'))->constrained(getTableName(config('callmeaf-product-category.model')))->cascadeOnDelete();
            $table->foreignIdFor(config('callmeaf-product.model'))->constrained(getTableName(config('callmeaf-product.model')))->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_category');
    }
};

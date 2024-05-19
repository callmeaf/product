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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->nullable();
            $table->string('status')->nullable();
            $table->string('type')->nullable();
            $table->foreignIdFor(\Callmeaf\User\Models\User::class,'author_id')->nullable()->constrained(getTableName(\Callmeaf\User\Models\User::class))->nullOnDelete();
            $table->string('title')->nullable();
            $table->string('slug')->unique()->nullable();
            $table->string('summary')->nullable();
            $table->text('content')->nullable();
            $table->dateTime('published_at')->nullable();
            $table->dateTime('expired_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

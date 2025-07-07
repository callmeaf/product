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
            $table->string('slug')->primary();
            /**
             * @var \Callmeaf\Store\App\Repo\Contracts\StoreRepoInterface $storeRepo
             */
            $storeRepo = app(\Callmeaf\Store\App\Repo\Contracts\StoreRepoInterface::class);
            $table->string('store_slug')->nullable();
            $table->foreign('store_slug')->references($storeRepo->getModel()->getKeyName())->on($storeRepo->getTable())->cascadeOnUpdate()->nullOnDelete();

            $table->string('status');
            $table->string('type');
            $table->string('delivery_type');
            /**
             * @var \Callmeaf\User\App\Repo\Contracts\UserRepoInterface $userRepo
             */
            $userRepo = app(\Callmeaf\User\App\Repo\Contracts\UserRepoInterface::class);
            $table->string('author_identifier')->nullable();
            $table->foreign('author_identifier')->references($userRepo->getModel()->identifierKey())->on($userRepo->getTable())->cascadeOnUpdate()->nullOnDelete();
            $table->string('title');
            $table->text('summary')->nullable();
            $table->dateTime('published_at')->nullable();
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

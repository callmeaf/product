<?php

use \Illuminate\Support\Facades\Route;

Route::prefix(config('callmeaf-base.api.prefix_url'))->as(config('callmeaf-base.api.prefix_route_name'))->middleware(config('callmeaf-base.api.middlewares'))->group(function() {
    // Product Categories
    Route::apiResource('product_categories',config('callmeaf-product-category.controllers.product_categories'));
    Route::prefix('product_categories')->as('product_categories.')->controller(config('callmeaf-product-category.controllers.product_categories'))->group(function() {
        Route::prefix('{product_category}')->group(function() {
            Route::patch('/status','statusUpdate')->name('status_update');
            Route::patch('/restore','restore')->name('restore');
            Route::delete('/force','forceDestroy')->name('force_destroy');
            Route::patch('/image','imageUpdate')->name('image.update');
        });
        Route::get('/trashed/index','trashed')->name('trashed.index');
    });
    // Products
    Route::apiResource('products',config('callmeaf-product.controllers.products'));
    Route::prefix('products')->as('products.')->controller(config('callmeaf-product.controllers.products'))->group(function() {
        Route::prefix('{product}')->group(function() {
            Route::patch('/status','statusUpdate')->name('status_update');
            Route::patch('/restore','restore')->name('restore');
            Route::delete('/force','forceDestroy')->name('force_destroy');
            Route::patch('/image','imageUpdate')->name('image.update');
        });
        Route::get('/trashed/index','trashed')->name('trashed.index');
    });
});


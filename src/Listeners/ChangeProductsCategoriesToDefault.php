<?php

namespace Callmeaf\Product\Listeners;

use Callmeaf\Product\Events\ProductCategoryDestroyed;
use Callmeaf\Product\Services\V1\ProductService;
use Illuminate\Support\Facades\Log;

class ChangeProductsCategoriesToDefault
{
    /**
     * Handle the event.
     *
     * @param ProductCategoryDestroyed $event
     * @return void
     */
    public function handle(ProductCategoryDestroyed $event)
    {
        /**
         * @var ProductService $productService
         */
       $productService = app(config('callmeaf-product.service'));
       $productService->changeCatsToDefault(productIds: $event->productCategory->products()->pluck('id')->toArray());
    }
}

<?php

namespace Callmeaf\Product\Events;

use Callmeaf\Product\Models\ProductCategory;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProductCategoryStored
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public ProductCategory $productCategory)
    {

    }
}

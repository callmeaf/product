<?php

namespace Callmeaf\Product\Events;

use Callmeaf\Product\Models\ProductCategory;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProductCategoryShowed
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public ProductCategory $productCategory)
    {

    }
}

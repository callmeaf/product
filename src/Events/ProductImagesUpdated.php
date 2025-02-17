<?php

namespace Callmeaf\Product\Events;

use Callmeaf\Product\Models\Product;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProductImagesUpdated
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public Product $product)
    {

    }
}

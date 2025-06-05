<?php

namespace Callmeaf\Product\App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * @extends ResourceCollection<ProductResource>
 */
class ProductCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, ProductResource>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}

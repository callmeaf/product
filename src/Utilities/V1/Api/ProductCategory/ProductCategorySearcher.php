<?php

namespace Callmeaf\Product\Utilities\V1\Api\ProductCategory;

use Callmeaf\Base\Utilities\V1\Contracts\SearcherInterface;
use Illuminate\Database\Eloquent\Builder;

class ProductCategorySearcher implements SearcherInterface
{
    public function apply(Builder $query, array $filters = []): void
    {
        $filters = collect($filters)->filter(fn($item) => strlen(trim($item)));
        if($value = $filters->get('title')) {
            $query->where('title','like',searcherLikeValue($value));
        }
        if($value = $filters->get('slug')) {
            $query->where('slug','like',searcherLikeValue($value));
        }
    }
}

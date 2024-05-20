<?php

namespace Callmeaf\Product\Services\V1\Contracts;

use Callmeaf\Base\Services\V1\Contracts\BaseServiceInterface;
use Callmeaf\Product\Services\V1\ProductService;

interface ProductServiceInterface extends BaseServiceInterface
{
    public function syncCats(null|int|string|array $catIds = []): ProductService;
    public function changeCatsToDefault(null|int|string|array $productIds = [],string $idColumn = 'id',string $catIdColumn = 'id'): ProductService;
}

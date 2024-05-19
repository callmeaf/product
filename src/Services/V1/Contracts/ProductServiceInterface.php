<?php

namespace Callmeaf\Product\Services\V1\Contracts;

use Callmeaf\Base\Services\V1\Contracts\BaseServiceInterface;
use Callmeaf\Product\Services\V1\ProductService;

interface ProductServiceInterface extends BaseServiceInterface
{
    public function syncCats(null|int|string|array $catIds = []): ProductService;
}

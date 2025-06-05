<?php

namespace Callmeaf\Product\App\Repo\Contracts;

use Callmeaf\Base\App\Repo\Contracts\BaseRepoInterface;
use Callmeaf\Product\App\Models\Product;
use Callmeaf\Product\App\Http\Resources\Api\V1\ProductCollection;
use Callmeaf\Product\App\Http\Resources\Api\V1\ProductResource;

/**
 * @extends BaseRepoInterface<Product,ProductResource,ProductCollection>
 */
interface ProductRepoInterface extends BaseRepoInterface
{

}

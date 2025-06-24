<?php

namespace Callmeaf\Product\App\Repo\V1;

use Callmeaf\Base\App\Repo\V1\BaseRepo;
use Callmeaf\Product\App\Events\Admin\V1\ProductSyncedCategories;
use Callmeaf\Product\App\Http\Resources\Api\V1\ProductResource;
use Callmeaf\Product\App\Repo\Contracts\ProductRepoInterface;

class ProductRepo extends BaseRepo implements ProductRepoInterface
{
    public function create(array $data)
    {
        /**
         * @var ProductResource $product
         */
        $product = parent::create($data);

        $images = $data['images'] ?? [];

        if(! empty ($images)) {
            $this->addMultiMedia($product,$data['images']);
        }

        return $this->toResource($product->resource->loadMissing([
            'images'
        ]));
    }

    public function update(mixed $id, array $data)
    {
        /**
         * @var ProductResource $product
         */
        $product = parent::update($id,$data);

        $images = $data['images'] ?? [];

        if(! empty ($images)) {
            $this->addMultiMedia($product,$data['images']);
        }

        return $this->toResource($product->resource->loadMissing([
            'images'
        ]));
    }

    public function syncCategories(string $id, array $catsIds)
    {
        /**
         * @var ProductResource $product
         */
        $product = $this->findById($id);

        $changes = $product->resource->categories()->sync($catsIds);

        $product->resource->loadMissing(['categories']);

        ProductSyncedCategories::dispatch($product->resource,$changes['attached'],$changes['detached'],$changes['updated']);

        return $product;
    }
}

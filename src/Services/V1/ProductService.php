<?php

namespace Callmeaf\Product\Services\V1;

use Callmeaf\Base\Services\V1\BaseService;
use Callmeaf\Product\Enums\ProductCategoryType;
use Callmeaf\Product\Services\V1\Contracts\ProductServiceInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductService extends BaseService implements ProductServiceInterface
{
    public function __construct(?Builder $query = null, ?Model $model = null, ?Collection $collection = null, ?JsonResource $resource = null, ?ResourceCollection $resourceCollection = null, array $defaultData = [],?string $searcher = null)
    {
        parent::__construct($query, $model, $collection, $resource, $resourceCollection, $defaultData,$searcher);
        $this->query = app(config('callmeaf-product.model'))->query();
        $this->resource = config('callmeaf-product.model_resource');
        $this->resourceCollection = config('callmeaf-product.model_resource_collection');
        $this->defaultData = config('callmeaf-product.default_values');
        $this->searcher = config('callmeaf-product.searcher');
    }

    public function syncCats(int|array|string|null $catIds = []): ProductService
    {
        if(!is_array($catIds)) {
            $catIds = array_filter([$catIds]);
        }
        $this->model->cats()->sync($catIds);
        return $this;
    }

    public function changeCatsToDefault(int|array|string|null $productIds = [],string $idColumn = 'id',string $catIdColumn = 'id'): ProductService
    {
        if(!is_array($productIds)) {
            $productIds = array_filter([$productIds]);
        }
        /**
         * @var ProductCategoryService $productCategoryService
         */
        $productCategoryService = app(config('callmeaf-product-category.service'));
        $defaultCatsIds = $productCategoryService->freshQuery()->where(column: 'type',valueOrOperation: ProductCategoryType::DEFAULT->value)->all(columns: [$catIdColumn])->getCollection()->pluck($catIdColumn)->toArray();
        $this->freshQuery()->select(columns: [$idColumn])->where(column: $idColumn,valueOrOperation: $productIds)->getQuery()->chunkById(count: 50,callback: function(\Illuminate\Support\Collection $products) use ($defaultCatsIds) {
            $products->each(function($product) use ($defaultCatsIds) {
                $this->setModel($product)->syncCats(catIds: $product->cats()->pluck('id')->merge($defaultCatsIds)->unique()->toArray());
            });
        },column: $idColumn);
        return $this;
    }

}

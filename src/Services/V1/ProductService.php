<?php

namespace Callmeaf\Product\Services\V1;

use Callmeaf\Base\Services\V1\BaseService;
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
            $catIds = [$catIds];
        }
        $this->model->cats()->sync(array_filter($catIds));
        return $this;
    }

}

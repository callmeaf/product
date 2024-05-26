<?php

namespace Callmeaf\Product\Http\Controllers\V1\Api;

use Callmeaf\Base\Http\Controllers\V1\Api\ApiController;
use Callmeaf\Product\Events\ProductDestroyed;
use Callmeaf\Product\Events\ProductForceDestroyed;
use Callmeaf\Product\Events\ProductIndexed;
use Callmeaf\Product\Events\ProductRestored;
use Callmeaf\Product\Events\ProductShowed;
use Callmeaf\Product\Events\ProductStatusUpdated;
use Callmeaf\Product\Events\ProductStored;
use Callmeaf\Product\Events\ProductTrashed;
use Callmeaf\Product\Events\ProductUpdated;
use Callmeaf\Product\Http\Requests\V1\Api\ProductDestroyRequest;
use Callmeaf\Product\Http\Requests\V1\Api\ProductForceDestroyRequest;
use Callmeaf\Product\Http\Requests\V1\Api\ProductIndexRequest;
use Callmeaf\Product\Http\Requests\V1\Api\ProductRestoreRequest;
use Callmeaf\Product\Http\Requests\V1\Api\ProductShowRequest;
use Callmeaf\Product\Http\Requests\V1\Api\ProductStatusUpdateRequest;
use Callmeaf\Product\Http\Requests\V1\Api\ProductStoreRequest;
use Callmeaf\Product\Http\Requests\V1\Api\ProductTrashedIndexRequest;
use Callmeaf\Product\Http\Requests\V1\Api\ProductUpdateRequest;
use Callmeaf\Product\Models\Product;
use Callmeaf\Product\Services\V1\ProductService;

class ProductController extends ApiController
{
    protected ProductService $productService;
    public function __construct()
    {
        app(config('callmeaf-product.middlewares.product'))($this);
        $this->productService = app(config('callmeaf-product.service'));
    }

    public function index(ProductIndexRequest $request)
    {
        try {
            $products = $this->productService->all(
                relations: config('callmeaf-product.resources.index.relations'),
                columns: config('callmeaf-product.resources.index.columns'),
                filters: $request->validated(),
            )->getCollection(asResourceCollection: true,asResponseData: true,attributes: config('callmeaf-product.resources.index.attributes'),events: [
                ProductIndexed::class,
            ]);
            return apiResponse([
                'products' => $products,
            ],__('callmeaf-base::v1.successful_loaded'));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function store(ProductStoreRequest $request)
    {
        try {
            $product = $this->productService->create(data: $request->validated(),events: [
                ProductStored::class
            ])->syncCats(catIds: $request->get('cat_ids'))->getModel(asResource: true,attributes: config('callmeaf-product.resources.store.attributes'),relations: config('callmeaf-product.resources.store.relations'));
            return apiResponse([
                'product' => $product,
            ],__('callmeaf-base::v1.successful_created', [
                'title' => $product->responseTitles('store'),
            ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function show(ProductShowRequest $request,Product $product)
    {
        try {
            $product = $this->productService->setModel($product)->getModel(
                asResource: true,
                attributes: config('callmeaf-product.resources.show.attributes'),
                relations: config('callmeaf-product.resources.show.relations'),
                events: [
                    ProductShowed::class,
                ],
            );
            return apiResponse([
                'product' => $product,
            ],__('callmeaf-base::v1.successful_loaded'));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function update(ProductUpdateRequest $request,Product $product)
    {
        try {
            $product = $this->productService->setModel($product)->update(data: $request->validated(),events: [
                ProductUpdated::class,
            ])->syncCats(catIds: $request->get('cat_ids'))->getModel(asResource: true,attributes: config('callmeaf-product.resources.update.attributes'),relations: config('callmeaf-product.resources.update.relations'));
            return apiResponse([
                'product' => $product,
            ],__('callmeaf-base::v1.successful_updated', [
                'title' =>  $product->responseTitles('update')
            ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function statusUpdate(ProductStatusUpdateRequest $request,Product $product)
    {
        try {
            $product = $this->productService->setModel($product)->update([
                'status' => $request->get('status'),
            ],events: [
                ProductStatusUpdated::class,
            ])->getModel(asResource: true,attributes: config('callmeaf-product.resources.status_update.attributes'),relations: config('callmeaf-product.resources.status_update.relations'));
            return apiResponse([
                'product' => $product,
            ],__('callmeaf-base::v1.successful_updated', [
                'title' =>  $product->responseTitles('status_update')
            ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function destroy(ProductDestroyRequest $request,Product $product)
    {
        try {
            $product = $this->productService->setModel($product)->delete(events: [
                ProductDestroyed::class,
            ])->getModel(asResource: true,attributes: config('callmeaf-product.resources.destroy.attributes'),relations: config('callmeaf-product.resources.destroy.relations'));
            return apiResponse([
                'product' => $product,
            ],__('callmeaf-base::v1.successful_deleted', [
                'title' =>  $product->responseTitles('destroy')
            ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }


    public function restore(ProductRestoreRequest $request,string|int $id)
    {
        try {
            $product = $this->productService->restore(id: $id,idColumn: config('callmeaf-product.resources.restore.id_column'),events: [
                ProductRestored::class
            ])->getModel(asResource: true,attributes: config('callmeaf-product.resources.restore.attributes'),relations: config('callmeaf-product.resources.restore.relations'));
            return apiResponse([
                'product' => $product,
            ],__('callmeaf-base::v1.successful_restored',[
                'title' =>  $product->responseTitles('restore')
            ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function trashed(ProductTrashedIndexRequest $request)
    {
        try {
            $products = $this->productService->onlyTrashed()->all(
                relations: config('callmeaf-product.resources.trashed.relations'),
                columns: config('callmeaf-product.resources.trashed.columns'),
                filters: $request->validated(),
            )->getCollection(asResourceCollection: true,asResponseData: true,attributes: config('callmeaf-product.resources.trashed.attributes'),events: [
                ProductTrashed::class,
            ]);
            return apiResponse([
                'products' => $products,
            ],__('callmeaf-base::v1.successful_loaded'));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function forceDestroy(ProductForceDestroyRequest $request,string|int $id)
    {
        try {
            $product = $this->productService->forceDelete(id: $id,idColumn: config('callmeaf-product.resources.force_destroy.id_column'),columns: config('callmeaf-product.resources.force_destroy.columns'),events: [
                ProductForceDestroyed::class,
            ])->getModel(asResource: true,attributes: config('callmeaf-product.resources.force_destroy.attributes'),relations: config('callmeaf-product.resources.force_destroy.relations'));
            return apiResponse([
                'product' => $product,
            ],__('callmeaf-base::v1.successful_force_destroyed',[
                'title' =>  $product->responseTitles('force_destroy')
            ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }
}

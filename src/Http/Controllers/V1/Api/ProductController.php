<?php

namespace Callmeaf\Product\Http\Controllers\V1\Api;

use Callmeaf\Base\Enums\ResponseTitle;
use Callmeaf\Base\Http\Controllers\V1\Api\ApiController;
use Callmeaf\Media\Enums\MediaCollection;
use Callmeaf\Media\Enums\MediaDisk;
use Callmeaf\Product\Events\ProductDestroyed;
use Callmeaf\Product\Events\ProductForceDestroyed;
use Callmeaf\Product\Events\ProductImageUpdated;
use Callmeaf\Product\Events\ProductIndexed;
use Callmeaf\Product\Events\ProductRestored;
use Callmeaf\Product\Events\ProductShowed;
use Callmeaf\Product\Events\ProductStatusUpdated;
use Callmeaf\Product\Events\ProductStored;
use Callmeaf\Product\Events\ProductSyncedCats;
use Callmeaf\Product\Events\ProductTrashed;
use Callmeaf\Product\Events\ProductUpdated;
use Callmeaf\Product\Http\Requests\V1\Api\ProductDestroyRequest;
use Callmeaf\Product\Http\Requests\V1\Api\ProductForceDestroyRequest;
use Callmeaf\Product\Http\Requests\V1\Api\ProductImageUpdateRequest;
use Callmeaf\Product\Http\Requests\V1\Api\ProductIndexRequest;
use Callmeaf\Product\Http\Requests\V1\Api\ProductRestoreRequest;
use Callmeaf\Product\Http\Requests\V1\Api\ProductShowRequest;
use Callmeaf\Product\Http\Requests\V1\Api\ProductStatusUpdateRequest;
use Callmeaf\Product\Http\Requests\V1\Api\ProductStoreRequest;
use Callmeaf\Product\Http\Requests\V1\Api\ProductSyncCatsRequest;
use Callmeaf\Product\Http\Requests\V1\Api\ProductTrashedIndexRequest;
use Callmeaf\Product\Http\Requests\V1\Api\ProductUpdateRequest;
use Callmeaf\Product\Models\Product;
use Callmeaf\Product\Services\V1\ProductService;
use Callmeaf\Product\Utilities\V1\Api\Product\ProductResources;

class ProductController extends ApiController
{
    protected ProductService $productService;
    protected ProductResources $productResources;
    public function __construct()
    {
        $this->productService = app(config('callmeaf-product.service'));
        $this->productResources = app(config('callmeaf-product.resources.product'));
    }

    public static function middleware(): array
    {
        return app(config('callmeaf-product.middlewares.product'))();
    }

    public function index(ProductIndexRequest $request)
    {
        try {
            $resources = $this->productResources->index();
            $products = $this->productService->all(
                relations: $resources->relations(),
                columns: $resources->columns(),
                filters: $request->validated(),
            )->getCollection(asResourceCollection: true,asResponseData: true,attributes: $resources->attributes(),events: [
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
            $resources = $this->productResources->store();
            $product = $this->productService->create(data: $request->validated(),events: [
                ProductStored::class
            ])->getModel(asResource: true,attributes: $resources->attributes(),relations: $resources->relations());
            return apiResponse([
                'product' => $product,
            ],__('callmeaf-base::v1.successful_created', [
                'title' => $product->responseTitles(ResponseTitle::STORE),
            ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function show(ProductShowRequest $request,Product $product)
    {
        try {
            $resources = $this->productResources->show();
            $product = $this->productService->setModel($product)->getModel(
                asResource: true,
                attributes: $resources->attributes(),
                relations: $resources->relations(),
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
            $resources = $this->productResources->update();
            $product = $this->productService->setModel($product)->update(data: $request->validated(),events: [
                ProductUpdated::class,
            ])->getModel(asResource: true,attributes: $resources->attributes(),relations: $resources->relations());
            return apiResponse([
                'product' => $product,
            ],__('callmeaf-base::v1.successful_updated', [
                'title' =>  $product->responseTitles(ResponseTitle::UPDATE)
            ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function statusUpdate(ProductStatusUpdateRequest $request,Product $product)
    {
        try {
            $resources = $this->productResources->statusUpdate();
            $product = $this->productService->setModel($product)->update([
                'status' => $request->get('status'),
            ],events: [
                ProductStatusUpdated::class,
            ])->getModel(asResource: true,attributes: $resources->attributes(),relations: $resources->relations());
            return apiResponse([
                'product' => $product,
            ],__('callmeaf-base::v1.successful_updated', [
                'title' =>  $product->responseTitles(ResponseTitle::STATUS_UPDATE)
            ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function destroy(ProductDestroyRequest $request,Product $product)
    {
        try {
            $resources = $this->productResources->destroy();
            $product = $this->productService->setModel($product)->delete(events: [
                ProductDestroyed::class,
            ])->getModel(asResource: true,attributes: $resources->attributes(),relations: $resources->relations());
            return apiResponse([
                'product' => $product,
            ],__('callmeaf-base::v1.successful_deleted', [
                'title' =>  $product->responseTitles(ResponseTitle::DESTROY)
            ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }


    public function restore(ProductRestoreRequest $request,string|int $id)
    {
        try {
            $resources = $this->productResources->restore();
            $product = $this->productService->restore(id: $id,idColumn: $resources->idColumn(),events: [
                ProductRestored::class
            ])->getModel(asResource: true,attributes: $resources->attributes(),relations: $resources->relations());
            return apiResponse([
                'product' => $product,
            ],__('callmeaf-base::v1.successful_restored',[
                'title' =>  $product->responseTitles(ResponseTitle::RESTORE)
            ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function trashed(ProductTrashedIndexRequest $request)
    {
        try {
            $resources = $this->productResources->trashed();
            $products = $this->productService->onlyTrashed()->all(
                relations: $resources->relations(),
                columns: $resources->columns(),
                filters: $request->validated(),
            )->getCollection(asResourceCollection: true,asResponseData: true,attributes: $resources->attributes(),events: [
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
            $resources = $this->productResources->forceDestroy();
            $product = $this->productService->forceDelete(id: $id,idColumn: $resources->idColumn(),columns: $resources->columns(),events: [
                ProductForceDestroyed::class,
            ])->getModel(asResource: true,attributes: $resources->attributes(),relations: $resources->relations());
            return apiResponse([
                'product' => $product,
            ],__('callmeaf-base::v1.successful_force_destroyed',[
                'title' =>  $product->responseTitles(ResponseTitle::FORCE_DESTROY)
            ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }


    public function imageUpdate(ProductImageUpdateRequest $request,Product $product)
    {
        try {
            $resources = $this->productResources->imageUpdate();
            $product = $this->productService->setModel($product)->createMedia(file: $request->file('image'),collection: MediaCollection::IMAGE,disk: MediaDisk::VARIATIONS)->getModel(asResource: true,attributes: $resources->attributes(),relations: $resources->relations(),events: [
                ProductImageUpdated::class,
            ]);
            return apiResponse([
                'product' => $product,
            ],__('callmeaf-base::v1.successful_updated',[
                'title' => $product->responseTitles('image_update')
            ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function syncCats(ProductSyncCatsRequest $request,Product $product)
    {
        try {
            $resources = $this->productResources->syncCats();
            $product = $this->productService->setModel($product)
                ->syncCats(catIds: $request->get('cats_ids'))
                ->getModel(asResource: true,attributes: $resources->attributes(),relations: $resources->relations(),events: [
                    ProductSyncedCats::class,
                ]);
            return apiResponse([
                'product' => $product,
            ],__('callmeaf-base::v1.successful_updated',[
                'title' => $product->responseTitles('sync_cats')
            ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }
}

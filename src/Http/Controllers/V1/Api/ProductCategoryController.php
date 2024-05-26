<?php

namespace Callmeaf\Product\Http\Controllers\V1\Api;

use Callmeaf\Base\Http\Controllers\V1\Api\ApiController;
use Callmeaf\Media\Enums\MediaCollection;
use Callmeaf\Media\Enums\MediaDisk;
use Callmeaf\Product\Events\ProductCategoryDestroyed;
use Callmeaf\Product\Events\ProductCategoryForceDestroyed;
use Callmeaf\Product\Events\ProductCategoryImageUpdated;
use Callmeaf\Product\Events\ProductCategoryIndexed;
use Callmeaf\Product\Events\ProductCategoryRestored;
use Callmeaf\Product\Events\ProductCategoryShowed;
use Callmeaf\Product\Events\ProductCategoryStatusUpdated;
use Callmeaf\Product\Events\ProductCategoryStored;
use Callmeaf\Product\Events\ProductCategoryTrashed;
use Callmeaf\Product\Events\ProductCategoryUpdated;
use Callmeaf\Product\Http\Requests\V1\Api\ProductCategoryDestroyRequest;
use Callmeaf\Product\Http\Requests\V1\Api\ProductCategoryForceDestroyRequest;
use Callmeaf\Product\Http\Requests\V1\Api\ProductCategoryImageUpdateRequest;
use Callmeaf\Product\Http\Requests\V1\Api\ProductCategoryIndexRequest;
use Callmeaf\Product\Http\Requests\V1\Api\ProductCategoryRestoreRequest;
use Callmeaf\Product\Http\Requests\V1\Api\ProductCategoryShowRequest;
use Callmeaf\Product\Http\Requests\V1\Api\ProductCategoryStatusUpdateRequest;
use Callmeaf\Product\Http\Requests\V1\Api\ProductCategoryStoreRequest;
use Callmeaf\Product\Http\Requests\V1\Api\ProductCategoryTrashedIndexRequest;
use Callmeaf\Product\Http\Requests\V1\Api\ProductCategoryUpdateRequest;
use Callmeaf\Product\Models\ProductCategory;
use Callmeaf\Product\Services\V1\ProductCategoryService;
use Illuminate\Support\Facades\Log;

class ProductCategoryController extends ApiController
{
    protected ProductCategoryService $productCategoryService;
    public function __construct()
    {
        app(config('callmeaf-product-category.middlewares.product_category'))($this);
        $this->productCategoryService = app(config('callmeaf-product-category.service'));
    }

    public function index(ProductCategoryIndexRequest $request)
    {
        try {
            $productCategories = $this->productCategoryService->all(
                relations: config('callmeaf-product-category.resources.index.relations'),
                columns: config('callmeaf-product-category.resources.index.columns'),
                filters: $request->validated(),
            )->getCollection(asResourceCollection: true,asResponseData: true,attributes: config('callmeaf-product-category.resources.index.attributes'),events: [
                ProductCategoryIndexed::class,
            ]);
            return apiResponse([
                'product_categories' => $productCategories,
            ],__('callmeaf-base::v1.successful_loaded'));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function store(ProductCategoryStoreRequest $request)
    {
        try {
            $productCategory = $this->productCategoryService->create(data: $request->validated(),events: [
                ProductCategoryStored::class
            ])->getModel(asResource: true,attributes: config('callmeaf-product-category.resources.store.attributes'),relations: config('callmeaf-product-category.resources.store.relations'));
            return apiResponse([
                'product_category' => $productCategory,
            ],__('callmeaf-base::v1.successful_created', [
                'title' => $productCategory->responseTitles('store'),
            ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function show(ProductCategoryShowRequest $request,ProductCategory $productCategory)
    {
        try {
            $productCategory = $this->productCategoryService->setModel($productCategory)
                ->getModel(
                    asResource: true,
                    attributes: config('callmeaf-product-category.resources.show.attributes'),
                    relations: config('callmeaf-product-category.resources.show.relations'),
                    events: [
                        ProductCategoryShowed::class,
                    ],
                );
            return apiResponse([
                'product_category' => $productCategory,
            ],__('callmeaf-base::v1.successful_loaded'));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function update(ProductCategoryUpdateRequest $request,ProductCategory $productCategory)
    {
        try {
            $productCategory = $this->productCategoryService->setModel($productCategory)->update(data: $request->validated(),events: [
                ProductCategoryUpdated::class,
            ])->getModel(asResource: true,attributes: config('callmeaf-product-category.resources.update.attributes'),relations: config('callmeaf-product-category.resources.update.relations'));
            return apiResponse([
                'product_category' => $productCategory,
            ],__('callmeaf-base::v1.successful_updated', [
                'title' =>  $productCategory->responseTitles('update')
            ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function statusUpdate(ProductCategoryStatusUpdateRequest $request,ProductCategory $productCategory)
    {
        try {
            $productCategory = $this->productCategoryService->setModel($productCategory)->update([
                'status' => $request->get('status'),
            ])->getModel(asResource: true,attributes: config('callmeaf-product-category.resources.status_update.attributes'),relations: config('callmeaf-product-category.resources.status_update.relations'),events: [
                ProductCategoryStatusUpdated::class,
            ]);
            return apiResponse([
                'product_category' => $productCategory,
            ],__('callmeaf-base::v1.successful_updated', [
                'title' =>  $productCategory->responseTitles('status_update')
            ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function destroy(ProductCategoryDestroyRequest $request,ProductCategory $productCategory)
    {
        try {
            $productCategory = $this->productCategoryService->setModel($productCategory)->delete(events: [
                ProductCategoryDestroyed::class,
            ])->getModel(asResource: true,attributes: config('callmeaf-product-category.resources.destroy.attributes'),relations: config('callmeaf-product-category.resources.destroy.relations'));
            return apiResponse([
                'product_category' => $productCategory,
            ],__('callmeaf-base::v1.successful_deleted', [
                'title' =>  $productCategory->responseTitles('destroy')
            ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }


    public function restore(ProductCategoryRestoreRequest $request,string|int $id)
    {
        try {
            $productCategory = $this->productCategoryService->restore(id: $id,idColumn: config('callmeaf-product-category.resources.restore.id_column'),events: [
                ProductCategoryRestored::class
            ])->getModel(asResource: true,attributes: config('callmeaf-product-category.resources.restore.attributes'),relations: config('callmeaf-product-category.resources.restore.relations'));
            return apiResponse([
                'product_category' => $productCategory,
            ],__('callmeaf-base::v1.successful_restored',[
                'title' =>  $productCategory->responseTitles('restore')
            ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function trashed(ProductCategoryTrashedIndexRequest $request)
    {
        try {
            $productCategories = $this->productCategoryService->onlyTrashed()->all(
                relations: config('callmeaf-product-category.resources.trashed.relations'),
                columns: config('callmeaf-product-category.resources.trashed.columns'),
                filters: $request->validated(),
            )->getCollection(asResourceCollection: true,asResponseData: true,attributes: config('callmeaf-product-category.resources.trashed.attributes'),events: [
                ProductCategoryTrashed::class,
            ]);
            return apiResponse([
                'product_categories' => $productCategories,
            ],__('callmeaf-base::v1.successful_loaded'));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function forceDestroy(ProductCategoryForceDestroyRequest $request,string|int $id)
    {
        try {
            $productCategory = $this->productCategoryService->forceDelete(id: $id,idColumn: config('callmeaf-product-category.resources.force_destroy.id_column'),columns: config('callmeaf-product-category.resources.force_destroy.columns'),events: [
                ProductCategoryForceDestroyed::class,
            ])->getModel(asResource: true,attributes: config('callmeaf-product-category.resources.force_destroy.attributes'),relations: config('callmeaf-product-category.resources.force_destroy.relations'));
            return apiResponse([
                'product_category' => $productCategory,
            ],__('callmeaf-base::v1.successful_force_destroyed',[
                'title' =>  $productCategory->responseTitles('force_destroy')
            ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function imageUpdate(ProductCategoryImageUpdateRequest $request,ProductCategory $productCategory)
    {
        try {
            $productCategory = $this->productCategoryService
                ->setModel($productCategory)
                ->createMedia(file: $request->file('image'),collection: MediaCollection::IMAGE,disk: MediaDisk::PRODUCTS)
            ->getModel(asResource: true,events: [
                ProductCategoryImageUpdated::class,
            ]);

             return apiResponse([],__('base::v1.successful_loaded'));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }
}

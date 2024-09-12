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
use Callmeaf\Product\Utilities\V1\ProductCategory\Api\ProductCategoryResources;
use Illuminate\Support\Facades\Log;

class ProductCategoryController extends ApiController
{
    protected ProductCategoryService $productCategoryService;
    protected ProductCategoryResources $productCategoryResources;
    public function __construct()
    {
        app(config('callmeaf-product-category.middlewares.product_category'))($this);
        $this->productCategoryService = app(config('callmeaf-product-category.service'));
        $this->productCategoryResources = app(config('callmeaf-product-category.resources.product_category'));
    }

    public function index(ProductCategoryIndexRequest $request)
    {
        try {
            $resources = $this->productCategoryResources->index();
            $productCategories = $this->productCategoryService->all(
                relations: $resources->relations(),
                columns: $resources->columns(),
                filters: $request->validated(),
            )->getCollection(asResourceCollection: true,asResponseData: true,attributes: $resources->attributes(),events: [
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
            $resources = $this->productCategoryResources->store();
            $productCategory = $this->productCategoryService->create(data: $request->validated(),events: [
                ProductCategoryStored::class
            ])->getModel(asResource: true,attributes: $resources->attributes(),relations: $resources->relations());
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
            $resources = $this->productCategoryResources->show();
            $productCategory = $this->productCategoryService->setModel($productCategory)
                ->getModel(
                    asResource: true,
                    attributes: $resources->attributes(),
                    relations: $resources->relations(),
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
            $resources = $this->productCategoryResources->update();
            $productCategory = $this->productCategoryService->setModel($productCategory)->update(data: $request->validated(),events: [
                ProductCategoryUpdated::class,
            ])->getModel(asResource: true,attributes: $resources->attributes(),relations: $resources->relations());
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
            $resources = $this->productCategoryResources->statusUpdate();
            $productCategory = $this->productCategoryService->setModel($productCategory)->update([
                'status' => $request->get('status'),
            ])->getModel(asResource: true,attributes: $resources->attributes(),relations: $resources->relations(),events: [
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
            $resources = $this->productCategoryResources->destroy();
            $productCategory = $this->productCategoryService->setModel($productCategory)->delete(events: [
                ProductCategoryDestroyed::class,
            ])->getModel(asResource: true,attributes: $resources->attributes(),relations: $resources->relations());
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
            $resources = $this->productCategoryResources->restore();
            $productCategory = $this->productCategoryService->restore(id: $id,idColumn: $resources->idColumn(),events: [
                ProductCategoryRestored::class
            ])->getModel(asResource: true,attributes: $resources->attributes(),relations: $resources->relations());
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
            $resources = $this->productCategoryResources->trashed();
            $productCategories = $this->productCategoryService->onlyTrashed()->all(
                relations: $resources->relations(),
                columns: $resources->columns(),
                filters: $request->validated(),
            )->getCollection(asResourceCollection: true,asResponseData: true,attributes: $resources->attributes(),events: [
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
            $resources = $this->productCategoryResources->forceDestroy();
            $productCategory = $this->productCategoryService->forceDelete(id: $id,idColumn: $resources->idColumn(),columns: $resources->columns(),events: [
                ProductCategoryForceDestroyed::class,
            ])->getModel(asResource: true,attributes: $resources->attributes(),relations: $resources->relations());
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
            $resources = $this->productCategoryResources->imageUpdate();
            $productCategory = $this->productCategoryService
                ->setModel($productCategory)
                ->createMedia(file: $request->file('image'),collection: MediaCollection::IMAGE,disk: MediaDisk::PRODUCTS)
            ->getModel(asResource: true,attributes: $resources->attributes(),relations: $resources->relations(),events: [
                ProductCategoryImageUpdated::class,
            ]);

             return apiResponse([
                 'product_category' => $productCategory,
             ],__('callmeaf-base::v1.successful_updated_non_title'));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }
}

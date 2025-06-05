<?php

namespace Callmeaf\Product\App\Http\Controllers\Admin\V1;

use Callmeaf\Base\App\Http\Controllers\Admin\V1\AdminController;
use Callmeaf\Product\App\Repo\Contracts\ProductRepoInterface;
use Callmeaf\ProductContent\App\Repo\Contracts\ProductContentRepoInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ProductController extends AdminController implements HasMiddleware
{
    public function __construct(protected ProductRepoInterface $productRepo)
    {
        parent::__construct($this->productRepo->config);
    }

    public static function middleware(): array
    {
        return [
           //
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->productRepo->latest()->search()->paginate();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        return $this->productRepo->create(data: $this->request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->productRepo->builder(fn(Builder $query) => $query->with([
            'images'
        ]))->findById(value: $id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $id)
    {
        return $this->productRepo->update(id: $id, data: $this->request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->productRepo->delete(id: $id);
    }

    public function statusUpdate(string $id)
    {
        return $this->productRepo->update(id: $id, data: $this->request->validated());
    }

    public function typeUpdate(string $id)
    {
        return $this->productRepo->update(id: $id, data: $this->request->validated());
    }

    public function trashed()
    {
        return $this->productRepo->trashed()->latest()->search()->paginate();
    }

    public function restore(string $id)
    {
        return $this->productRepo->restore(id: $id);
    }

    public function forceDestroy(string $id)
    {
        return $this->productRepo->forceDelete(id: $id);
    }

    public function getContent(string $id)
    {
        $product = $this->productRepo->findById($id);
        /**
         * @var ProductContentRepoInterface $productContentRepo
         */
        $productContentRepo = app(ProductContentRepoInterface::class);

        return $productContentRepo->toResource(
            $product->resource->content,
        );
    }
}

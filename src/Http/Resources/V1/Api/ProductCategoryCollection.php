<?php

namespace Callmeaf\Product\Http\Resources\V1\Api;

use Callmeaf\Media\Http\Resources\V1\Api\MediaResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCategoryCollection extends ResourceCollection
{
    public function __construct($resource,protected array|int $only = [])
    {
        parent::__construct($resource);
    }

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->map(fn($productCategory) => toArrayResource(data: [
                'id' => fn() => $productCategory->id,
                'parent_id' => fn() => $productCategory->parent_id,
                'status' => fn() => $productCategory->status,
                'status_text' => fn() => $productCategory->statusText,
                'type' => fn() => $productCategory->type,
                'type_text' => fn() => $productCategory->typeText,
                'title' => fn() => $productCategory->title,
                'slug' => fn() => $productCategory->slug,
                'summary' => fn() => $productCategory->summary,
                'content' => fn() => $productCategory->content,
                'created_at' => fn() => $productCategory->created_at,
                'created_at_text' => fn() => $productCategory->createdAtText,
                'updated_at' => fn() => $productCategory->updated_at,
                'updated_at_text' => fn() => $productCategory->updatedAtText,
                'deleted_at' => fn() => $productCategory->deleted_at,
                'deleted_at_text' => fn() => $productCategory->deletedAtText,
                'image' => fn() => $productCategory->image ? new (config('callmeaf-media.model_resource'))($this->image,only: $this->only['!image'] ?? []) : null,
                'parent' => fn() => $productCategory->parent ? new (config('callmeaf-product-category.model_resource'))($productCategory->parent,only: $this->only['!parent'] ?? []) : null,
                'children' => fn() => $productCategory->children->count() ? new (config('callmeaf-product-category.model_resource_collection'))($this->children,only: $this->only['!parent'] ?? []) : null,
            ],only: $this->only)),
        ];
    }
}

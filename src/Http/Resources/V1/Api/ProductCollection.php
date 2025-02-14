<?php

namespace Callmeaf\Product\Http\Resources\V1\Api;

use Callmeaf\Media\Http\Resources\V1\Api\MediaResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
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
            'data' => $this->collection->map(fn($product) => toArrayResource(data: [
                'id' => fn() => $product->id,
                'status' => fn() => $product->status,
                'status_text' => fn() => $product->statusText,
                'type' => fn() => $product->type,
                'type_text' => fn() => $product->typeText,
                'title' => fn() => $product->title,
                'slug' => fn() => $product->slug,
                'summary' => fn() => $product->summary,
                'content' => fn() => $product->content,
                'published_at' => fn() => $product->published_at,
                'published_at_text' => fn() => $product->publishedAtText,
                'expired_at' => fn() => $product->expired_at,
                'expired_at_text' => fn() => $product->expiredAtText,
                'created_at' => fn() => $product->created_at,
                'created_at_text' => fn() => $product->createdAtText,
                'updated_at' => fn() => $product->updated_at,
                'updated_at_text' => fn() => $product->updatedAtText,
                'deleted_at' => fn() => $product->deleted_at,
                'deleted_at_text' => fn() => $product->deletedAtText,
                'image' => fn() => $product->image ? new (config('callmeaf-media.model_resource'))($product->image,only: $this->only['!image'] ?? []) : null,
                'province' => fn() => $product->province ? new (config('callmeaf-province.model_resource'))($product->province,only: $this->only['!province'] ?? []) : null,
                'cats' => fn() => $product->cats->count() ? new (config('callmeaf-product-category.model_resource_collection'))($this->cats,only: $this->only['!cats'] ?? []) : null,
            ],only: $this->only)),
        ];
    }
}

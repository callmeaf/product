<?php

namespace Callmeaf\Product\Http\Resources\V1\Api;

use Callmeaf\Media\Http\Resources\V1\Api\MediaResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductCategoryResource extends JsonResource
{
    public function __construct($resource,protected array|int $only = [])
    {
        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return toArrayResource(data: [
            'id' => fn() => $this->id,
            'parent_id' => fn() => $this->parent_id,
            'status' => fn() => $this->status,
            'status_text' => fn() => $this->statusText,
            'type' => fn() => $this->type,
            'type_text' => fn() => $this->typeText,
            'title' => fn() => $this->title,
            'slug' => fn() => $this->slug,
            'summary' => fn() => $this->summary,
            'content' => fn() => $this->content,
            'created_at' => fn() => $this->created_at,
            'created_at_text' => fn() => $this->createdAtText,
            'updated_at' => fn() => $this->updated_at,
            'updated_at_text' => fn() => $this->updatedAtText,
            'deleted_at' => fn() => $this->deleted_at,
            'deleted_at_text' => fn() => $this->deletedAtText,
            'image' => fn() => $this->image ? new (config('callmeaf-media.model_resource'))($this->image,only: $this->only['!image'] ?? []) : null,
            'parent' => fn() => $this->parent ? new (config('callmeaf-product-category.model_resource'))($this->parent,only: $this->only['!parent'] ?? []) : null,
            'children' => fn() => $this->children->count() ? ew (config('callmeaf-product-category.model_resource_collection'))($this->children,only: $this->only['!parent'] ?? []) : null,
        ],only: $this->only);
    }
}

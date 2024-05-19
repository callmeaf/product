<?php

namespace Callmeaf\Product\Http\Resources\V1\Api;

use Callmeaf\Media\Http\Resources\V1\Api\MediaResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'status' => fn() => $this->status,
            'status_text' => fn() => $this->statusText,
            'type' => fn() => $this->type,
            'type_text' => fn() => $this->typeText,
            'title' => fn() => $this->title,
            'slug' => fn() => $this->slug,
            'summary' => fn() => $this->summary,
            'content' => fn() => $this->content,
            'published_at' => fn() => $this->published_at,
            'published_at_text' => fn() => $this->publishedAtText,
            'expired_at' => fn() => $this->expired_at,
            'expired_at_text' => fn() => $this->expiredAtText,
            'created_at' => fn() => $this->created_at,
            'created_at_text' => fn() => $this->createdAtText,
            'updated_at' => fn() => $this->updated_at,
            'updated_at_text' => fn() => $this->updatedAtText,
            'deleted_at' => fn() => $this->deleted_at,
            'deleted_at_text' => fn() => $this->deletedAtText,
            'image' => fn() => new MediaResource($this->image,only: $this->only['!image'] ?? []),
            'cat_ids' => fn() => $this->cats()->pluck('id'),
            'cats' => fn() => new ProductCategoryCollection($this->cats,only: $this->only['!cats'] ?? []),
        ],only: $this->only);
    }
}

<?php

namespace Callmeaf\Product\App\Http\Resources\Admin\V1;

use Callmeaf\Base\App\Enums\DateTimeFormat;
use Callmeaf\Media\App\Repo\Contracts\MediaRepoInterface;
use Callmeaf\Product\App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read Product $resource
 */
class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /**
         * @var MediaRepoInterface $mediaRepo
         */
        $mediaRepo = app(MediaRepoInterface::class);
        return [
            'slug' => $this->slug,
            'title' => $this->title,
            'author_identifier' => $this->author_identifier,
            'status' => $this->status,
            'status_text' => $this->statusText,
            'type' => $this->type,
            'type_text' => $this->typeText,
            'summary' => $this->summary,
            'created_at' => $this->created_at,
            'created_at_text' => $this->createdAtText(DateTimeFormat::DATE_TIME),
            'updated_at' => $this->updated_at,
            'updated_at_text' => $this->updatedAtText(DateTimeFormat::DATE_TIME),
            'deleted_at' => $this->deleted_at,
            'deleted_at_text' => $this->deletedAtText(),
            'images' => $mediaRepo->toResourceCollection($this->whenLoaded('images')),
        ];
    }
}

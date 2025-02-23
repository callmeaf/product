<?php

namespace Callmeaf\Product\Utilities\V1\Api\Product;

use Callmeaf\Base\Utilities\V1\FormRequestValidator;

class ProductFormRequestValidator extends FormRequestValidator
{
    public function index(): array
    {
        return [
            'title' => false,
            'slug' => false,
        ];
    }

    public function store(): array
    {
        $rules = [
            'status' => true,
            'type' => true,
            'province_id' => false,
            'title' => true,
            'slug' => true,
            'summary' => false,
            'content' => false,
            'published_at' => false,
            'expired_at' => false,
        ];

        if(authUser(request: $this->request)?->isSuperAdminOrAdmin()) {
            $rules['author_id'] = true;
        }
        return $rules;
    }

    public function show(): array
    {
        return [];
    }

    public function update(): array
    {
        $rules = [
            'status' => true,
            'type' => true,
            'province_id' => false,
            'title' => true,
            'slug' => true,
            'summary' => false,
            'content' => false,
            'published_at' => false,
            'expired_at' => false,
        ];

        if(authUser(request: $this->request)?->isSuperAdminOrAdmin()) {
            $rules['author_id'] = true;
        }
        return $rules;
    }

    public function statusUpdate(): array
    {
        return [
            'status' => true,
        ];
    }

    public function destroy(): array
    {
        return [];
    }

    public function restore(): array
    {
        return [];
    }

    public function trashed(): array
    {
        return [
            'title' => false,
            'slug' => false,
        ];
    }

    public function forceDestroy(): array
    {
        return [];
    }

    public function imageUpdate(): array
    {
        return [
            'image' => true,
        ];
    }

    public function imagesUpdate(): array
    {
        return [
            'images' => true,
            'images.*' => true,
        ];
    }

    public function syncCats(): array
    {
        return [
            'cats_ids' => false,
            'cats_ids.*' => true,
        ];
    }
}

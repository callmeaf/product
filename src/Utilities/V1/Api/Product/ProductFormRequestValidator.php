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
        return [
            'status' => true,
            'type' => true,
            'title' => true,
            'slug' => true,
            'summary' => false,
            'content' => false,
            'published_at' => false,
            'expired_at' => false,
            'cat_ids' => false,
        ];
    }

    public function show(): array
    {
        return [];
    }

    public function update(): array
    {
        return [
            'status' => true,
            'type' => true,
            'title' => true,
            'slug' => true,
            'summary' => false,
            'content' => false,
            'published_at' => false,
            'expired_at' => false,
            'cat_ids' => false,
        ];
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
}

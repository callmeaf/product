<?php

namespace Callmeaf\Product\Utilities\V1\Api\ProductCategory;

use Callmeaf\Base\Utilities\V1\FormRequestValidator;

class ProductCategoryFormRequestValidator extends FormRequestValidator
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
            'parent_id' => false,
            'title' => true,
            'slug' => true,
            'summary' => false,
            'content' => false,
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
            'parent_id' => false,
            'title' => true,
            'slug' => true,
            'summary' => false,
            'content' => false,
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

    public function imagesUpdate(): array
    {
        return [
            'images' => true,
            'images.*' => true,
        ];
    }
}

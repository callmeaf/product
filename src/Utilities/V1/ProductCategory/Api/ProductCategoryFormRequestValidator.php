<?php

namespace Callmeaf\Product\Utilities\V1\ProductCategory\Api;

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
}

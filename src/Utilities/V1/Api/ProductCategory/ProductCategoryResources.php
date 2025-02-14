<?php

namespace Callmeaf\Product\Utilities\V1\Api\ProductCategory;

use Callmeaf\Base\Utilities\V1\Resources;

class ProductCategoryResources extends Resources
{
    public function index(): self
    {
        $this->data = [
            'relations' => [
                'parent'
            ],
            'columns' => [
                'id',
                'parent_id',
                'type',
                'status',
                'title',
                'slug',
                'created_at',
                'updated_at',
            ],
            'attributes' => [
                'id',
                'parent_id',
                'type',
                'type_text',
                'status',
                'status_text',
                'title',
                'slug',
                'created_at_text',
                'updated_at_text',
                'parent',
                '!parent' => [
                    'id',
                    'title'
                ],
            ],
        ];
        return $this;
    }

    public function store(): self
    {
        $this->data = [
            'relations' => [],
            'attributes' => [
                'id',
                'parent_id',
                'type',
                'type_text',
                'status',
                'status_text',
                'title',
                'slug',
                'created_at_text',
                'updated_at_text',
            ],
        ];
        return $this;
    }

    public function show(): self
    {
        $this->data = [
            'relations' => [
                'parent'
            ],
            'attributes' => [
                'id',
                'parent_id',
                'type',
                'type_text',
                'status',
                'status_text',
                'title',
                'slug',
                'summary',
                'content',
                'created_at_text',
                'updated_at_text',
                'image',
                '!image' => [
                    'id',
                    'file_name',
                    'collection_name',
                    'size',
                    'url',
                ],
                'parent',
                '!parent' => [
                    'id',
                    'title'
                ],
            ],
        ];
        return $this;
    }

    public function update(): self
    {
        $this->data = [
            'relations' => [],
            'attributes' => [
                'id',
                'parent_id',
                'type',
                'type_text',
                'status',
                'status_text',
                'title',
                'slug',
                'created_at_text',
                'updated_at_text',
            ],
        ];
        return $this;
    }

    public function statusUpdate(): self
    {
        $this->data = [
            'relations' => [],
            'attributes' => [
                'id',
                'parent_id',
                'type',
                'type_text',
                'status',
                'status_text',
                'title',
                'slug',
                'created_at_text',
                'updated_at_text',
            ],
        ];
        return $this;
    }

    public function destroy(): self
    {
        $this->data = [
            'relations' => [],
            'attributes' => [
                'id',
                'parent_id',
                'type',
                'type_text',
                'status',
                'status_text',
                'title',
                'slug',
                'created_at_text',
                'updated_at_text',
                'deleted_at',
                'deleted_at_text',
            ],
        ];
        return $this;
    }

    public function restore(): Resources
    {
        $this->data = [
            'id_column' => 'id',
            'columns' => [
                'id',
                'parent_id',
                'type',
                'status',
                'title',
                'slug',
                'first_name',
                'last_name',
                'national_code',
                'created_at',
                'updated_at',
            ],
            'relations' => [],
            'attributes' => [
                'id',
                'parent_id',
                'type',
                'type_text',
                'status',
                'status_text',
                'title',
                'slug',
                'created_at_text',
                'updated_at_text',
            ],
        ];
        return $this;
    }

    public function trashed(): Resources
    {
        $this->data = [
            'relations' => [
                'parent'
            ],
            'columns' => [
                'id',
                'parent_id',
                'type',
                'status',
                'title',
                'slug',
                'created_at',
                'updated_at',
                'deleted_at',
            ],
            'attributes' => [
                'id',
                'parent_id',
                'type',
                'type_text',
                'status',
                'status_text',
                'title',
                'slug',
                'created_at_text',
                'updated_at_text',
                'deleted_at',
                'deleted_at_text',
                'parent',
                '!parent' => [
                    'id',
                    'title'
                ],
            ],
        ];
        return $this;
    }

    public function forceDestroy(): Resources
    {
        $this->data = [
            'id_column' => 'id',
            'columns' => [
                'id',
                'title',
            ],
            'relations' => [],
            'attributes' => [
                'id',
            ],
        ];
        return $this;
    }

    public function imageUpdate(): self
    {
        $this->data = [
            'relations' => [],
            'attributes' => [
                'id',
                'parent_id',
                'type',
                'status',
                'title',
                'slug',
                'first_name',
                'last_name',
                'national_code',
                'created_at',
                'updated_at',
                'image',
                '!image' => [
                    'id',
                    'url',
                    'name',
                    'file_name',
                    'collection_name',
                    'mime_type',
                    'disk',
                    'size',
                ],
            ],
        ];
        return $this;
    }
}

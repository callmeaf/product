<?php

namespace Callmeaf\Product\Utilities\V1\Api\Product;

use Callmeaf\Base\Utilities\V1\Resources;

class ProductResources extends Resources
{
    public function index(): self
    {
        $this->data = [
            'relations' => [],
            'columns' => [
                'id',
                'type',
                'status',
                'title',
                'slug',
                'published_at',
                'expired_at',
                'created_at',
                'updated_at',
            ],
            'attributes' => [
                'id',
                'type',
                'type_text',
                'status',
                'status_text',
                'title',
                'slug',
                'published_at_text',
                'expired_at_text',
                'created_at_text',
                'updated_at_text',
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
                'type',
                'type_text',
                'status',
                'status_text',
                'title',
                'slug',
                'published_at_text',
                'expired_at_text',
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
                'author',
                'province',
                'variations',
                'cats',
                'media'
            ],
            'attributes' => [
                'id',
                'author_id',
                'province_id',
                'type',
                'type_text',
                'status',
                'status_text',
                'title',
                'slug',
                'summary',
                'content',
                'published_at_text',
                'expired_at_text',
                'created_at_text',
                'updated_at_text',
                'author',
                '!author' => [
                    'id',
                    'mobile',
                    'full_name',
                ],
                'image',
                '!image' => [
                    'id',
                    'file_name',
                    'collection_name',
                    'size',
                    'url',
                ],
                'images',
                '!images' => [
                    'id',
                    'file_name',
                    'collection_name',
                    'size',
                    'url',
                ],
                'province',
                '!province' => [
                    'id',
                    'name',
                    'slug',
                ],
                'variations',
                '!variations' => [
                    'id',
                    'status',
                    'status_text',
                    'sku',
                    'price',
                    'price_text',
                    'discount_price',
                    'discount_price_text',
                    'stock',
                    'title',
                    'content',
                    'created_at_text',
                    'updated_at_text',
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
                    'type',
                    '!type' => [
                        'id',
                        'status',
                        'status_text',
                        'cat',
                        'cat_text',
                        'title',
                        'content',
                        'created_at_text',
                        'updated_at_text',
                    ],
                ],
                'cats',
                '!cats' => [
                    'id',
                    'title',
                    'slug'
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
                'type',
                'type_text',
                'status',
                'status_text',
                'title',
                'slug',
                'published_at_text',
                'expired_at_text',
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
                'type',
                'type_text',
                'status',
                'status_text',
                'title',
                'slug',
                'published_at_text',
                'expired_at_text',
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
                'type',
                'type_text',
                'status',
                'status_text',
                'title',
                'slug',
                'published_at_text',
                'expired_at_text',
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
                'type',
                'status',
                'title',
                'slug',
                'first_name',
                'last_name',
                'national_code',
                'published_at',
                'expired_at',
                'created_at',
                'updated_at',
            ],
            'relations' => [],
            'attributes' => [
                'id',
                'type',
                'type_text',
                'status',
                'status_text',
                'title',
                'slug',
                'published_at_text',
                'expired_at_text',
                'created_at_text',
                'updated_at_text',
            ],
        ];
        return $this;
    }

    public function trashed(): Resources
    {
        $this->data = [
            'relations' => [],
            'columns' => [
                'id',
                'type',
                'status',
                'title',
                'slug',
                'published_at',
                'expired_at',
                'created_at',
                'updated_at',
                'deleted_at',
            ],
            'attributes' => [
                'id',
                'type',
                'type_text',
                'status',
                'status_text',
                'title',
                'slug',
                'published_at_text',
                'expired_at_text',
                'created_at_text',
                'updated_at_text',
                'deleted_at',
                'deleted_at_text',
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
                'type',
                'type_text',
                'status',
                'status_text',
                'title',
                'slug',
                'published_at_text',
                'expired_at_text',
                'created_at_text',
                'updated_at_text',
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


    public function syncCats(): self
    {
        $this->data = [
            'relations' => [
                'cats'
            ],
            'attributes' => [
                'id',
                'type',
                'type_text',
                'status',
                'status_text',
                'title',
                'slug',
                'published_at_text',
                'expired_at_text',
                'created_at_text',
                'updated_at_text',
                'cats',
                '!cats' => [
                    'id',
                    'title',
                ],
            ],
        ];
        return $this;
    }
}

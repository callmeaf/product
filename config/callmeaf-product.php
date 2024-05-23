<?php

return [
    'model' => \Callmeaf\Product\Models\Product::class,
    'model_resource' => \Callmeaf\Product\Http\Resources\V1\Api\ProductResource::class,
    'model_resource_collection' => \Callmeaf\Product\Http\Resources\V1\Api\ProductCollection::class,
    'service' => \Callmeaf\Product\Services\V1\ProductService::class,
    'default_values' => [
        'status' => \Callmeaf\Product\Enums\ProductStatus::ACTIVE,
        'type' => \Callmeaf\Product\Enums\ProductType::DEFAULT,
    ],
    'events' => [
        \Callmeaf\Product\Events\ProductStored::class => [
            // listeners
        ],
        \Callmeaf\Product\Events\ProductUpdated::class => [
            // listeners
        ],
        \Callmeaf\Product\Events\ProductStatusUpdated::class => [
            // listeners
        ],
        \Callmeaf\Product\Events\ProductDestroyed::class => [
            // listeners
        ],
        \Callmeaf\Product\Events\ProductRestored::class => [
            // listeners
        ],
        \Callmeaf\Product\Events\ProductForceDestroyed::class => [
            // listeners
        ],
    ],
    'validations' => [
        'product' => \Callmeaf\Product\Utilities\V1\Product\Api\ProductFormRequestValidator::class,
    ],
    'resources' => [
        'index' => [
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
        ],
        'store' => [
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
        ],
        'show' => [
            'relations' => [],
            'attributes' => [
                'id',
                'author_id',
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
                'cat_ids',
                'author',
                '!author' => [
                    'id',
                    'mobile'
                ],
            ],
        ],
        'update' => [
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
        ],
        'status_update' => [
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
        ],
        'destroy' => [
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
        ],
        'restore' => [
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
        ],
        'trashed' => [
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
        ],
        'force_destroy' => [
            'id_column' => 'id',
            'columns' => [
                'id',
                'title',
            ],
            'relations' => [],
            'attributes' => [
                'id',
            ],
        ],
    ],
    'controllers' => [
        'products' => \Callmeaf\Product\Http\Controllers\V1\Api\ProductController::class,
    ],
    'form_request_authorizers' => [
        'product' => \Callmeaf\Product\Utilities\V1\Product\Api\ProductFormRequestAuthorizer::class,
    ],
    'middlewares' => [
        'product' => \Callmeaf\Product\Utilities\V1\Product\Api\ProductControllerMiddleware::class,
    ],
    'searcher' => \Callmeaf\Product\Utilities\V1\Product\Api\ProductSearcher::class,
];

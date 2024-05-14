<?php

return [
    'model' => \Callmeaf\Product\Models\ProductCategory::class,
    'model_resource' => \Callmeaf\Product\Http\Resources\V1\Api\ProductCategoryResource::class,
    'model_resource_collection' => \Callmeaf\Product\Http\Resources\V1\Api\ProductCategoryCollection::class,
    'service' => \Callmeaf\Product\Services\V1\ProductCategoryService::class,
    'default_values' => [
        'status' => \Callmeaf\Product\Enums\ProductCategoryStatus::ACTIVE,
        'type' => \Callmeaf\Product\Enums\ProductCategoryType::DEFAULT,
    ],
    'events' => [
        \Callmeaf\Product\Events\ProductCategoryStored::class => [
            // listeners
        ],
        \Callmeaf\Product\Events\ProductCategoryUpdated::class => [
            // listeners
        ],
        \Callmeaf\Product\Events\ProductCategoryStatusUpdated::class => [
            // listeners
        ],
        \Callmeaf\Product\Events\ProductCategoryDestroyed::class => [
            // listeners
        ],
        \Callmeaf\Product\Events\ProductCategoryRestored::class => [
            // listeners
        ],
        \Callmeaf\Product\Events\ProductCategoryForceDestroyed::class => [
            // listeners
        ],
    ],
    'validations' => [
        'index' => [
            'title' => false,
            'slug' => false,
        ],
        'store' => [
            'status' => true,
            'type' => true,
            'title' => true,
            'slug' => true,
            'summary' => false,
            'content' => false,
            'published_at' => false,
            'expired_at' => false,
        ],
        'show' => [

        ],
        'update' => [
            'status' => true,
            'type' => true,
            'title' => true,
            'slug' => true,
            'summary' => false,
            'content' => false,
            'published_at' => false,
            'expired_at' => false,
        ],
        'status_update' => [
            'status' => true,
        ],
        'destroy' => [
            //
        ],
        'restore' => [
            //
        ],
        'trashed' => [
            //
        ],
        'force_destroy' => [
            //
        ],
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
        'users' => \Callmeaf\Product\Http\Controllers\V1\Api\ProductCategoryController::class,
    ],
    'form_request_authorizers' => [
        'product_category' => \Callmeaf\Product\Utilities\V1\ProductCategoryFormRequestAuthorizer::class,
    ],
    'middlewares' => [
        'global' => [],
    ],
    'searcher' => \Callmeaf\Product\Utilities\V1\ProductCategorySearcher::class,
];

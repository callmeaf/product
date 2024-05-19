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
        'product_category' => \Callmeaf\Product\Utilities\V1\ProductCategory\Api\ProductCategoryFormRequestValidator::class,
    ],
    'resources' => [
        'index' => [
            'relations' => [],
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
            ],
        ],
        'store' => [
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
        ],
        'show' => [
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
                'summary',
                'content',
                'created_at_text',
                'updated_at_text',
            ],
        ],
        'update' => [
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
        ],
        'status_update' => [
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
        ],
        'destroy' => [
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
        ],
        'restore' => [
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
        ],
        'trashed' => [
            'relations' => [],
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
        'product_categories' => \Callmeaf\Product\Http\Controllers\V1\Api\ProductCategoryController::class,
    ],
    'form_request_authorizers' => [
        'product_category' => \Callmeaf\Product\Utilities\V1\ProductCategory\Api\ProductCategoryFormRequestAuthorizer::class,
    ],
    'middlewares' => [
        'product_category' => \Callmeaf\Product\Utilities\V1\ProductCategory\Api\ProductCategoryControllerMiddleware::class,
    ],
    'searcher' => \Callmeaf\Product\Utilities\V1\ProductCategory\Api\ProductCategorySearcher::class,
];

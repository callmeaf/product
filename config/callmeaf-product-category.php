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
            \Callmeaf\Product\Listeners\ChangeProductsCategoriesToDefault::class,
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
        'product_category' => \Callmeaf\Product\Utilities\V1\ProductCategory\Api\ProductCategoryResources::class,
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
    'seeders' => [
        \Callmeaf\Product\Seeders\ProductCategorySeeder::class,
    ],
];

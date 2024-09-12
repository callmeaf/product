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
        'product' => \Callmeaf\Product\Utilities\V1\Product\Api\ProductResources::class,
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

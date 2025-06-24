<?php

use Callmeaf\Base\App\Enums\RequestType;

return [
    'model' => \Callmeaf\Product\App\Models\Product::class,
    'route_key_name' => 'slug',
    'repo' => \Callmeaf\Product\App\Repo\V1\ProductRepo::class,
    'resources' => [
        RequestType::API->value => [
            'resource' => \Callmeaf\Product\App\Http\Resources\Api\V1\ProductResource::class,
            'resource_collection' => \Callmeaf\Product\App\Http\Resources\Api\V1\ProductCollection::class,
        ],
        RequestType::WEB->value => [
            'resource' => \Callmeaf\Product\App\Http\Resources\Web\V1\ProductResource::class,
            'resource_collection' => \Callmeaf\Product\App\Http\Resources\Web\V1\ProductCollection::class,
        ],
        RequestType::ADMIN->value => [
            'resource' => \Callmeaf\Product\App\Http\Resources\Admin\V1\ProductResource::class,
            'resource_collection' => \Callmeaf\Product\App\Http\Resources\Admin\V1\ProductCollection::class,
        ],
    ],
    'events' => [
        RequestType::API->value => [
            \Callmeaf\Product\App\Events\Api\V1\ProductIndexed::class => [
                // listeners
            ],
            \Callmeaf\Product\App\Events\Api\V1\ProductCreated::class => [
                // listeners
            ],
            \Callmeaf\Product\App\Events\Api\V1\ProductShowed::class => [
                // listeners
            ],
            \Callmeaf\Product\App\Events\Api\V1\ProductUpdated::class => [
                // listeners
            ],
            \Callmeaf\Product\App\Events\Api\V1\ProductDeleted::class => [
                // listeners
            ],
            \Callmeaf\Product\App\Events\Api\V1\ProductStatusUpdated::class => [
                // listeners
            ],
            \Callmeaf\Product\App\Events\Api\V1\ProductTypeUpdated::class => [
                // listeners
            ],
        ],
        RequestType::WEB->value => [
            \Callmeaf\Product\App\Events\Web\V1\ProductIndexed::class => [
                // listeners
            ],
            \Callmeaf\Product\App\Events\Web\V1\ProductCreated::class => [
                // listeners
            ],
            \Callmeaf\Product\App\Events\Web\V1\ProductShowed::class => [
                // listeners
            ],
            \Callmeaf\Product\App\Events\Web\V1\ProductUpdated::class => [
                // listeners
            ],
            \Callmeaf\Product\App\Events\Web\V1\ProductDeleted::class => [
                // listeners
            ],
            \Callmeaf\Product\App\Events\Web\V1\ProductStatusUpdated::class => [
                // listeners
            ],
            \Callmeaf\Product\App\Events\Web\V1\ProductTypeUpdated::class => [
                // listeners
            ],
        ],
        RequestType::ADMIN->value => [
            \Callmeaf\Product\App\Events\Admin\V1\ProductIndexed::class => [
                // listeners
            ],
            \Callmeaf\Product\App\Events\Admin\V1\ProductCreated::class => [
                // listeners
            ],
            \Callmeaf\Product\App\Events\Admin\V1\ProductShowed::class => [
                // listeners
            ],
            \Callmeaf\Product\App\Events\Admin\V1\ProductUpdated::class => [
                // listeners
            ],
            \Callmeaf\Product\App\Events\Admin\V1\ProductDeleted::class => [
                // listeners
            ],
            \Callmeaf\Product\App\Events\Admin\V1\ProductStatusUpdated::class => [
                // listeners
            ],
            \Callmeaf\Product\App\Events\Admin\V1\ProductTypeUpdated::class => [
                // listeners
            ],
            \Callmeaf\Product\App\Events\Admin\V1\ProductSyncedCategories::class => [
                // listeners
            ],
        ],
    ],
    'requests' => [
        RequestType::API->value => [
            'index' => \Callmeaf\Product\App\Http\Requests\Api\V1\ProductIndexRequest::class,
            'store' => \Callmeaf\Product\App\Http\Requests\Api\V1\ProductStoreRequest::class,
            'show' => \Callmeaf\Product\App\Http\Requests\Api\V1\ProductShowRequest::class,
            'update' => \Callmeaf\Product\App\Http\Requests\Api\V1\ProductUpdateRequest::class,
            'destroy' => \Callmeaf\Product\App\Http\Requests\Api\V1\ProductDestroyRequest::class,
            'statusUpdate' => \Callmeaf\Product\App\Http\Requests\Api\V1\ProductStatusUpdateRequest::class,
            'typeUpdate' => \Callmeaf\Product\App\Http\Requests\Api\V1\ProductTypeUpdateRequest::class,
        ],
        RequestType::WEB->value => [
            'index' => \Callmeaf\Product\App\Http\Requests\Web\V1\ProductIndexRequest::class,
            'create' => \Callmeaf\Product\App\Http\Requests\Web\V1\ProductCreateRequest::class,
            'store' => \Callmeaf\Product\App\Http\Requests\Web\V1\ProductStoreRequest::class,
            'show' => \Callmeaf\Product\App\Http\Requests\Web\V1\ProductShowRequest::class,
            'edit' => \Callmeaf\Product\App\Http\Requests\Web\V1\ProductEditRequest::class,
            'update' => \Callmeaf\Product\App\Http\Requests\Web\V1\ProductUpdateRequest::class,
            'destroy' => \Callmeaf\Product\App\Http\Requests\Web\V1\ProductDestroyRequest::class,
            'statusUpdate' => \Callmeaf\Product\App\Http\Requests\Web\V1\ProductStatusUpdateRequest::class,
            'typeUpdate' => \Callmeaf\Product\App\Http\Requests\Web\V1\ProductTypeUpdateRequest::class,
        ],
        RequestType::ADMIN->value => [
            'index' => \Callmeaf\Product\App\Http\Requests\Admin\V1\ProductIndexRequest::class,
            'store' => \Callmeaf\Product\App\Http\Requests\Admin\V1\ProductStoreRequest::class,
            'show' => \Callmeaf\Product\App\Http\Requests\Admin\V1\ProductShowRequest::class,
            'update' => \Callmeaf\Product\App\Http\Requests\Admin\V1\ProductUpdateRequest::class,
            'destroy' => \Callmeaf\Product\App\Http\Requests\Admin\V1\ProductDestroyRequest::class,
            'statusUpdate' => \Callmeaf\Product\App\Http\Requests\Admin\V1\ProductStatusUpdateRequest::class,
            'typeUpdate' => \Callmeaf\Product\App\Http\Requests\Admin\V1\ProductTypeUpdateRequest::class,
        ],
    ],
    'controllers' => [
        RequestType::API->value => [
            'product' => \Callmeaf\Product\App\Http\Controllers\Api\V1\ProductController::class,
        ],
        RequestType::WEB->value => [
            'product' => \Callmeaf\Product\App\Http\Controllers\Web\V1\ProductController::class,
        ],
        RequestType::ADMIN->value => [
            'product' => \Callmeaf\Product\App\Http\Controllers\Admin\V1\ProductController::class,
        ],
    ],
    'routes' => [
        RequestType::API->value => [
            'prefix' => 'products',
            'as' => 'products.',
            'middleware' => [],
        ],
        RequestType::WEB->value => [
            'prefix' => 'products',
            'as' => 'products.',
            'middleware' => [
                "route_status:" . \Symfony\Component\HttpFoundation\Response::HTTP_NOT_FOUND
            ],
        ],
        RequestType::ADMIN->value => [
            'prefix' => 'products',
            'as' => 'products.',
            'middleware' => [
                'auth:sanctum',
                "role:" . \Callmeaf\Role\App\Enums\RoleName::SUPER_ADMIN->value,
            ],
        ],
    ],
    'enums' => [
         'status' => \Callmeaf\Product\App\Enums\ProductStatus::class,
         'type' => \Callmeaf\Product\App\Enums\ProductType::class,
    ],
     'exports' => [
        RequestType::API->value => [
            'excel' => \Callmeaf\Product\App\Exports\Api\V1\ProductsExport::class,
        ],
        RequestType::WEB->value => [
            'excel' => \Callmeaf\Product\App\Exports\Web\V1\ProductsExport::class,
        ],
        RequestType::ADMIN->value => [
            'excel' => \Callmeaf\Product\App\Exports\Admin\V1\ProductsExport::class,
        ],
     ],
     'imports' => [
         RequestType::API->value => [
             'excel' => \Callmeaf\Product\App\Imports\Api\V1\ProductsImport::class,
         ],
         RequestType::WEB->value => [
             'excel' => \Callmeaf\Product\App\Imports\Web\V1\ProductsImport::class,
         ],
         RequestType::ADMIN->value => [
             'excel' => \Callmeaf\Product\App\Imports\Admin\V1\ProductsImport::class,
         ],
     ],
];

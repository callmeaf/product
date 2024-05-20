<?php

use Callmeaf\Product\Enums\ProductCategoryStatus;
use Callmeaf\Product\Enums\ProductCategoryType;
use Callmeaf\Product\Enums\ProductStatus;
use Callmeaf\Product\Enums\ProductType;

return [
    ProductCategoryStatus::class => [
        ProductCategoryStatus::ACTIVE->name => 'Active',
        ProductCategoryStatus::INACTIVE->name => 'InActive',
    ],
    ProductCategoryType::class => [
        ProductCategoryType::DEFAULT->name => 'Default',
        ProductCategoryType::PACKAGE->name => 'Package',
    ],
    ProductStatus::class => [
        ProductStatus::ACTIVE->name => 'Active',
        ProductStatus::INACTIVE->name => 'InActive',
    ],
    ProductType::class => [
        ProductType::DEFAULT->name => 'Default',
    ],
];

<?php

use Callmeaf\Product\Enums\ProductCategoryStatus;
use Callmeaf\Product\Enums\ProductCategoryType;
use Callmeaf\Product\Enums\ProductStatus;
use Callmeaf\Product\Enums\ProductType;

return [
    ProductCategoryStatus::class => [
        ProductCategoryStatus::ACTIVE->name => 'فعال',
        ProductCategoryStatus::INACTIVE->name => 'غیرفعال',
    ],
    ProductCategoryType::class => [
        ProductCategoryType::DEFAULT->name => 'پیش فرض',
        ProductCategoryType::PACKAGE->name => 'پکیج'
    ],
    ProductStatus::class => [
        ProductStatus::ACTIVE->name => 'فعال',
        ProductStatus::INACTIVE->name => 'غیرفعال',
    ],
    ProductType::class => [
        ProductCategoryType::DEFAULT->name => 'پیش فرض',
    ],
];

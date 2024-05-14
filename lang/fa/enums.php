<?php

use Callmeaf\Product\Enums\ProductCategoryStatus;
use Callmeaf\Product\Enums\ProductCategoryType;

return [
    ProductCategoryStatus::class => [
        ProductCategoryStatus::ACTIVE->name => 'فعال',
        ProductCategoryStatus::INACTIVE->name => 'غیرفعال',
    ],
    ProductCategoryType::class => [
        ProductCategoryType::DEFAULT->name => 'پیش فرض',
    ],
];

<?php

use Callmeaf\Product\Enums\ProductCategoryStatus;
use Callmeaf\Product\Enums\ProductCategoryType;

return [
    ProductCategoryStatus::class => [
        ProductCategoryStatus::ACTIVE->name => 'Active',
        ProductCategoryStatus::INACTIVE->name => 'InActive',
    ],
    ProductCategoryType::class => [
        ProductCategoryType::DEFAULT->name => 'Default',
    ],
];

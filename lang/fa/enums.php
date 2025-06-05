<?php

use Callmeaf\Product\App\Enums\ProductStatus;
use Callmeaf\Product\App\Enums\ProductType;

return [
    ProductStatus::class => [
        ProductStatus::PUBLISHED->name => 'منتشر شده',
        ProductStatus::SCHEDULED->name => 'در انتظار انتشار',
        ProductStatus::DRAFT->name => 'پیش نویس',
        ProductStatus::PENDING_REVIEW->name => 'در انتظار بازبینی',
        ProductStatus::REJECTED->name => 'رد شده',
    ],
    ProductType::class => [
        ProductType::PRODUCT->name => 'محصول',
        ProductType::PACKAGE->name => 'پکیج',
    ],
];

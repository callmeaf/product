<?php

use Callmeaf\Product\App\Enums\ProductDeliveryType;
use Callmeaf\Product\App\Enums\ProductStatus;
use Callmeaf\Product\App\Enums\ProductType;

return [
    ProductStatus::class => [
        ProductStatus::PUBLISHED->name => 'Published',
        ProductStatus::SCHEDULED->name => 'Scheduled',
        ProductStatus::DRAFT->name => 'Draft',
        ProductStatus::PENDING_REVIEW->name => 'Pending Review',
        ProductStatus::REJECTED->name => 'Rejected',
    ],
    ProductType::class => [
        ProductType::PRODUCT->name => 'Product',
        ProductType::PACKAGE->name => 'Package',
    ],
    ProductDeliveryType::class => [
        ProductDeliveryType::PHYSICAL->name => 'Physical',
        ProductDeliveryType::DIGITAL->name => 'Digital',
    ],
];

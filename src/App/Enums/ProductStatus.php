<?php

namespace Callmeaf\Product\App\Enums;

enum ProductStatus: string
{
    case PUBLISHED = 'published';
    case SCHEDULED = 'scheduled';
    case DRAFT = 'draft';
    case PENDING_REVIEW = 'pending_review';
    case REJECTED = 'rejected';
}

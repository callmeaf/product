<?php

namespace Callmeaf\Product\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class ProductCategoryDefaultTypesCanNotDeleteException extends Exception
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message ?: __('callmeaf-product::v1.errors.product_category_default_types_can_not_delete'), $code ?: Response::HTTP_FORBIDDEN, $previous);
    }
}


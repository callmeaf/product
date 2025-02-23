<?php

namespace Callmeaf\Product\Utilities\V1\Api\Product;

use Callmeaf\Base\Http\Controllers\BaseController;
use Callmeaf\Base\Utilities\V1\ControllerMiddleware;
use Illuminate\Routing\Controllers\Middleware;


class ProductControllerMiddleware extends ControllerMiddleware
{
    public function __invoke(): array
    {
        return [
            new Middleware(middleware: 'auth:sanctum',except: [
                'index'
            ])
        ];
    }
}

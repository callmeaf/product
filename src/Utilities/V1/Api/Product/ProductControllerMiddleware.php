<?php

namespace Callmeaf\Product\Utilities\V1\Product\Api;

use Callmeaf\Base\Http\Controllers\BaseController;
use Callmeaf\Base\Utilities\V1\ControllerMiddleware;


class ProductControllerMiddleware extends ControllerMiddleware
{
    public function __invoke(BaseController $controller): void
    {
        $controller->middleware('auth:sanctum')->except(['index']);
    }
}

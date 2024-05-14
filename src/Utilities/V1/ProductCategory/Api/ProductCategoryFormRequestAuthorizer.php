<?php

namespace Callmeaf\Product\Utilities\V1\ProductCategory\Api;

use Callmeaf\Base\Utilities\V1\FormRequestAuthorizer;
use Callmeaf\Permission\Enums\PermissionName;

class ProductCategoryFormRequestAuthorizer extends FormRequestAuthorizer
{
    public function index(): bool
    {
        return true;
    }

    public function create(): bool
    {
        return userCan(PermissionName::PRODUCT_CATEGORY_STORE);
    }

    public function store(): bool
    {
        return userCan(PermissionName::PRODUCT_CATEGORY_STORE);
    }

    public function show(): bool
    {
        return userCan(PermissionName::PRODUCT_CATEGORY_SHOW);
    }

    public function edit(): bool
    {
        return userCan(PermissionName::PRODUCT_CATEGORY_UPDATE);
    }

    public function update(): bool
    {
        return userCan(PermissionName::PRODUCT_CATEGORY_UPDATE);
    }

    public function statusUpdate(): bool
    {
        return userCan(PermissionName::PRODUCT_CATEGORY_UPDATE);
    }

    public function destroy(): bool
    {
        return userCan(PermissionName::PRODUCT_CATEGORY_DESTROY);
    }

    public function trashed(): bool
    {
        return userCan(PermissionName::PRODUCT_CATEGORY_TRASHED);
    }

    public function restore(): bool
    {
        return userCan(PermissionName::PRODUCT_CATEGORY_RESTORE);
    }

    public function forceDestroy(): bool
    {
        return userCan(PermissionName::PRODUCT_CATEGORY_FORCE_DESTROY);
    }
}

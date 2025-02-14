<?php

namespace Callmeaf\Product\Utilities\V1\Api\Product;

use Callmeaf\Base\Utilities\V1\FormRequestAuthorizer;
use Callmeaf\Permission\Enums\PermissionName;

class ProductFormRequestAuthorizer extends FormRequestAuthorizer
{
    public function index(): bool
    {
        return true;
    }

    public function create(): bool
    {
        return userCan(PermissionName::PRODUCT_STORE);
    }

    public function store(): bool
    {
        return userCan(PermissionName::PRODUCT_STORE);
    }

    public function show(): bool
    {
        return userCan(PermissionName::PRODUCT_SHOW);
    }

    public function edit(): bool
    {
        return userCan(PermissionName::PRODUCT_UPDATE);
    }

    public function update(): bool
    {
        return userCan(PermissionName::PRODUCT_UPDATE);
    }

    public function statusUpdate(): bool
    {
        return userCan(PermissionName::PRODUCT_UPDATE);
    }

    public function destroy(): bool
    {
        return userCan(PermissionName::PRODUCT_DESTROY);
    }

    public function trashed(): bool
    {
        return userCan(PermissionName::PRODUCT_TRASHED);
    }

    public function restore(): bool
    {
        return userCan(PermissionName::PRODUCT_RESTORE);
    }

    public function forceDestroy(): bool
    {
        return userCan(PermissionName::PRODUCT_FORCE_DESTROY);
    }

    public function imageUpdate(): bool
    {
        return userCan(PermissionName::PRODUCT_STORE);
    }

    public function syncCats(): bool
    {
        return userCan(PermissionName::PRODUCT_STORE);
    }
}

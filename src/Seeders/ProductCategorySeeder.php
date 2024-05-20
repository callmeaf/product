<?php

namespace Callmeaf\Product\Seeders;

use Callmeaf\Permission\Enums\PermissionName;
use Callmeaf\Permission\Services\V1\PermissionService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * @var PermissionService $productCategoryService
         */
        $productCategoryService = app(config('callmeaf-product-category.service'));
        $productCategoryService->freshQuery()->create([
            'locale' => 'en',
            'title' => 'Default',
            'slug' => 'en_default',
        ]);
        $productCategoryService->freshQuery()->create([
            'locale' => 'fa',
            'title' => 'پیش فرض',
            'slug' => 'fa_default',
        ]);
    }
}

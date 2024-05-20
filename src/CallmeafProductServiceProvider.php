<?php

namespace Callmeaf\Product;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class CallmeafProductServiceProvider extends ServiceProvider
{
    private const CONFIGS_DIR = __DIR__ . '/../config';
    private const CONFIGS_KEY = 'callmeaf-product';
    private const CONFIGS_GROUP = 'callmeaf-product-config';
    private const PRODUCT_CATEGORY_CONFIGS_DIR = __DIR__ . '/../config';
    private const PRODUCT_CATEGORY_CONFIGS_KEY = 'callmeaf-product-category';
    private const PRODUCT_CATEGORY_CONFIGS_GROUP = 'callmeaf-product-category-config';
    private const ROUTES_DIR = __DIR__ . '/../routes';
    private const DATABASE_DIR = __DIR__ . '/../database';
    private const DATABASE_GROUPS = 'callmeaf-product-migrations';
    private const RESOURCES_DIR = __DIR__ . '/../resources';
    private const VIEWS_NAMESPACE = 'callmeaf-product';
    private const VIEWS_GROUP = 'callmeaf-product-views';
    private const LANG_DIR = __DIR__ . '/../lang';
    private const LANG_NAMESPACE = 'callmeaf-product';
    private const LANG_GROUP = 'callmeaf-product-lang';
    public function boot()
    {
        $this->registerConfig();
        $this->registerRoute();
        $this->registerMigration();
        $this->registerEvents();
        $this->registerViews();
        $this->registerLang();
        $this->registerSeeders();
    }

    private function registerConfig()
    {
        $this->mergeConfigFrom(self::CONFIGS_DIR . '/callmeaf-product.php',self::CONFIGS_KEY);
        $this->publishes([
            self::CONFIGS_DIR . '/callmeaf-product.php' => config_path('callmeaf-product.php'),
        ],self::CONFIGS_GROUP);

        $this->mergeConfigFrom(self::CONFIGS_DIR . '/callmeaf-product-category.php',self::PRODUCT_CATEGORY_CONFIGS_KEY);
        $this->publishes([
            self::PRODUCT_CATEGORY_CONFIGS_DIR . '/callmeaf-product-category.php' => config_path('callmeaf-product-category.php'),
        ],self::PRODUCT_CATEGORY_CONFIGS_GROUP);
    }

    private function registerRoute(): void
    {
        $this->loadRoutesFrom(self::ROUTES_DIR . '/v1/api.php');
    }

    private function registerMigration(): void
    {
        $this->loadMigrationsFrom(self::DATABASE_DIR . '/migrations');
        $this->publishes([
            self::DATABASE_DIR . '/migrations' => database_path('migrations'),
        ],self::DATABASE_GROUPS);
    }

    private function registerEvents(): void
    {
        foreach (config('callmeaf-product.events') as $event => $listeners) {
            Event::listen($event,function($event) use ($listeners) {
                foreach($listeners as $listener) {
                    app($listener)->handle($event);
                }
            });
        }

        foreach (config('callmeaf-product-category.events') as $event => $listeners) {
            Event::listen($event,function($event) use ($listeners) {
                foreach($listeners as $listener) {
                    app($listener)->handle($event);
                }
            });
        }
    }

    private function registerViews(): void
    {
        $this->loadViewsFrom(self::RESOURCES_DIR . '/views',self::VIEWS_NAMESPACE);
        $this->publishes([
            self::RESOURCES_DIR . '/views' => resource_path('views/vendor/callmeaf-product'),
        ],self::VIEWS_GROUP);

    }

    private function registerLang(): void
    {
        $langPathFromVendor = lang_path('vendor/callmeaf/product');
        if(is_dir($langPathFromVendor)) {
            $this->loadTranslationsFrom($langPathFromVendor,self::LANG_NAMESPACE);
        } else {
            $this->loadTranslationsFrom(self::LANG_DIR,self::LANG_NAMESPACE);
        }
        $this->publishes([
            self::LANG_DIR => $langPathFromVendor,
        ],self::LANG_GROUP);
    }

    private function registerSeeders(): void
    {
        $this->callAfterResolving(DatabaseSeeder::class,function ($seeder) {
            $seeder->callOnce(config('callmeaf-product-category.seeders'));
        });
    }
}

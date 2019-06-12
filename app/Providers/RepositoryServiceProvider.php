<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\Product\ProductRepositoryInterface',
            'App\Repositories\Product\ProductRepository'
        );

        $this->app->bind(
            'App\Repositories\Category\CategoryRepositoryInterface',
            'App\Repositories\Category\CategoryRepository'
        );

        $this->app->bind(
            'App\Repositories\ProductCategory\ProductCategoryRepositoryInterface',
            'App\Repositories\ProductCategory\ProductCategoryRepository'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

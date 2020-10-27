<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            \App\Repositories\Products\ProductRepositoryInterface::class,
            \App\Repositories\Products\ProductRepository::class,
            \App\Repositories\Categories\CategoryRepositoryInterface::class,
            \App\Repositories\Categories\CategoryRepository::class,
            \App\Repositories\Products\ProductCategoryRepository::class,
            \App\Repositories\Products\ProductCategoryRepositoryInterface::class,
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

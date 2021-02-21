<?php

namespace App\Providers;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Observers\Blog\BlogCategoryObserver;
use App\Observers\Blog\BlogPostObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        /**
         * Регистрируем наблюдателей
         */
        BlogPost::observe(BlogPostObserver::class);
        BlogCategory::observe(BlogCategoryObserver::class);
    }
}

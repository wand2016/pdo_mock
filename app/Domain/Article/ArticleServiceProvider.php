<?php

namespace App\Domain\Article;

use App\Domain\Article\ArticleRepository;
use App\Domain\Article\ArticleRepositoryInterface;
use Illuminate\Support\ServiceProvider;

/**
 * 記事に関する抽象と具象のバインディング等を行う
 */
class ArticleServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            ArticleRepositoryInterface::class,
            ArticleRepository::class
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

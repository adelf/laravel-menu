<?php

namespace Adelf\LaravelMenu;

use Adelf\LaravelMenu\Filters\TwoLevelAuthFilter;
use Adelf\LaravelMenu\ItemProcessors\ActiveMenuItemProcessor;
use Adelf\LaravelMenu\ItemProcessors\LaravelMenuItemProcessor;
use Adelf\LaravelMenu\Renders\BladeRender;
use Illuminate\Support\ServiceProvider;

final class LaravelMenuServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../resources/menu/default.php' => resource_path('menu/default.php'),
            __DIR__ . '/../resources/views/menu/menu.blade.php' => resource_path('views/menu/menu.blade.php'),
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $processor = $this->app->make('config')->get('laravel-menu.processor', ActiveMenuItemProcessor::class);

        if($processor)
        {
            $this->app->bind(LaravelMenuItemProcessor::class, $processor);
        }

        $this->app->singleton(LaravelMenu::class);
        $this->app->singleton(ActiveMenuItemProcessor::class);

        LaravelMenuFilterFactory::addFilter('two-level', TwoLevelAuthFilter::class);

        LaravelMenuRenderFactory::addRenderer('blade', BladeRender::class);
    }
}
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
        if (function_exists('resource_path'))
        {
            $menuPath = resource_path('menu/default.php');
            $templatePath = resource_path('views/menu/menu.blade.php');
        }
        else
        {
            $menuPath = base_path('resources/menu/default.php');
            $templatePath = base_path('resources/views/menu/menu.blade.php');
        }

        $this->publishes([
            __DIR__ . '/../resources/menu/default.php' => $menuPath,
            __DIR__ . '/../resources/views/menu/menu.blade.php' => $templatePath,
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

        if ($processor)
        {
            $this->app->bind(LaravelMenuItemProcessor::class, $processor);
        }

        $this->app->singleton(LaravelMenu::class);
        $this->app->singleton(ActiveMenuItemProcessor::class);

        LaravelMenuFilterFactory::addFilter('two-level', TwoLevelAuthFilter::class);

        LaravelMenuRenderFactory::addRender('blade', BladeRender::class);
    }
}
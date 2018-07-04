<?php

namespace Adelf\LaravelMenu;

use Adelf\LaravelMenu\Renders\LaravelMenuRender;

final class LaravelMenuRenderFactory
{
    /**
     * @var array
     */
    private static $filters = [];

    /**
     * @param string $name
     * @param string | LaravelMenuRender $renderer class name or object - LaravelMenuRenderer instance
     */
    public static function addRenderer(string $name, $renderer)
    {
        self::$filters[$name] = $renderer;
    }

    /**
     * @param string $name
     * @return LaravelMenuRender
     */
    public function create(string $name): LaravelMenuRender
    {
        return app(self::$filters[$name]);
    }
}
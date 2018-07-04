<?php

namespace Adelf\LaravelMenu;

use Adelf\LaravelMenu\Filters\LaravelMenuFilter;

final class LaravelMenuFilterFactory
{
    /**
     * @var array
     */
    private static $filters = [];

    /**
     * @param string $name
     * @param string | LaravelMenuFilter $filter class name or object - LaravelMenuFilter instance
     */
    public static function addFilter(string $name, $filter)
    {
        self::$filters[$name] = $filter;
    }

    /**
     * @param string $name
     * @return LaravelMenuFilter
     */
    public function create(string $name): LaravelMenuFilter
    {
        return app(self::$filters[$name]);
    }
}
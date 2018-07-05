<?php

namespace Adelf\LaravelMenu;

class Facade extends \Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor()
    {
        return LaravelMenu::class;
    }
}
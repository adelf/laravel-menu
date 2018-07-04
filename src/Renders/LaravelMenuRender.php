<?php

namespace Adelf\LaravelMenu\Renders;

use Adelf\LaravelMenu\FilteredMenu;

interface LaravelMenuRender
{
    public function render(FilteredMenu $result): string;
}
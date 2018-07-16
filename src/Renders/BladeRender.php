<?php

namespace Adelf\LaravelMenu\Renders;

use Adelf\LaravelMenu\FilteredMenu;

final class BladeRender implements LaravelMenuRender
{
    /**
     * @param FilteredMenu $result
     * @return string
     * @throws \Throwable
     */
    public function render(FilteredMenu $result): string
    {
        return view(array_get($result->getMenuConfig(), 'template', 'menu.menu'), [
            'items' => $result->getFilteredItems()
        ])->render();
    }
}
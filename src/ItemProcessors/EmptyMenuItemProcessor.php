<?php

namespace Adelf\LaravelMenu\ItemProcessors;

final class EmptyMenuItemProcessor implements LaravelMenuItemProcessor
{
    public function process($item)
    {
        return $item;
    }
}
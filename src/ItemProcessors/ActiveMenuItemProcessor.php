<?php

namespace Adelf\LaravelMenu\ItemProcessors;

final class ActiveMenuItemProcessor implements LaravelMenuItemProcessor
{
    /**
     * @var array
     */
    private $lastActiveItem = [];

    public function process($item)
    {
        if (array_key_exists('active', $item))
        {
            $item['active'] = $item['active']();
        }
        else
        {
            $item['active'] = false;
        }

        if($item['active'])
        {
            $this->lastActiveItem = $item;
        }

        return $item;
    }

    /**
     * @return array
     */
    public function getLastActiveItem(): array
    {
        return $this->lastActiveItem;
    }
}
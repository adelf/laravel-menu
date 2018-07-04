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

            if($item['active'])
            {
                $this->lastActiveItem = $item;
            }
        }
        else
        {
            $item['active'] = false;

            if(array_key_exists('items', $item) && $this->lastActiveItem !== null)
            {
                $item['activeParent'] = array_search($this->lastActiveItem, $item['items']) !== false;
            }
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
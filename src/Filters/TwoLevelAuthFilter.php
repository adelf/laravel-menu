<?php

namespace Adelf\LaravelMenu\Filters;

use Adelf\LaravelMenu\ItemProcessors\LaravelMenuItemProcessor;

final class TwoLevelAuthFilter implements LaravelMenuFilter
{
    /**
     * @var LaravelMenuItemProcessor
     */
    private $itemProcessor;

    public function __construct(LaravelMenuItemProcessor $itemProcessor)
    {
        $this->itemProcessor = $itemProcessor;
    }

    public function filter(array $items): array
    {
        $res = [];

        foreach($items as $item)
        {
            if(!array_key_exists('auth', $item) || $item['auth']() === true)
            {
                if(array_key_exists('items', $item))
                {
                    $newItems = [];
                    foreach($item['items'] as $subItem)
                    {
                        if(!array_key_exists('auth', $subItem) || $subItem['auth']() === true)
                        {
                            $newItems[] = $this->itemProcessor->process($subItem);
                        }
                    }

                    if(count($newItems) > 0)
                    {
                        $item['items'] = $newItems;
                        $res[] = $this->itemProcessor->process($item);
                    }
                }
                else
                {
                    $res[] = $this->itemProcessor->process($item);
                }
            }
        }

        return $res;
    }
}
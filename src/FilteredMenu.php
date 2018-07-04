<?php

namespace Adelf\LaravelMenu;

final class FilteredMenu
{
    /**
     * @var array
     */
    private $filteredItems;

    /**
     * @var array
     */
    private $menuConfig;

    /**
     * @var array|null
     */
    private $lastActiveItem;

    public function __construct(array $filteredItems, array $menuConfig, $lastActiveItem)
    {
        $this->filteredItems = $filteredItems;
        $this->menuConfig = $menuConfig;
        $this->lastActiveItem = $lastActiveItem;
    }

    /**
     * @return array
     */
    public function getFilteredItems(): array
    {
        return $this->filteredItems;
    }

    /**
     * @return array
     */
    public function getMenuConfig(): array
    {
        return $this->menuConfig;
    }

    /**
     * @return array|null
     */
    public function getLastActiveItem()
    {
        return $this->lastActiveItem;
    }
}
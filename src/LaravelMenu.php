<?php

namespace Adelf\LaravelMenu;

use Adelf\LaravelMenu\ItemProcessors\ActiveMenuItemProcessor;

final class LaravelMenu
{
    /**
     * @var LaravelMenuFilterFactory
     */
    private $filterFactory;

    /**
     * @var LaravelMenuRenderFactory
     */
    private $renderFactory;

    /**
     * @var ActiveMenuItemProcessor
     */
    private $activeMenuItemProcessor;

    /**
     * @var FilteredMenu[]
     */
    private $filterResults = [];

    public function __construct(LaravelMenuFilterFactory $filterFactory, LaravelMenuRenderFactory $rendererFactory, ActiveMenuItemProcessor $activeMenuItemProcessor)
    {
        $this->filterFactory = $filterFactory;
        $this->renderFactory = $rendererFactory;
        $this->activeMenuItemProcessor = $activeMenuItemProcessor;
    }

    /**
     * @param string $menuName
     * @return string
     * @throws \Throwable
     */
    public function render($menuName = 'default'): string
    {
        $result = $this->getMenu($menuName);

        return $this->renderFactory
            ->create(array_get($result->getMenuConfig(), 'renderer', 'blade'))
            ->render($result);
    }

    /**
     * @param string $menuName
     * @return array
     */
    public function getLastActiveItem($menuName = 'default'): array
    {
        $result = $this->getMenu($menuName);

        return $result->getLastActiveItem() ?? [];
    }

    /**
     * @param string $menuName
     * @return FilteredMenu
     */
    public function getMenu(string $menuName): FilteredMenu
    {
        if(array_key_exists($menuName, $this->filterResults))
        {
            return $this->filterResults[$menuName];
        }

        $menuConfig = include resource_path('menu/' . $menuName . '.php');

        $filter = $this->filterFactory->create(array_get($menuConfig, 'filter', 'two-level'));

        $items = $filter->filter($menuConfig['items']);

        return $this->filterResults[$menuName] = new FilteredMenu($items, $menuConfig, $this->activeMenuItemProcessor->getLastActiveItem());
    }
}
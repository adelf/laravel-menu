<?php

namespace Adelf\LaravelMenu\Filters;

interface LaravelMenuFilter
{
    public function filter(array $items): array;
}
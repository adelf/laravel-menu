<?php

namespace Adelf\LaravelMenu\Tests\Traits;

trait Closures
{
    protected function trueClosure()
    {
        return function() {
            return true;
        };
    }

    protected function falseClosure()
    {
        return function() {
            return false;
        };
    }
}
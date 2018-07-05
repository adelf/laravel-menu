<?php

function activeMenuController(string $controllerClassName): Closure
{
    return function() use ($controllerClassName) {
        return request()->route()->controller && request()->route()->controller instanceof $controllerClassName;
    };
}

function activeMenuUrlPrefix(string $prefix): Closure
{
    return function() use ($prefix) {
        return strpos(request()->path(), $prefix) === 0;
    };
}

function authMenuCan(string $ability, $arguments = []): Closure
{
    return function() use ($ability, $arguments) {
        return app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($ability, $arguments);
    };
}
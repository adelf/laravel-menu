# Laravel Menu

Simple component for creating menus in Laravel. Instead of using controllers or creating huge blade templates suggests only one configuration file.

Example (**resources/menu/default.php**):

```php
<?php

return [
    //'template' => 'menu.menu', // custom blade template can be provided here

    'items' => [
        [
            'name' => 'Home',
            'auth' => authMenuCan('homeAbility'), // Will be shown if user "can" 'homeAbility'.
            'link' => route('dashboard'),
            'active' => activeMenuController(\App\Http\Controllers\DashboardController::class),
            'icon' => 'home',
        ],
        [
            'name' => 'Users',
            'auth' => authMenuCan('manageUsers'),
            'link' => '/users',
            'active' => activeMenuUrlPrefix('users'), // Will be active for all '/users*' URL's
            'icon' => 'user',
        ],
        [
            'name' => trans('complex.auth'),
            'auth' => function (){
                return Gate::check('one') || Gate::check('two');
            },
            'link' => '/complex-auth',
            'active' => activeMenuUrlPrefix('complex-auth'),
            'icon' => 'complex',
        ],
        [
            'name' => 'Group',
            'icon' => 'group',
            'items' => [
                [
                    'name' => 'Orders',
                    'link' => '/orders', // route('orders'),
                    'active' => activeMenuController(\App\Http\Controllers\OrdersController::class),
                    'icon' => 'orders',
                ],
                [
                    'name' => 'Bar',
                    'link' => '/bar', // route('bar'),
                    'active' => activeMenuController(\App\Http\Controllers\BarController::class),
                    'icon' => 'bar',
                ],
            ],
        ],
    ],
];
```

Blade template for one-level menus can be very simple:
```blade
<nav>
    <ul>
        @foreach($items as $item)
            <li @if($item['active']) class="active" @endif>
                <a href="{{$item['link']}}" title="{{$item['name']}}">
                    <i class="fa fa-{{$item['icon']}}"></i>
                    {{$item['name']}}
                </a>
            </li>
        @endforeach
    </ul>
</nav>
```

For two-level menus it's more complicated. Example of it is provided by package.

## Installation
First, require package via composer:
```
composer require adelf/laravel-menu
```
When publish some initial configuration and blade template:
```
php artisan vendor:publish --provider="Adelf\LaravelMenu\LaravelMenuServiceProvider"
```
**resources/menu/default.php** and **resources/views/menu/menu.blade.php** files will appear.

Laravel facade can be registered also in **config/app.php**(but is not required):
```php
'aliases' => [
        ...,

        'LaravelMenu' => Adelf\LaravelMenu\Facade::class,
    ],
```

## Using
This will render menu's blade template
```blade
<header>
    {!! app(\Adelf\LaravelMenu\LaravelMenu::class)->render() !!}
    <!-- or, with facade: -->
    {!! LaravelMenu::render() !!}
</header>
```

Title of active item can be used for title:
```blade
<title>
    {{array_get(app(\Adelf\LaravelMenu\LaravelMenu::class)->getLastActiveItem(), 'name', 'Default title')}}
    <!-- or, with facade: -->
    {{array_get(LaravelMenu::getLastActiveItem(), 'name', '')}}
</title>
```

## Multiple menus
Another menu can be created by defining it in new file on **resources/menu** directory. For example, **resources/menu/admin.php**

```blade
<title> 
    {!! array_get(LaravelMenu::getLastActiveItem('admin'), 'name', 'Default title') !!}
</title>
<header>
    {!! LaravelMenu::render('admin') !!}
</header>
```

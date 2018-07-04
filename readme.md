#Laravel Menu

Simple component for creating menus in Laravel. Instead of using controllers or creating huge blade templates suggests only one configuration file.

Example (**resources/menu/default.php**):

```php
<?php

return [
    //'template' => 'menu.menu', // custom blade template can be provided here

    'items' => [
        [
            'name' => 'Home',
            'auth' => authMenuCan('homeAbility'),
            'link' => route('dashboard'),
            'active' => activeMenuController(\App\Http\Controllers\DashboardController::class),
            'icon' => 'home',
        ],
        [
            'name' => 'Foo',
            'auth' => authMenuCan('fooAbility'),
            'link' => '/foo',
            'active' => activeMenuRequestPrefix('foo'), // Will be active for all '/foo*' URL's
            'icon' => 'briefcase',
        ],
        [
            'name' => 'Complex auth',
            'auth' => function (){
                return \Gate::check('one') || \Gate::check('two'); 
            },
            'link' => '/complex-auth',
            'active' => activeMenuRequestPrefix('complex-auth'),
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

##Installation
First, require package via composer:
```
composer require adelf/laravel-menu
```
When publish some initial configuration and blade template:
```
php artisan vendor:publish --provider="Adelf\LaravelMenu\LaravelMenuServiceProvider"
```
**resources/menu/default.php** and **resources/views/menu/menu.blade.php** files will appear.

##Using
This will render menu's blade template
```blade
<header>
{!! app(\Adelf\LaravelMenu\LaravelMenu::class)->render() !!}
</header>
```

Title of active item can be used for title:
```blade
<title>
    {!! array_get(app(\Adelf\LaravelMenu\LaravelMenu::class)->getLastActiveItem(), 'name', '') !!}
</title>
```

##Multiple menus
Another menu can be created by defining it in new file on **resources/menu** directory. For example, **resources/menu/admin.php**

```blade
<title> 
    {!! array_get(app(\Adelf\LaravelMenu\LaravelMenu::class)->getLastActiveItem('admin'), 'name', '') !!}
</title>
<header>
{!! app(\Adelf\LaravelMenu\LaravelMenu::class)->render('admin') !!}
</header>
```
<?php

return [
    //'template' => 'menu.menu', // custom blade template can be provided here

    'items' => [
        [
            'name' => 'Home',
            //'auth' => authMenuCan('homeAbility'),
            'link' => '/', // or route('dashboard')
            //'active' => activeMenuController(\App\Http\Controllers\DashboardController::class), // Will be active for this controller
            'icon' => 'home',
        ],
        [
            'name' => 'Foo',
            //'auth' => authMenuCan('fooAbility'),
            'link' => '/foo', // or route('foo')
            // 'active' => activeMenuUrlPrefix('foo'), // Will be active for all '/foo*' URL's
            'icon' => 'briefcase',
        ],
        [
            'name' => 'Group',
            'icon' => 'group',
            'items' => [
                [
                    'name' => 'Orders',
                    'link' => '/orders', // route('orders'),
                    //'active' => activeMenuController(\App\Http\Controllers\OrdersController::class),
                    'icon' => 'orders',
                ],
                [
                    'name' => 'Bar',
                    'link' => '/bar', // route('bar'),
                    //'active' => activeMenuController(\App\Http\Controllers\BarController::class),
                    'icon' => 'bar',
                ],
            ],
        ],
    ],
];
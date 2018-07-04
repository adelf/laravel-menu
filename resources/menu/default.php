<?php

return [
    //'template' => 'menu.menu', // custom blade template can be provided here

    'items' => [
        [
            'name' => 'Home',
            //'auth' => authMenuCan('homeAbility'),
            'link' => '/', // or route('dashboard')
            //'active' => activeMenuController(\App\Http\Controllers\DashboardController::class),
            'icon' => 'home',
        ],
        [
            'name' => 'Foo',
            //'auth' => authMenuCan('fooAbility'),
            'link' => '/foo', // or route('foo')
            // 'active' => activeMenuRequestPrefix('organizations'),
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
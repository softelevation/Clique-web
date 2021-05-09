<?php
// Aside menu

return [

    'items' => [
        // Dashboard
        [
            'title' => 'Dashboard',
            'root' => true,
            'icon' => 'public/media/svg/icons/Design/Layers.svg', // or can be 'flaticon-home' or any flaticon-*
            'page' => 'admin/corporate/dashboard',
            'new-tab' => false,
        ],

        // Custom
        [
            'section' => 'MANAGEMENT',
        ],
        [
            'title' => 'Users List',
            'icon' => 'public/media/svg/icons/Communication/Group.svg',
            'bullet' => 'dot',
            'page' => 'admin/corporate/users/list',
        ],
        [
            'title' => 'Profile',
            'icon' => 'public/media/svg/icons/Communication/Address-card.svg',
            'bullet' => 'dot',
            'page' => 'admin/corporate/profile',
        ],
        [
            'title' => 'Order',
            'icon' => 'public/media/svg/icons/Shopping/Cart1.svg',
            'bullet' => 'dot',
            'page' => 'admin/corporate/orders/list',
            'root' => false,

        ],
        [
            'title' => 'Card Management',
            'icon' => 'public/media/svg/icons/Shopping/Credit-card.svg',
            'bullet' => 'dot',
            'page' => 'admin/corporate/assign-card-list',
            'root' => false,

        ],







    ]

];

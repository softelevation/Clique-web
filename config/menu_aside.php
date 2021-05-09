<?php
// Aside menu

return [

    'items' => [
        // Dashboard
        [
            'title' => 'Dashboard',
            'root' => true,
            'icon' => 'public/media/svg/icons/Design/Layers.svg', // or can be 'flaticon-home' or any flaticon-*
            'page' => 'admin/dashboard',
            'new-tab' => false,
        ],

        // Custom
        [
            'section' => 'MANAGEMENT',
        ],
        [
            'title' => 'User Setting',
            'icon' => 'public/media/svg/icons/Layout/Layout-4-blocks.svg',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Users List',
                    'bullet' => 'dot',
                    'page' => 'admin/users/list',
                ],
                [
                   'title' => 'Corporate Admin',
                    'bullet' => 'dot',
                    'page' => 'admin/corporate-list',
                ],
                [
                    'title' => 'System Admin',
                    'bullet' => 'dot',
                    'page' => 'admin/system-admin-list',
                ],
                [
                    'title' => 'Corporate Request',
                    'bullet' => 'dot',
                    'page' => 'admin/corporate-request-list',
                ]

            ]
        ],
        [
            'title' => 'Reports',
            'icon' => 'public/media/svg/icons/Media/Equalizer.svg',
            'root' => true,
            'bullet' => 'dot',
            'submenu' => [

                [
                    'title' => 'All Users',
                    'page' => 'admin/allcustomer/list'
                ],
                [
                    'title' => 'Corporate Users',
                    'page' => 'admin/corporateusers/list'
                ],
                [
                    'title' => 'Orders',
                    'page' => 'admin/reports/orders'
                ],
                [
                    'title' => 'Subcriber Users',
                    'page' => 'admin/reports/subscriberusers'
                ]

            ]
        ],

        [
            'title' => 'Order',
            'icon' => 'public/media/svg/icons/Shopping/Cart1.svg',
            'bullet' => 'dot',
            'page' => 'admin/orders/list',
            'root' => false,

        ],

        [
            'title' => 'Settings',
            'icon' => 'public/media/svg/icons/Shopping/Box2.svg',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [

                [
                    'title' => 'Card Management',
                    'bullet' => 'dot',
                    'page' => 'admin/card/list',
                    'new-tab' => false,
                ],
                [
                    'title' => 'Site Setting',
                    'bullet' => 'dot',
                    'page' => '#',
                    'new-tab' => false,
                ],
                [
                    'title' => 'Notifications',
                    'root' => true,
                    'icon' => 'public/media/svg/icons/Design/Layers.svg', // or can be 'flaticon-home' or any flaticon-*
                    'page' => '#',
                    'new-tab' => false,
                ],
                [
                    'title' => 'Testimonials',
                    'icon' => 'public/media/svg/icons/Home/Book-open.svg',
                    'bullet' => 'dot',
                    'root' => true,
                    'page' => 'admin/testimonials/list',
                    'new-tab' => false,

                ],
                [
                    'title' => 'Pricing Management',
                    'root' => true,
                    'icon' => 'public/media/svg/icons/Devices/Diagnostics.svg', // or can be 'flaticon-home' or any flaticon-*
                    'page' => '#',
                    'new-tab' => false,
                ],


            ]
        ],

    ]

];

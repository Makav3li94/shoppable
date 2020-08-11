<?php
return [
    'version' => '2.1',
    'sub_version' => '2.1.20',
    'homepage' => 'https://parnasite.com',
    'name' => 'shoppable',
    'title' => 'فروشگاهی برای همه',
    'email' => 'parham.akbarnia.73@gmail.com',
    'api_link' => env('SC_API_LINK', 'https://api.s-cart.org/v1'),
    //Enable, disable page libary online
    'settings' => [
        'api_plugin' => 1,
        'api_template' => 1,
    ],
];

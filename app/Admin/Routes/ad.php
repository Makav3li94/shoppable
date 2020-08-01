<?php
$router->group(['prefix' => 'ad'], function ($router) {
    $router->get('/', 'ShopAdController@index')->name('admin_ad.index');
    $router->get('/edit/{id}', 'ShopAdController@edit')->name('admin_ad.edit');
    $router->post('/edit/{id}', 'ShopAdController@postEdit')->name('admin_ad.edit');
});

<?php
$router->group(['prefix' => 'price'], function ($router) {
    $router->get('/', 'ShopPriceController@index')->name('admin_better_price.index');
    $router->get('/export_detail', 'ShopPriceController@exportDetail')->name('admin_better_price.export_detail');
});

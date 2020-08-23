<?php
$router->group(['prefix' => 'price_list'], function ($router) {
    $router->get('/', 'ShopPriceListController@index')->name('admin_price_list.index');
    $router->get('create', 'ShopPriceListController@Create')->name('admin_price_list.create');
    $router->post('/create', 'ShopPriceListController@postCreate')->name('admin_price_list.create');
    $router->post('/createAjax', 'ShopPriceListController@createAjax')->name('admin_price_list.createAjax');
    $router->get('/edit/{id}', 'ShopPriceListController@edit')->name('admin_price_list.edit');
    $router->post('/edit/{id}', 'ShopPriceListController@postEdit')->name('admin_price_list.edit');
    $router->post('/delete', 'ShopPriceListController@deleteList')->name('admin_price_list.delete');
});

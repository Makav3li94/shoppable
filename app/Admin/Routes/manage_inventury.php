<?php
$router->group(['prefix' => 'manage_inventury'], function ($router) {
    $router->get('/', 'ShopManageInventuryController@index')->name('admin_manage_inventury.index');
//    $router->get('create', 'ShopPriceListController@Create')->name('admin_price_list.create');
//    $router->post('/create', 'ShopPriceListController@postCreate')->name('admin_price_list.create');
//    $router->get('/edit/{id}', 'ShopPriceListController@edit')->name('admin_price_list.edit');
//    $router->post('/edit/{id}', 'ShopPriceListController@postEdit')->name('admin_price_list.edit');
//    $router->post('/delete', 'ShopPriceListController@deleteList')->name('admin_price_list.delete');
});

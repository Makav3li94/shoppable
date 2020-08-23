<?php
$router->group(['prefix' => 'product_type'], function ($router) {
    $router->get('/', 'ShopProductTypeController@index')->name('admin_product_type.index');
    $router->get('create', 'ShopProductTypeController@create')->name('admin_product_type.create');
    $router->post('/create', 'ShopProductTypeController@postCreate')->name('admin_product_type.create');
    $router->get('/edit/{id}', 'ShopProductTypeController@edit')->name('admin_product_type.edit');
    $router->post('/edit/{id}', 'ShopProductTypeController@postEdit')->name('admin_product_type.edit');
    $router->post('/delete', 'ShopProductTypeController@deleteList')->name('admin_product_type.delete');
    $router->post('/getGroup', 'ShopProductTypeController@getGroup')->name('admin_product_type_get_group');
    $router->post('/getInput', 'ShopProductTypeController@getInput')->name('admin_product_type_get_input');
});

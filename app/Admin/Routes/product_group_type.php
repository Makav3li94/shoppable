<?php
$router->group(['prefix' => 'product_group_type'], function ($router) {
    $router->get('/', 'ShopProductGroupTypeAttrController@index')->name('admin_product_group_type.index');
    $router->get('create', 'ShopProductGroupTypeAttrController@Create')->name('admin_product_group_type.create');
    $router->post('/create', 'ShopProductGroupTypeAttrController@postCreate')->name('admin_product_group_type.create');
    $router->get('/edit/{id}', 'ShopProductGroupTypeAttrController@edit')->name('admin_product_group_type.edit');
    $router->post('/edit/{id}', 'ShopProductGroupTypeAttrController@postEdit')->name('admin_product_group_type.edit');
    $router->post('/delete', 'ShopProductGroupTypeAttrController@deleteList')->name('admin_product_group_type.delete');
});

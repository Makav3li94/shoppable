<?php
$router->group(['prefix' => 'product_type_attrs'], function ($router) {
    $router->get('/', 'ShopProductTypeAttrController@index')->name('admin_product_type_attrs.index');
    $router->get('create', 'ShopProductTypeAttrController@create')->name('admin_product_type_attrs.create');
    $router->post('/create', 'ShopProductTypeAttrController@postCreate')->name('admin_product_type_attrs.create');
    $router->get('/edit/{attr_id}', 'ShopProductTypeAttrController@edit')->name('admin_product_type_attrs.edit');
    $router->post('/edit/{attr_id}', 'ShopProductTypeAttrController@postEdit')->name('admin_product_type_attrs.edit');
    $router->post('/delete', 'ShopProductTypeAttrController@deleteList')->name('admin_product_type_attrs.delete');
    $router->post('/getGroupAjax', 'ShopProductTypeAttrController@getGroupAjax')->name('get.group.ajax');
    $router->post('/getAttrAjax', 'ShopProductTypeAttrController@getAttrAjax')->name('get.attr.ajax');
});

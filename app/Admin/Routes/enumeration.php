<?php
$router->group(['prefix' => 'enumeration'], function ($router) {
    $router->get('/', 'ShopEnumerationController@index')->name('admin_enumeration_type.index');
    $router->get('create', 'ShopEnumerationController@create')->name('admin_enumeration_type.create');
    $router->post('/create', 'ShopEnumerationController@postCreate')->name('admin_enumeration_type.create');
    $router->get('/edit/{id}', 'ShopEnumerationController@edit')->name('admin_enumeration_type.edit');
    $router->post('/edit/{id}', 'ShopEnumerationController@postEdit')->name('admin_enumeration_type.edit');
    $router->post('/delete', 'ShopEnumerationController@deleteList')->name('admin_enumeration_type.delete');
    $router->post('/getProductEnumeration', 'ShopEnumerationController@getProductEnumeration')->name('admin_enumeration_type.getProductEnumeration');

});

<?php
$router->group(['prefix' => 'guarantee'], function ($router) {
    $router->get('/', 'ShopGuaranteeController@index')->name('admin_guarantee.index');
    $router->get('create', 'ShopGuaranteeController@create')->name('admin_guarantee.create');
    $router->post('/create', 'ShopGuaranteeController@postCreate')->name('admin_guarantee.create');
    $router->get('/edit/{id}', 'ShopGuaranteeController@edit')->name('admin_guarantee.edit');
    $router->post('/edit/{id}', 'ShopGuaranteeController@postEdit')->name('admin_guarantee.edit');
    $router->post('/delete', 'ShopGuaranteeController@deleteList')->name('admin_guarantee.delete');
});

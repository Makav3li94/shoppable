<?php
$router->group(['prefix' => 'incoming_inventory'], function ($router) {
    $router->get('/', 'ShopIncomingInventoryController@index')->name('admin_incoming_inventory.index');
    $router->get('create', 'ShopIncomingInventoryController@Create')->name('admin_incoming_inventory.create');
    $router->post('/create', 'ShopIncomingInventoryController@postCreate')->name('admin_incoming_inventory.create');
    $router->get('/edit/{id}', 'ShopIncomingInventoryController@edit')->name('admin_incoming_inventory.edit');
    $router->post('/edit/{id}', 'ShopIncomingInventoryController@postEdit')->name('admin_incoming_inventory.edit');
    $router->post('/delete', 'ShopIncomingInventoryController@deleteList')->name('admin_incoming_inventory.delete');
});

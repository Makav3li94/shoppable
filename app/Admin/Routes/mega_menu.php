<?php
$router->group(['prefix' => 'mega_menu'], function ($router) {
    $router->get('/', 'ShopMegaMenuController@index')->name('admin_mega_menu.index');
    $router->post('/create', 'ShopMegaMenuController@postCreate')->name('admin_mega_menu.create');
    $router->get('/edit/{id}', 'ShopMegaMenuController@edit')->name('admin_mega_menu.edit');
    $router->post('/edit/{id}', 'ShopMegaMenuController@postEdit')->name('admin_mega_menu.edit');
    $router->post('/delete', 'ShopMegaMenuController@deleteList')->name('admin_mega_menu.delete');
    $router->post('/update_sort', 'ShopMegaMenuController@updateSort')->name('admin_mega_menu.update_sort');
});

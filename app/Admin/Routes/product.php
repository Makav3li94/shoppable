<?php
$router->group(['prefix' => 'product'], function ($router) {
    $router->get('/', 'ShopProductController@index')->name('admin_product.index');
    $router->get('create', 'ShopProductController@create')->name('admin_product.create');
    $router->post('/create', 'ShopProductController@postCreate')->name('admin_product.create');
    $router->get('/edit/{id}', 'ShopProductController@edit')->name('admin_product.edit');
    $router->post('/edit/{id}', 'ShopProductController@postEdit')->name('admin_product.edit');
    $router->post('/delete', 'ShopProductController@deleteList')->name('admin_product.delete');
    $router->get('/import', 'ShopProductController@import')->name('admin_product.import');
    $router->post('/import', 'ShopProductController@postImport')->name('admin_product.import');
    $router->post('/getProductTypes', 'ShopProductController@getProductTypes')->name('admin_product.getProductTypes');
    $router->post('/getAttrInput', 'ShopProductController@getAttrInput')->name('admin_product.getAttrInput');
    $router->post('/getProductRealte', 'ShopProductController@getProductRealte')->name('admin_product.getProductRealte');
    $router->post('/getRelatedProducts', 'ShopProductController@getRelatedProducts')->name('admin_product.getRelatedProducts');
});

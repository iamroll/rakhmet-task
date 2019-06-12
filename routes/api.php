<?php


Route::apiResource('categories', 'CategoryController')->only(['index', 'destroy', 'update', 'store']);
Route::resource('products', 'ProductController')->only(['destroy', 'update', 'store']);

Route::get('products/getByCategoryId', 'ProductController@getProductsByCategory');
Route::post('products/filter', 'ProductController@filter');

// Auth
Route::group([

    'prefix' => 'auth',
    'middleware' => 'api',

], function () {

    Route::post('login', 'AuthController@login');

});

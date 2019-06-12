<?php


Route::apiResource('categories', 'CategoryController')->only(['index', 'destroy', 'update', 'store']);
Route::apiResource('products', 'ProductController')->only(['destroy', 'update', 'store']);

Route::get('products/getByCategoryId', 'ProductController@getProductsByCategory');
Route::post('products/filter', 'ProductController@filter');

// Auth
Route::group([

    'prefix' => 'auth',
    'middleware' => 'api',

], function () {

    Route::post('login', 'AuthController@login');

});

Route::fallback(function(){
    return response()->json(['message' => 'Not Found!'], 404);
});

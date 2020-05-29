<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

  Route::resource('products', 'Admin\ManageProductController');
  Route::resource('categories', 'Admin\ManageProductCategories');
  Route::resource('cart', 'Customer\CartController');
  Route::resource('orders', 'Customer\OrderController');
  Route::resource('profile', 'Customer\CustomerProfileController');

  Route::get('products_all', 'Customer\ProductsController@index');
  Route::get('product/show/{id}', 'Customer\ProductsController@show');
  Route::get('categorycount', 'Customer\ProductsController@countProductsInCategory');
  Route::get('products/sortBy/{categoryName}', 'Customer\ProductsController@sortByCategory');
  Route::get('products/search/{searchText}', 'Customer\ProductsController@searchProduct');
  Route::get('cart/{customerName}/count', 'Customer\CartController@showCartCount');
  Route::get('cart/{name}/show', 'Customer\CartController@show');
  Route::get('cart/{name}/show/{cartId}', 'Customer\CartController@showSpecificCartInfo');
  Route::post('cart/{name}/show/{cartId}/editquantity', 'Customer\CartController@updateQuantity');
  Route::delete('cart/{name}/remove/{cartId}', 'Customer\CartController@removeItem');

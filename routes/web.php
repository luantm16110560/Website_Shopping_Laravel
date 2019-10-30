<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home',[
    'as'=>'home-page',
    'uses'=>'PageController@getIndex'
]);
Route::get('/type',[
    'as'=>'product-type',
    'uses'=>'PageController@getProductType'
]);
Route::get('/product_detail',[
    'as'=>'product-detail',
    'uses'=>'PageController@getProductDetail'
]);
Route::get('/contact',[
    'as'=>'contact',
    'uses'=>'PageController@getContact'
]);
Route::get('/about',[
    'as'=>'about',
    'uses'=>'PageController@getAbout'
]);
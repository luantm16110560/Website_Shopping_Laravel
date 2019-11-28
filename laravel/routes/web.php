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
Route::get('/type/{type}',[
    'as'=>'product-type',
    'uses'=>'PageController@getProductType'
]);
Route::get('/product_detail/{id}',[
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

Route::get('/file',[
    'as'=>'upload_file',
    'uses'=>'FileController@showUploadForm'
]);

Route::post('/file',[
    'uses'=>'FileController@storeFile'
]);

Route::get('/add-to-card/{id}',[
    'as'=>'addtocard',
    'uses'=>'PageController@getAddtoCard'
]);

Route::get('/delItem-cart/{id}',[
    'as'=>'deletegiohang',
    'uses'=>'PageController@getDelItemCard'
]);

Route::get('/dang_nhap',[
    'as'=>'dangnhap',
    'uses'=>'PageController@getLogin'
]);

Route::post('dang_nhap',[
	'as'=>'dangnhap',
	'uses'=>'PageController@postLogin'
]);
Route::get('dang_xuat',[
	'as'=>'dangxuat',
	'uses'=>'PageController@getLogout'
]);
Route::get('/dang_ki',[
    'as'=>'dangki',
    'uses'=>'PageController@getSignin'
]);

Route::post('dang_ki',[
	'as'=>'dangki',
	'uses'=>'PageController@postSignin'
]);

Route::get('/dat_hang',[
	'as'=>'dathang',
	'uses'=>'PageController@getOrder'
]);

Route::post('/dat_hang',[
    'as'=>'dathang',
    'uses'=>'PageController@postOrder'
]);

Route::get('search',[
	'as'=>'search',
	'uses'=>'PageController@getSearch'
]);
Route::get('search',[
	'as'=>'search',
	'uses'=>'PageController@getSearch'
]);
Route::get('searchView',[
	'as'=>'searchView',
	'uses'=>'PageController@getsearchView'
]);
Route::get('/gender',[
	'as'=>'gender',
	'uses'=>'PageController@getProductByGender'
]);
Route::get('/gender_typeProdouct',[
	'as'=>'gender_typeProdouct',
	'uses'=>'PageController@getProductTypeByGender'
]);
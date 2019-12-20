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

Route::get('/delItem/{id}',[
    'as'=>'deletesp',
    'uses'=>'PageController@getDelItem'
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



//Manager
Route::get('/manager-page',[
	'as'=>'manager-page',
	'uses'=>'PageController@managerPage'
]);
Route::get('/manage-product',[
	'as'=>'manage-product',
	'uses'=>'PageController@manageProduct'
]);
Route::get('/manage-bill',[
	'as'=>'manage_bill',
	'uses'=>'PageController@manageBill'
]);
Route::get('/manage-user',[
	'as'=>'manage-user',
	'uses'=>'PageController@manageUser'
]);
// Product manage
Route::get('/upload_product',[
	'as'=>'upload_product',
	'uses'=>'PageController@uploadProduct'
]);
Route::get('/crud_product',[
	'as'=>'crud_product',
	'uses'=>'PageController@crudProduct'
]);
Route::get('/sale_of_product',[
	'as'=>'sale_of_product',
	'uses'=>'PageController@saleOfProduct'
]);
Route::get('/cate_product',[
	'as'=>'cate_product',
	'uses'=>'PageController@crudCate'
]);
//prodct

Route::post('/add_product',[
	'as'=>'add_product',
	'uses'=>'PageController@createProduct'
]);

Route::get('/infor',[
	'as'=>'infor',
	'uses'=>'PageController@getinfor'
]);

Route::post('/infor',[
	'as'=>'infor',
	'uses'=>'PageController@postinfor'
]);
//BILL
Route::get('/crud-bill',[
	'as'=>'crud-bill',
	'uses'=>'PageController@crudView'
]);
//get bill by id
Route::get('/editbill/{id}',[
	'as'=>'editbill',
	'uses'=>'PageController@geteditBill'
]);
//update bill
Route::post('/editbill/{id}',[
	'as'=>'editbill',
	'uses'=>'PageController@posteditBill'
]);



//delete bill
Route::get('/deletebill/{id}',[
	'as'=>'deletebill',
	'uses'=>'PageController@postdeleteBill'
]);

//search
Route::get('tracuu',[
	'as'=>'tracuu',
	'uses'=>'PageController@viewTraCuu'
]);
Route::get('search_bill',[
	'as'=>'search_bill',
	'uses'=>'PageController@searchBill'
]);
//confirm bill
Route::get('confirm',[
	'as'=>'confirm',
	'uses'=>'PageController@billConfirm'
]);
//bill detail
Route::get('billdetail/{id}',[
	'as'=>'billdetail',
	'uses'=>'PageController@getDetail'
]);
//Thong ke hoa don theo ngay
Route::get('bill_day',[
	'as'=>'bill_day',
	'uses'=>'PageController@bill_day'
]);
Route::get('get_bill_day',[
	'as'=>'get_bill_day',
	'uses'=>'PageController@get_bill_day'
]);
//Thong ke hoa don theo quy
Route::get('get_bill_quy',[
	'as'=>'get_bill_quy',
	'uses'=>'PageController@get_bill_quy'
]);
Route::get('result_bill_quy',[
	'as'=>'result_bill_quy',
	'uses'=>'PageController@result_bill_quy'
]);

//Change password
Route::get('change_password',[
	'as'=>'change_password',
	'uses'=>'PageController@changePassword'
]);
Route::post('postChangePassword',[
	'as'=>'postChangePassword',
	'uses'=>'PageController@postChangePassword'
]);


//PRODUCT
//update product
Route::get('/edit_product/{id_pro}/{id_type}',[
	'as'=>'edit_product',
	'uses'=>'PageController@get_editProduct'
]);
Route::post('/editproduct/{id_pro}',[
	'as'=>'editproduct',
	'uses'=>'PageController@post_editProduct'
]);
//delete product
Route::get('/deleteproduct/{id}',[
	'as'=>'deleteproduct',
	'uses'=>'PageController@postdeleteProduct'
]);

//TYPE_PRODUCT
//edit cate
Route::get('/edit_cate/{id}',[
	'as'=>'edit_cate',
	'uses'=>'PageController@geteditCate'
]);
Route::post('/edit_cate/{id}',[
	'as'=>'edit_cate',
	'uses'=>'PageController@posteditcate'
]);
//delet cate
Route::get('/deletecate/{id}',[
	'as'=>'deletecate',
	'uses'=>'PageController@deletecate'
]);
Route::get('auth/google', 'Auth\LoginController@redirectToGoogle');
Route::get('auth/google/callback', 'Auth\LoginController@handleGoogleCallback');

















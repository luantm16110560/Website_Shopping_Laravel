<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|return view('welcome');
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/chatbot', function () {
//     return view('welcome');
// });
	
//HomeController
Route::get('/', function () {
	return redirect()->route('home-page');
});
Route::get('/home',[
    'as'=>'home-page',
    'uses'=>'HomeController@getIndex'
]);
Route::get('/contact',[
    'as'=>'contact',
    'uses'=>'HomeController@getContact'
]);
Route::get('/about',[
    'as'=>'about',
    'uses'=>'HomeController@getAbout'
]);

//CartController
Route::get('/add_to_card/',[
    'as'=>'addtocard',
    'uses'=>'CartController@getAddtoCard'
]);
Route::get('/count_cart',[
    'as'=>'count_cart',
    'uses'=>'CartController@getCountCard'
]);
Route::get('/add-by-one/{id_pro}/{size}',[
    'as'=>'addbyone',
    'uses'=>'CartController@AddByOne'
]);
Route::get('/delItem-cart/{id_pro}/{size}',[
    'as'=>'deletegiohang',
    'uses'=>'CartController@getDelItemCard'
]);
Route::get('/delItem/{id_pro}/{size}',[
    'as'=>'deletesp',
    'uses'=>'CartController@getDelItem'
]);
//AccountController
Route::get('/login',[
    'as'=>'login',
    'uses'=>'HomeController@getLogin'
]);
Route::post('/login',[
	'as'=>'login',
	'uses'=>'UserController@postLogin'
]);
Route::get('logout',[
	'as'=>'logout',
	'uses'=>'UserController@getLogout'
]);
Route::get('/register',[
    'as'=>'register',
    'uses'=>'UserController@getSignin'
]);
Route::post('register',[
	'as'=>'register',
	'uses'=>'UserController@postSignin'
]);
Route::get('/infor',[
	'as'=>'infor',
	'uses'=>'UserController@getinfor'
]);
Route::post('/infor',[
	'as'=>'infor',
	'uses'=>'UserController@postinfor'
]);
Route::get('change_password',[
	'as'=>'change_password',
	'uses'=>'UserController@changePassword'
]);
Route::post('postChangePassword',[
	'as'=>'postChangePassword',
	'uses'=>'UserController@postChangePassword'
]);


Route::get('/product_detail/{id}',[
    'as'=>'product-detail',
    'uses'=>'ProductController@getProductDetail'
]);
Route::get('search',[
	'as'=>'search',
	'uses'=>'SearchController@getSearch'
]);
Route::get('search_test',[
	'as'=>'search_test',
	'uses'=>'SearchController@index'
]);
Route::get('autocomplete',[
	'as'=>'autocomplete',
	'uses'=>'SearchController@autocomplete'
]);
Route::get('/type/{type}',[
    'as'=>'product-type',
    'uses'=>'ProductController@nav_getProductByType'
]);
Route::get('/order',[
	'as'=>'order',
	'uses'=>'PaymentController@get_handleOrder'
]);
Route::post('/order',[
    'as'=>'order',
    'uses'=>'PaymentController@handleOrder'
]);
Route::get('/gender',[
	'as'=>'gender',
	'uses'=>'ProductController@getProductByGender'
]);
Route::get('/gender_sale',[
	'as'=>'gender_sale',
	'uses'=>'ProductController@getProductSaleByGender'
]);
Route::get('/order_history',[
	'as'=>'orderhistory',
	'uses'=>'UserController@getOrderHistory'
]);

Route::get('/like/{id_pro}',[
	'as'=>'like',
	'uses'=>'LikeProduct_Controller@like_Product'
]);
Route::get('/dislike/{id_pro}',[
	'as'=>'dislike',
	'uses'=>'LikeProduct_Controller@dislike_Product'
]);
Route::get('/count_like',[
	'as'=>'count_like',
	'uses'=>'LikeProduct_Controller@countLike'
]);

Route::get('/get_like',[
	'as'=>'get_like',
	'uses'=>'LikeProduct_Controller@get_like'
]);
Route::get('/listcart',[
	'as'=>'listcart',
	'uses'=>'CartController@ListCart'
]);
Route::get('/getAmount/{id_product}/{size}',[
	'as'=>'getAmount',
	'uses'=>'ProductController@getAmount_Product'
]);








// Route::get('/gender_typeProdouct',[
// 	'as'=>'gender_typeProdouct',
// 	'uses'=>'PageController@getProductTypeByGender'
// ]);

Route::group(['prefix'=>'/admin','middleware'=>'admin_middleware'],function(){
	Route::get('/dashboard',[
		'as'=>'admin',
		'uses'=>'PageController@managerPage'
	]);
	Route::group(['prefix'=>'/product'],function(){
		Route::get('/manage-product',[
			'as'=>'manage-product',
			'uses'=>'PageController@manageProduct'
		]);
		Route::get('/search_product',[
			'as'=>'search_product',
			'uses'=>'ProductController@admin_getSearchProduct'
		]);
		Route::get('search_product_by_id',[
			'as'=>'search_product_by_id',
			'uses'=>'ProductController@admin_searchProduct'
		]);
		Route::get('/upload_product',[
			'as'=>'upload_product',
			'uses'=>'ProductController@getuploadProduct'
		]);
		Route::get('/get_list_product',[
			'as'=>'get_list_product',
			'uses'=>'ProductController@get_list_product'
		]);
		Route::get('/sale_of_product',[
			'as'=>'sale_of_product',
			'uses'=>'ProductController@saleOfProduct'
		]);
		Route::post('/add_product',[
			'as'=>'add_product',
			'uses'=>'ProductController@postUploadProduct'
		]);
		//edit product: type product 
		Route::get('/edit_product/{id_pro}/{id_type}',[
			'as'=>'edit_product',
			'uses'=>'ProductController@get_editProduct'
		]);
		//Edit product
		Route::post('/editproduct/{id_pro}',[
			'as'=>'editproduct',
			'uses'=>'ProductController@post_editProduct'
		]);
		Route::get('/delete_product/{id}',[
			'as'=>'delete_product',
			'uses'=>'ProductController@postdeleteProduct'
		]);
		Route::get('/delete_size/{id_product}/{size}',[
			'as'=>'delete_size',
			'uses'=>'ProductController@post_Delete_Size_Product'
		]);
		Route::post('/add_new_size/{id_product}',[
			'as'=>'add_new_size',
			'uses'=>'ProductController@post_add_NewSize_Product'
		]);
		Route::post('/edit_amount/{id_product}',[
			'as'=>'edit_amount',
			'uses'=>'ProductController@post_edit_Amount_Product'
		]);
		
		

		
		
	});
	Route::group(['prefix'=>'/bill'],function(){
		
		Route::get('/manage-bill',[
			'as'=>'manage_bill',
			'uses'=>'PageController@manageBill'
		]);
		Route::get('/list_bill_confirmed',[
			'as'=>'list_bill_confirmed',
			'uses'=>'BillController@list_bill_confirmed'
		]);
		Route::get('/delete_bill/{id}',[
			'as'=>'delete_bill',
			'uses'=>'PageController@postdeleteBill'
		]);
		Route::get('search_bill',[
			'as'=>'search_bill',
			'uses'=>'BillController@getSearchBill'
		]);
		Route::get('search_bill_by_id',[
			'as'=>'search_bill_by_id',
			'uses'=>'BillController@searchBill'
		]);
		Route::get('list_bill_wait_confirm',[
			'as'=>'list_bill_wait_confirm',
			'uses'=>'BillController@list_bill_wait_confirm'
		]);
		Route::get('bill_by_day',[
			'as'=>'bill_by_day',
			'uses'=>'BillController@bill_by_day'
		]);
		Route::get('get_bill_by_day',[
			'as'=>'get_bill_by_day',
			'uses'=>'BillController@get_bill_by_day'
		]);
		Route::get('get_bill_by_month',[
			'as'=>'get_bill_by_month',
			'uses'=>'BillController@get_bill_by_month'
		]);
		Route::get('result_bill_month',[
			'as'=>'result_bill_month',
			'uses'=>'BillController@result_bill_month'
		]);
		
	
		Route::get('/order_confirm/{id}',[
			'as'=>'order_confirm',
			'uses'=>'BillController@post_confirmBill'
		]);
		Route::get('billdetail/{id}',[
			'as'=>'billdetail',
			'uses'=>'BillController@admin_getBillDetail'
		]);
	});
	Route::group(['prefix'=>'/type_product'],function(){		
		Route::get('/get_list_type_product',[
			'as'=>'get_list_type_product',
			'uses'=>'Type_Product_Controller@get_list_type_product'
		]);
		Route::get('/product_by_type/{id}',[
			'as'=>'product_by_type',
			'uses'=>'ProductController@admin_getProductByType'
		]);
		Route::get('/add_type_product',[
			'as'=>'add_type_product',
			'uses'=>'Type_Product_Controller@get_add_type_product'
		]);
		Route::post('/add_type_product',[
			'as'=>'add_type_product',
			'uses'=>'Type_Product_Controller@post_add_type_product'
		]);
		Route::get('/edit_type_product/{id}',[
			'as'=>'edit_type_product',
			'uses'=>'Type_Product_Controller@get_edit_type_product'
		]);
		Route::post('/edit_type_product/{id}',[
			'as'=>'edit_type_product',
			'uses'=>'Type_Product_Controller@post_edit_type_product'
		]);
		Route::get('/deletecate/{id}',[
			'as'=>'deletecate',
			'uses'=>'Type_Product_Controller@deletecate'
		]);
	});
	Route::group(['prefix'=>'/inventory'],function(){
		Route::get('/product_inventory/{id_pro}/{id_type}',[
			'as'=>'product_inventory',
			'uses'=>'InventoryController@getProductInventory'
		]);
		Route::get('/inventory',[
			'as'=>'inventory',
			'uses'=>'PageController@getInventory'
		]);
	});

});

//Manager


Route::get('/manage-user',[
	'as'=>'manage-user',
	'uses'=>'PageController@manageUser'
]);

Route::get('/report',[
	'as'=>'report',
	'uses'=>'PageController@getReport'
]);



Route::get('auth/google', 'Auth\LoginController@redirectToGoogle');
Route::get('auth/google/callback', 'Auth\LoginController@handleGoogleCallback');

//LOGIN WITH FB
Route::get('/auth/facebook', 'Auth\LoginController@redirectToFacebook');
Route::get('/auth/facebook/callback/', 'Auth\LoginController@handleFacebookCallback');







//BOTMAN
Route::match(['get', 'post'], '/botman', 'BotManController@handle');



Route::get('/{gender}/{id}',[
	'as'=>'gender_type',
	'uses'=>'ProductController@chatbot_getProductByGender_ByType'
]);

Route::get('sale',[
	'as'=>'sale',
	'uses'=>'ProductController@getProduct_Sale'
]);

Route::get('best_like',[
	'as'=>'best_like',
	'uses'=>'LikeProduct_Controller@getBestLike'
]);
Route::get('gender_type/{gender}/{id_type}',[
	'as'=>'gender_type',
	'uses'=>'ProductController@user_getProductByType_ByGender'
]);

Route::get('/province/district/{id}',[
	'as'=>'district',
	'uses'=>'PageController@district'
]);
Route::get('/district/ward/{id}',[
	'as'=>'ward',
	'uses'=>'PageController@ward'
]);
Route::get('/province',[
	'as'=>'province',
	'uses'=>'PageController@getProvince'
]);
Route::get('/banner',[
	'as'=>'banner',
	'uses'=>'BannerController@getBanner'
]);
Route::post('/post/banner',[
	'as'=>'post_banner',
	'uses'=>'BannerController@postBanner'
]);
Route::get('/banner/delete/{id}',[
	'as'=>'delete_banner',
	'uses'=>'BannerController@deleteBanner'
]);


Route::get('/pay_online',[
	'as'=>'payonline',
	'uses'=>'PageController@create'
]);
Route::get('/returnvnpay',[
	'as'=>'returnvnpay',
	'uses'=>'PaymentController@return'
]);

//User view bill detail
Route::get('bill/bill_detail/{id}',[
	'as'=>'view_bill_detail',
	'uses'=>'BillController@user_getBillDetail'
]);

Route::get('ship',[
	'as'=>'ship',
	'uses'=>'PageController@getListShip'
]);
Route::get('ship/bill_detail/{id}',[
	'as'=>'ship_bill_detail',
	'uses'=>'PageController@getBillDetailShip'
]);
Route::get('ship/confirm_ship/{id}',[
	'as'=>'confirm_ship',
	'uses'=>'PageController@confirmShip'
]);

Route::get('/product/review/{id}',[
	'as'=>'review',
	'uses'=>'ReviewController@getReview'
]);
Route::post('/up_review',[
	'as'=>'up_review',
	'uses'=>'ReviewController@postReview'
]);
Route::get('product/delete_review/{id_product}',[
	'as'=>'delete_review',
	'uses'=>'ReviewController@deleteReview'
]);

Route::get('sortASC',[
	'as'=>'sortASC',
	'uses'=>'HomeController@sortASC'
]);
Route::get('sortDESC',[
	'as'=>'sortDESC',
	'uses'=>'HomeController@sortDESC'
]);

//gender sort
Route::get('gender/genderASC/{gender}',[
	'as'=>'genderASC',
	'uses'=>'SortController@genderASC'
]);
Route::get('gender/genderDESC/{gender}',[
	'as'=>'genderDESC',
	'uses'=>'SortController@genderDESC'
]);
//type sort
Route::get('type/asc/{id_type}',[
	'as'=>'type_asc',
	'uses'=>'SortController@type_ASC'
]);
Route::get('type/desc/{id_type}',[
	'as'=>'type_desc',
	'uses'=>'SortController@type_DESC'
]);

// type gender sort
Route::get('gender_type/asc/{gender}/{type_id}',[
	'as'=>'gender_type_asc',
	'uses'=>'SortController@type_Gender_ASC'
]);
Route::get('gender_type/desc/{gender}/{type_id}',[
	'as'=>'gender_type_desc',
	'uses'=>'SortController@type_Gender_DESC'
]);

Route::get('order_history/delete_bill/{id}',[
	'as'=>'user_delete_bill',
	'uses'=>'PageController@postdeleteBill'
]);

Route::get('ship/cancel_bill/{id}',[
	'as'=>'cancel_bill',
	'uses'=>'PageController@postcancelBill'
]);
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

Route::get('/Login', function () {
    return view('authentication.user_login');
});

Route::get('/', function () {
    return view('welcome');
});
Route::get('PasswordCheck', function () {
    return view('authentication.password_check');
});

Route::post('UserPasswordCheck','UserInfoController@userPasswordCheck');





Route::resource('UserTypeInfo','UserTypeController');
Route::get('/get/all/UserType','UserTypeController@getAllUserType')->name('all.UserType');

Route::resource('UserInfo','UserInfoController');
Route::get('/get/all/UserInfo','UserInfoController@getAllUserInfo')->name('all.UserInfo');
Route::post('UserLogin','UserInfoController@userLogin');

Route::resource('ProductType','ProductTypeController');
Route::get('/get/all/ProductType','ProductTypeController@getAllproduct_type')->name('all.ProductType');


Route::resource('CategoriesInfo','CategoryInfoController');
Route::get('/get/all/Categories','CategoryInfoController@getAllcategories')->name('all.Categories');

Route::resource('SubCategoryInfo','SubCategoryInfoController');
Route::get('/get/all/SubCategories','SubCategoryInfoController@getAllcategories_sub')->name('all.CategoriesSub');

Route::resource('ProductInfo','ProductInfoController');
Route::get('/get/all/ProductInfo','ProductInfoController@getAllProductInfo')->name('all.ProductInfo');

Route::resource('ProductStock','ProductStockController');
Route::get('/get/all/ProductStock','ProductStockController@getAllStockInfo')->name('all.ProductStock');

Route::resource('UserAssigned','UserAssignedController');
Route::get('/get/all/UserAssigned','UserAssignedController@getAllUserAssigned')->name('all.UserAssigned');


Route::get('DivisionInfo','LocationInfoController@viewDivisionInfo');
Route::get('/get/all/DivisionInfo','LocationInfoController@getDivisionInfo')->name('all.viewDivisionInfo');
Route::get('DistrictInfo','LocationInfoController@viewDistrictInfo');
Route::get('/get/all/DistrictInfo','LocationInfoController@getDistrictInfo')->name('all.viewDistrictInfo');
Route::get('ThanaInfo','LocationInfoController@viewThanaInfo');
Route::get('/get/all/ThanaInfo','LocationInfoController@getThanaInfo')->name('all.viewThanaInfo');
Route::get('AreaInfo','LocationInfoController@viewAreaInfo');
Route::get('/get/all/AreaInfo','LocationInfoController@getAreaInfo')->name('all.viewAreaInfo');
Route::get('OutletInfo','LocationInfoController@viewOutletInfo');
Route::get('/get/all/OutletInfo','LocationInfoController@getOutletInfo')->name('all.viewOutletInfo');


Route::post('/customer-login','CheckoutController@customerLogin');
Route::post('ShowSubCategorie','ProductInfoController@showSubCat');
Route::get('/customer-logout','CheckoutController@customerLogOut');

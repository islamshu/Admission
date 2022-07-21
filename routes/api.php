<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group(['middleware' => [ 'changeLanguage']], function () {
Route::get('natonality','Api\HomeController@natonality');
Route::get('worker_by_natonality','Api\HomeController@worker_by_natonality');
Route::get('copmanies','Api\HomeController@compnaines');
Route::get('company/{id}','Api\HomeController@company');
Route::get('workers','Api\HomeController@workers');
Route::get('worker/{id}','Api\HomeController@worker');
Route::get('workers_filter','Api\HomeController@workers_filter');
Route::get('search','Api\HomeController@search');
Route::get('contact', 'Api\HomeController@contact');
Route::get('privacy-policy', 'Api\HomeController@privacy');
Route::get('about-us', 'Api\HomeController@abouts');
Route::get('FAQs','Api\HomeController@faqs');
Route::get('general','Api\HomeController@general');
Route::get('count_vist','Api\HomeController@count_vist');
Route::post('request_worker','Api\HomeController@request_worker');
Route::post('contact_form','Api\HomeController@contact_form');
Route::get('city','Api\HomeController@city');
Route::post('login','Api\HomeController@login');
Route::post('register','Api\HomeController@register');
Route::post('check_otp','Api\HomeController@check_otp');
Route::post('resend_otp','Api\HomeController@resend_otp');
Route::get('my_order','Api\HomeController@my_order');
Route::get('my_order_not_avilable','Api\HomeController@my_order_not_avilable');
Route::get('delete_my_order/{id}','Api\HomeController@delete_my_order');
Route::get('delete_my_order_unavilable/{id}','Api\HomeController@delete_my_order_unavilable');

Route::post('new_login_or_register','Api\HomeController@new_login');
Route::post('check_otp_new','Api\HomeController@check_otp_new');
Route::post('login_company','Api\HomeController@new_login_company');
Route::post('check_otp_company','Api\HomeController@check_otp_new_company');
Route::get('get_all_worker','Api\HomeController@get_all_worker');
Route::get('logout','Api\HomeController@logout');
Route::post('update_profile','Api\HomeController@update_profile');
Route::get('my_profile','Api\HomeController@my_profile');
Route::post('store_worker','Api\HomeController@store_worker');
Route::get('check_booking/{id}','Api\HomeController@check_booking');




});


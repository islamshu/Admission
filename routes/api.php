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
Route::get('contact', 'Api\HomeController@contact');
Route::get('privacy-policy', 'Api\HomeController@privacy');
Route::get('about-us', 'Api\HomeController@abouts');
Route::get('FAQs','Api\HomeController@faqs');
Route::get('general','Api\HomeController@general');
Route::post('request_worker','Api\HomeController@request_worker');
Route::post('contact_form','Api\HomeController@contact_form');
});


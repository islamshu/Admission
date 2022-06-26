<?php

use Illuminate\Support\Facades\Route;
use Spatie\Permission\Contracts\Role;

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



// Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::group(['middleware' =>['auth'],'prefix'=>'dashbaord'], function() {

Route::get('/','UserController@dashboard')->name('dashboard');
Route::get('logout','UserController@logout')->name('logout');
Route::get('edit-profile','UserController@edit_profile')->name('edit_profile');
Route::post('edit-profile','UserController@update_profile')->name('update.profile');
Route::resource('worker','WorkerController');
Route::get('booking','BookingController@index')->name('booking.get');
Route::get('booking_company/{id}','BookingController@get_booking_company')->name('booking.get_all');
Route::get('booking_show/{id}','BookingController@show')->name('booking.show');
Route::post('nationalities_store','NationalityController@store_ajax')->name('nationalities.store_ajax');
Route::get('privacy','PrivacyController@index')->name('privacy.index');
Route::post('privacy','PrivacyController@store')->name('privacy.store');
Route::delete('privacy/{id}','PrivacyController@destroy')->name('privacy.delete');
Route::post('update_sort_privacy','PrivacyController@update_sort')->name('update_sort_privacy');
Route::get('faqs','FaqsController@index')->name('faqs.index');
Route::post('faqs','FaqsController@store')->name('faqs.store');
Route::delete('faqs/{id}','FaqsController@destroy')->name('faqs.delete');
Route::post('update_sort_faqs','FaqsController@update_sort')->name('update_sort_faqs');
Route::get('about','AboutController@index')->name('about.index');
Route::post('about','AboutController@store')->name('about.store');
Route::delete('about/{id}','AboutController@destroy')->name('about.delete');
Route::post('update_sort_about','AboutController@update_sort')->name('update_sort_about');
Route::get('social_info','SocialController@index')->name('social_info'); 
Route::post('social_info_post','SocialController@store')->name('social_info_post'); 




});

Route::group(['middleware' =>['role:Admin'],'prefix'=>'dashbaord'], function() {
    
    Route::resource('roles','RoleController');
    Route::resource('users','UserController');
    Route::resource('country','CountryController');
    Route::resource('nationalities','NationalityController');
    Route::post('get_natonlity_edit','NationalityController@get_natonlity_edit')->name('get_natonlity_edit');
    Route::resource('companies','CompanyController');
    Route::post('companies','CompanyController@store_admin')->name('companies.store_admin');
    Route::post('get_compnay_edit','CompanyController@get_compnay_edit')->name('get_compnay_edit');
    Route::get('comapny/status/update', 'CompanyController@updateStatus')->name('comapny.update.status');


});
Route::get('login','UserController@show_login_form')->name('get_login');
Route::post('regiser_company','CompanyController@store')->name('post_register');
Route::post('check_otp','CompanyController@check_otp')->name('check_otp');

Route::get('regiser_company','CompanyController@get_register')->name('register_company');

Route::post('post_login','UserController@process_login')->name('process_login');

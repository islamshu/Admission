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
Route::get('booking_pdf/{id}/', 'BookingController@pdf_view')->name('pdf_view');

Route::group(['middleware' =>['auth'],'prefix'=>'dashbaord'], function() {

Route::get('/','UserController@dashboard')->name('dashboard');
Route::get('logout','UserController@logout')->name('logout');
Route::get('edit-profile','UserController@edit_profile')->name('edit_profile');
Route::post('edit-profile','UserController@update_profile')->name('update.profile');
Route::resource('worker','WorkerController');
Route::get('booking','BookingController@index')->name('booking.get');
Route::get('booking_all','BookingController@index_all')->name('booking.get_all_booking');

Route::get('booking-unavalible','BookingController@unavliable')->name('booking.unavilable');
Route::get('booking-unavalible/{id}','BookingController@show_unavliable')->name('booking.unavilable.show');

Route::get('booking_company/{id}','BookingController@get_booking_company')->name('booking.get_all');
Route::get('booking_show/{id}','BookingController@show')->name('booking.show');
Route::post('nationalities_store','NationalityController@store_ajax')->name('nationalities.store_ajax');
Route::post('update_status_worker','WorkerController@update_status_worker')->name('update_status_worker');
Route::post('update_month_worker','WorkerController@update_month_worker')->name('update_month_worker');

Route::post('update_status_booked','BookingController@update_status_booked')->name('update_status_booked');
Route::get('show_notification/{id}','HomeController@notification')->name('show.notification');
Route::get('read_all_notofication','HomeController@read_all_notofication')->name('read_all_notofication');
Route::get('change_chart','UserController@change_chart')->name('change_chart');
Route::get('booking_clinet/{id}','BookingController@booking_clinet')->name('booking_clinet');

Route::get('wrokers/export/', 'WorkerController@export')->name('export');
Route::get('booking/export/', 'BookingController@export')->name('booking.export');

Route::get('wrokers/pdf/', 'WorkerController@downloadPDF')->name('pdf');
Route::get('pdf_booking/', 'BookingController@downloadPDF')->name('pdf_booking');
Route::get('pdf_worker/{id}/', 'WorkerController@get_one_pdf')->name('get_one_pdf');
Route::get('setting_booked/', 'CompanyController@setting_booked')->name('company.setting');


Route::get('updateStatusWorker/', 'WorkerController@updateStatus')->name('worker.update.status');
});

Route::group(['middleware' =>['role:Admin'],'prefix'=>'dashbaord'], function() {
    
    // Route::resource('roles','RoleController');
    // Route::resource('users','UserController');
    Route::resource('country','CountryController');
    Route::get('clients','UserController@clients')->name('clients.index');
    Route::resource('nationalities','NationalityController');
    Route::post('get_natonlity_edit','NationalityController@get_natonlity_edit')->name('get_natonlity_edit');
    Route::resource('companies','CompanyController');
    Route::post('companies','CompanyController@store_admin')->name('companies.store_admin');
    Route::post('get_compnay_edit','CompanyController@get_compnay_edit')->name('get_compnay_edit');
    Route::get('comapny/status/update', 'CompanyController@updateStatus')->name('comapny.update.status');
    Route::get('comapny/status/is_same', 'CompanyController@updatesame')->name('comapny.update.is_same');

    
    Route::get('social_info','SocialController@index')->name('social_info'); 
    Route::post('social_info_post','SocialController@store')->name('social_info_post'); 
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
    Route::get('language_translate/{local}','HomeController@show_translate')->name('show_translate');
    Route::post('/languages/key_value_store', 'HomeController@key_value_store')->name('languages.key_value_store');
    Route::get('general','HomeController@general')->name('generalinfo.index');
    Route::post('general','HomeController@store')->name('generalinfo.store');
    Route::get('clients/create','UserController@create_client')->name('client_create.create');
    Route::post('clients/store','UserController@store_client')->name('client_create.store_client');
    Route::get('clients/edit/{id}','UserController@edit_client')->name('client_create.edit_client');
    Route::post('clients/update/{id}','UserController@update_client')->name('client_create.update_client');
    Route::delete('clients/delete/{id}','UserController@delete_client')->name('client_create.delete_client');   

});
Route::get('login','UserController@show_login_form')->name('get_login');
Route::post('regiser_company','CompanyController@store')->name('post_register');
Route::post('check_otp','CompanyController@check_otp')->name('check_otp');

Route::get('regiser_company','CompanyController@get_register')->name('register_company');

Route::post('post_login','UserController@process_login')->name('process_login');

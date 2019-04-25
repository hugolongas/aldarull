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

Route::get('/', ['uses' => 'HomeController@Index', 'as' => 'index']);
Route::get('/file/{id}', ['uses' => 'HomeController@getDownload', 'as' => 'index.getDownload']);
Route::post('/contact', ['as' => 'contact_store', 'uses' => 'HomeController@contact']);
Route::get('/agenda', ['uses' => 'ScheduleController@Index', 'as' => 'schedule']);
Route::get('/multimedia', ['uses' => 'GalleryController@Index', 'as' => 'gallery']);
Route::get('/descarregues', ['uses' => 'DownloadController@Index', 'as' => 'download']);
Route::get('/botiga', ['uses' => 'ProductController@Index', 'as' => 'shop']);
Route::get('/botiga/{url}', ['uses' => 'ProductController@Show', 'as' => 'product.show']);
Route::get('/coneixens', ['uses' => 'PageController@getQuiSom', 'as' => 'weare']);
Route::get('cistella', ['uses' => 'CartController@index', 'as' => 'cart']);
Route::post('cistella', 'CartController@store');
Route::post('cistella/finalitzar', 'CartController@purchase');
Route::post('cistella/{id}', 'CartController@update');
Route::delete('cistella/{id}', 'CartController@destroy');
Route::get('/descarregues/{id}', ['uses' => 'DownloadController@getDownload', 'as' => 'download.file']);
Route::view('/cistella/dades', 'shop.cart_contact');
Route::delete('emptyCart', 'CartController@emptyCart');
Route::get('/contacte', ['uses' => function () {
	return View('contact');
}, 'as' => 'contact']);
Route::get('/politica-cookies.html', function () {
	return View('cookies');
});
Route::get('/politica-privacitat.html', function () {
	return View('privactitat');
});

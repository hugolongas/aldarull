<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/

Auth::routes();
Route::group(['middleware' => ['auth']], function() {
//Index
Route::get('/', ['uses'=>'HomeController@IndexAdmin','as'=>'admin.index']);
Route::get('/comanda/getData', ['uses'=>'ComandaController@getData','as'=>'admin.index.data']);
Route::get('/comanda/{id}', ['uses'=>'ComandaController@Show','as'=>'admin.comanda.show']);
Route::get('/comanda/finalitzar/{id}', ['uses'=>'ComandaController@Finish','as'=>'admin.comanda.finish']);
Route::put('/comanda/acabar/{id}', ['uses'=>'ComandaController@Close','as'=>'admin.comanda.close']);

//Portada
Route::get('/portada',['uses'=>'CoverController@IndexAdmin','as'=>'admin.cover.index']);
Route::get('/portada/crear/{id}',['uses'=>'CoverController@Create','as'=>'admin.cover.create']);
Route::post('/portada/guardar',['uses'=>'CoverController@Store','as'=>'admin.cover.store']);
Route::get('/portada/editar/{id}',['uses'=>'CoverController@Edit','as'=>'admin.cover.edit']);
Route::put('/portada/actualitzar',['uses'=>'CoverController@Update','as'=>'admin.cover.update']);
Route::post('/portada/eliminar/{id}',['uses' => 'CoverController@Delete', 'as' => 'admin.cover.delete']);

//Agenda
Route::get('/agenda',['uses'=>'ScheduleController@IndexAdmin','as'=>'admin.schedule.index']);
Route::get('/agenda/getData', ['uses'=>'ScheduleController@getData','as'=>'admin.schedule.data']);
Route::get('/agenda/detall/{id}',['uses' => 'ScheduleController@Show', 'as' => 'admin.schedule.show']);
Route::get('/agenda/crear',['uses' => 'ScheduleController@Create', 'as' => 'admin.schedule.create']);
Route::post('/agenda/guardar',['uses'=>'ScheduleController@Store','as' =>'admin.schedule.store']);
Route::get('/agenda/editar/{id}',['uses' => 'ScheduleController@Edit', 'as' => 'admin.schedule.edit']);
Route::put('/agenda/actualitzar',['uses'=>'ScheduleController@Update','as'=>'admin.schedule.update']);
Route::post('/agenda/eliminar/{id}',['uses'=>'ScheduleController@Delete','as'=>'admin.schedule.delete']);
Route::post('/agenda/activar',['uses'=>'ScheduleController@Activate','as'=>'admin.schedule.activate']);

//Galeria
Route::get('/galeria',['uses'=>'GalleryController@IndexAdmin','as'=>'admin.gallery.index']);
Route::post('/galeria/cargar',['uses'=>'GalleryController@Upload','as'=>'admin.gallery.upload']);
Route::post('/galeria/actualitzar',['uses' => 'GalleryController@SaveGallery', 'as' => 'admin.gallery.update']);
Route::post('/galeria/eliminar/{id}',['uses' => 'GalleryController@Delete', 'as' => 'admin.gallery.delete']);
Route::post('/galeria/eliminarImg/{id}',['uses' => 'GalleryController@RemoveImg', 'as' => 'admin.gallery.remove']);

//Tenda
Route::get('/productes',['uses'=>'ProductController@IndexAdmin','as'=>'admin.product.index']);
Route::get('/productes/getData', ['uses'=>'ProductController@getData','as'=>'admin.product.data']);
Route::get('/productes/detall/{id}',['uses' => 'ProductController@Show', 'as' => 'admin.product.show']);
Route::get('/productes/crear',['uses' => 'ProductController@Create', 'as' => 'admin.product.create']);
Route::post('/productes/guardar',['uses' => 'ProductController@Store', 'as' => 'admin.product.store']);
Route::get('/productes/editar/{id}',['uses' => 'ProductController@Edit', 'as' => 'admin.product.edit']);
Route::put('/productes/actualitzar',['uses' => 'ProductController@Update', 'as' => 'admin.product.update']);
Route::post('/productes/eliminar/{id}',['uses' => 'ProductController@Delete', 'as' => 'admin.product.delete']);
Route::post('/productes/activar',['uses'=>'ProductController@Activate','as'=>'admin.product.activate']);

//Descarregues
Route::get('/descarregues',['uses'=>'DownloadController@IndexAdmin','as'=>'admin.download.index']);
Route::get('/descarregues/getData', ['uses'=>'DownloadController@getData','as'=>'admin.download.data']);
Route::get('/descarregues/crear',['uses'=>'DownloadController@Create','as'=>'admin.download.create']);
Route::post('/descarregues/guardar',['uses' => 'DownloadController@Store', 'as' => 'admin.download.store']);
Route::get('/descarregues/editar/{id}',['uses' => 'DownloadController@Edit', 'as' => 'admin.download.edit']);
Route::put('/descarregues/actualitzar',['uses' => 'DownloadController@Update', 'as' => 'admin.download.update']);
Route::post('/descarregues/eliminar/{id}',['uses' => 'DownloadController@Delete', 'as' => 'admin.download.delete']);


//Tenda Extres
Route::get('/productes_extras',['uses'=>'ExtraController@Index','as'=>'admin.product.extra.index']);
Route::get('/productes_extras/getData', ['uses'=>'ExtraController@getData','as'=>'admin.product.extra.data']);
Route::get('/productes_extras/crear',['uses' => 'ExtraController@Create', 'as' => 'admin.product.extra.create']);
Route::post('/productes_extras/guardar',['uses' => 'ExtraController@Store', 'as' => 'admin.product.extra.store']);
Route::get('/productes_extras/editar/{id}',['uses' => 'ExtraController@Edit', 'as' => 'admin.product.extra.edit']);
Route::put('/productes_extras/actualitzar',['uses' => 'ExtraController@Update', 'as' => 'admin.product.extra.update']);
Route::post('/productes_extras/eliminar/{id}',['uses' => 'ExtraController@Delete', 'as' => 'admin.product.extra.delete']);
//Tenda Tipus Extres
Route::get('/extras_tipus',['uses'=>'ExtraTypeController@Index','as'=>'admin.product.extraType.index']);
Route::get('/extras_tipus/getData', ['uses'=>'ExtraTypeController@getData','as'=>'admin.product.extraType.data']);
Route::get('/extras_tipus/crear',['uses' => 'ExtraTypeController@Create', 'as' => 'admin.product.extraType.create']);
Route::post('/extras_tipus/guardar',['uses' => 'ExtraTypeController@Store', 'as' => 'admin.product.extraType.store']);
Route::get('/extras_tipus/editar/{id}',['uses' => 'ExtraTypeController@Edit', 'as' => 'admin.product.extraType.edit']);
Route::put('/extras_tipus/actualitzar',['uses' => 'ExtraTypeController@Update', 'as' => 'admin.product.extraType.update']);
Route::post('/extras_tipus/eliminar/{id}',['uses' => 'ExtraTypeController@Delete', 'as' => 'admin.product.extraType.delete']);

//Pagines
Route::get('/pagines',['uses'=>'PageController@Index','as'=>'admin.page.index']);
Route::get('/pagines/getData', ['uses'=>'PageController@getData','as'=>'admin.page.data']);
Route::get('/pagines/detall/{id}',['uses' => 'PageController@Show', 'as' => 'admin.page.show']);
Route::get('/pagines/crear',['uses' => 'PageController@Create', 'as' => 'admin.page.create']);
Route::post('/pagines/guardar',['uses'=>'PageController@Store','as'=>'admin.page.store']);
Route::get('/pagines/editar/{id}',['uses' => 'PageController@Edit', 'as' => 'admin.page.edit']);
Route::put('/pagines/actualitzar',['uses' => 'PageController@Update', 'as' => 'admin.page.update']);
Route::post('/pagines/eliminar/{id}',['uses' => 'PageController@Delete', 'as' => 'admin.page.delete']);

//Recursos
Route::get('/recursos',['uses'=>'ResourceController@Index','as'=>'admin.resource.index']);
Route::get('/recursos/getData', ['uses'=>'ResourceController@getData','as'=>'admin.resource.data']);
Route::get('/recursos/crear',['uses' => 'ResourceController@Create', 'as' => 'admin.resource.create']);
Route::post('/recursos/guardar',['uses'=>'ResourceController@Store','as'=>'admin.resource.store']);
Route::get('/recursos/editar/{id}',['uses' => 'ResourceController@Edit', 'as' => 'admin.resource.edit']);
Route::put('/recursos/actualitzar',['uses' => 'ResourceController@Update', 'as' => 'admin.resource.update']);
Route::post('/recursos/eliminar/{id}',['uses' => 'ResourceController@Delete', 'as' => 'admin.resource.delete']);
});

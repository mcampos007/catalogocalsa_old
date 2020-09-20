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

Route::get('/', 'TestController@welcome');

Route::get('/search', 'SearchController@show');
Route::get('/products/json', 'SearchController@data');

Route::get('/products/{id}', 'ProductController@show');
Route::get('/categories/{category}', 'CategoryController@show');


Route::post('/cart', 'CartDetailController@store');
Route::delete('/cart','CartDetailController@destroy');


Route::post('/order','CartController@update');
Route::post('/feedback','FeedbackController@update');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth','admin'])->prefix('admin')->namespace('Admin')->group(function(){
	//Productos 
	Route::get('/products','ProductController@index');
	Route::get('/products/create','ProductController@create');
	Route::post('/products','ProductController@store');

	Route::get('/products/{id}/edit','ProductController@edit');
	Route::post('/products/{id}/edit','ProductController@update');

	Route::delete('/products/{id}','ProductController@destroy');

	Route::get('/products/{id}/images','ImageController@index');  //Listado de Imágenes
	Route::post('/products/{id}/images','ImageController@store');
	Route::delete('/products/{id}/images','ImageController@destroy');	
	Route::get('/products/{id}/images/select/{image}','ImageController@select');

	//Promociones
	Route::get('/promotions','PromotionController@index');
	Route::get('/promotions/create','PromotionController@create');
	Route::post('/promotions','PromotionController@store');

	Route::get('/promotions/{id}/edit','PromotionController@edit');
	Route::post('/promotions/{id}/edit','PromotionController@update');

	Route::delete('/promotions/{id}','PromotionController@destroy');

	Route::get('/promotions/{id}/images','PromoImageController@index');  //Listado de Imágenes
	Route::post('/promotions/{id}/images','PromoImageController@store');
	Route::delete('/promotions/{id}/images','PromoImageController@destroy');	
	Route::get('/promotions/{id}/images/select/{image}','PromoImageController@select');

	//Categorias

	Route::get('/categories','CategoryController@index');
	Route::get('/categories/create','CategoryController@create');
	Route::post('/categories','CategoryController@store');

	Route::get('/categories/{id}/edit','CategoryController@edit');
	Route::post('/categories/{id}/edit','CategoryController@update');

	Route::delete('/categories/{id}','CategoryController@destroy');

	Route::get('/categories/{id}/images','CategoryImageController@index');  //Listado de Imágenes
	Route::post('/categories/{id}/images','CategoryImageController@store');
	Route::delete('/categories/{id}/images','CategoryImageController@destroy');	
	Route::get('/categories/{id}/images/select/{image}','CategoryImageController@select');


	//Clientes
	Route::get('/clients','ClientController@index');		// Listado de clienteas
	Route::get('/clients/create','ClientController@create');	// Form de Alta de clientes
	Route::post('/clients','ClientController@store');			// Rergistro del cliete en la BD

	Route::get('/clients/{id}/edit', 'ClientController@edit');		//Form de Edicion del cliente
	Route::post('/clients/{id}/edit','ClientController@update');  // Actualización de la bd

	Route::delete('/clients/{id}','ClientController@destroy');  // eliminar un cliente

	//Remitos
	Route::get('/remito/{id}','CartController@vercart');						//Ver Contenido del Remito
	Route::get('/remito/{id}/edit', 'CartController@edit');						//Form de Edicion del Remito
	Route::get('/remito/{id}/facturar', 'CartController@facturarremito');		//Form de Facturacion del Remito
	Route::post('/remito/facturar', 'CartController@update');					//Confirmar Facturar Remito

	Route::get('/remito/{id}/excel', 'CartController@excel');					//Enviar el Rmito a Excel
	Route::get('/remito/{id}/remitopdf', 'CartController@remitopdf');			//Enviar el Rmito a Pdf

	//Pagos
	Route::get('/pagos','PaymentController@index');								//Listado de Clientes para Pagos
	Route::get('/pagos/{id}/nuevopago','PaymentController@nuevopago');			//Formulario de Pagos
	Route::post('/pagos','PaymentController@store');							// Rergistro del pago en la BD




});

<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Creamos las rutas nuevas que tendrán en cuenta
// los controllers programados en Controllers.

// Ruta /fabricantes/.....
Route::resource('fabricantes','FabricanteController',['except'=>['create']]);

// Ruta /aviones/.....
Route::resource('aviones','AvionController');

// Ruta por defecto /
Route::get('/', function()
	{
		return "Bienvenido API RESTful de Aviones.";
	});



/*
Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
*/
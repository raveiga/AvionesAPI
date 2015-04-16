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
Route::resource('fabricantes','FabricanteController',['except'=>['edit','create']]);

// Recurso anidado /fabricantes/xx/aviones/xxx
Route::resource('fabricantes.aviones','FabricanteAvionController',['except'=>['edit','create','show']]);

// Ruta /aviones/..... El resto de métodos los gestiona FabricanteAvion
Route::resource('aviones','AvionController',['only'=>['index','show']]);


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
<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api/'], function ($router) {
	$router->get('/dex', 'dexController@index');
	$router->get('/dex/{id}', 'dexController@show');
	$router->get('/species', 'speciesController@index');
	$router->get('/species/{id}', 'speciesController@show');
	$router->get('/species/pokemons/{id}', 'speciesController@pokemons');
});

$router->get('/dex/test', 'dexController@test');
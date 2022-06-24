<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Http\Controllers\PostController;

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

$router->group(['prefix' => 'posts'], function () use ($router) {
    $router->get('home', 'PostController@index');
    $router->get('article/show/{limit}/{offset}', 'PostController@show');
    $router->get('article/{id}/edit', 'PostController@edit');
    $router->post('article', 'PostController@store');
    $router->post('article/{id}/destroy', 'PostController@destroy');
    $router->post('article/{id}/update', 'PostController@update');
});

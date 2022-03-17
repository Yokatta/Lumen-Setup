<?php
use App\Http\Controllers\UserController;
use App\Http\Controllers\NoteController;

/** @var \Laravel\Lumen\Routing\Router $router */

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

    $router->get('login/','UserController@authenticate');
    $router->post('signup/','UserController@store');
    $router->post('note/','NoteController@store');
    $router->get('note/', 'NoteController@index');
    $router->get('note/{id}/', 'NoteController@show');
    $router->post('note/{id}/', 'NoteController@update');
    $router->delete('note/{id}/', 'NoteController@destroy');
    });

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

$router->get('/', 'AppController@showIndex');
$router->get('/domains', 'AppController@showForm');
$router->post('/domains', 'AppController@create');
$router->get('/domains/{id}', 'AppController@showDomain');

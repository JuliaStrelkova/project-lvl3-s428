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

$router->get('/', ['as'=>'index', 'uses'=>'AppController@showIndex']);
$router->get('/domains',['as'=> 'domains.createForm','uses'=> 'AppController@showCreateForm']);
$router->post('/domains',['as'=>'domains.store', 'uses'=> 'AppController@store']);
$router->get('/domains/{id}',['as'=>'domains.show','uses'=> 'AppController@show']);

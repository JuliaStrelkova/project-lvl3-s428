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

$router->get('/', ['as'=>'index', 'uses'=>'DomainsController@showIndex']);
$router->get('/domains',['as'=>'domains.list', 'uses'=> 'DomainsController@showList']);
$router->post('/domains',['as'=>'domains.store', 'uses'=> 'DomainsController@store']);
$router->get('/domains/{id}',['as'=>'domains.show','uses'=> 'DomainsController@show']);
$router->get('/domains/{id}/download',['as'=>'domains.download','uses'=> 'DomainsController@downloadBody']);

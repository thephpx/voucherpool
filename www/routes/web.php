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

// $router->get('/', function () use ($router) {
//     return view('index');
// });
$router->get('/', 'ApplicationController@index');
$router->get('/vouchers/{id}', 'ApplicationController@voucher');
$router->get('/vouchers/redeem/{id}', 'ApplicationController@redeem');

$router->get('/api/recepients','RecepientController@index');
$router->get('/api/recepients/{id}','RecepientController@get');
$router->put('/api/recepients','RecepientController@create');
$router->post('/api/recepients/{id}','RecepientController@update');
$router->delete('/api/recepients/{id}','RecepientController@delete');

$router->get('/api/offers','OfferController@index');
$router->get('/api/offers/{id}','OfferController@get');
$router->put('/api/offers','OfferController@create');
$router->post('/api/offers/{id}','OfferController@update');
$router->delete('/api/offers/{id}','OfferController@delete');


$router->get('/api/vouchers','VoucherController@index');
$router->get('/api/vouchers/{id}','VoucherController@get');
$router->put('/api/vouchers/{id}','VoucherController@create');
$router->post('/api/vouchers/redeem/{id}','VoucherController@redeem');

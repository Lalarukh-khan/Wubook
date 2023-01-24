<?php


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

// $router->get('/', function () use ($router) {
//     return $router->app->version();
// });

$router->get('/', function () {
    return ["app_name" => "My Lumen App"];
});
//Rooms 
$router->get('/list', 'RoomController@list');
$router->post('/add-room', 'RoomController@store');
$router->post('/add-virtual-room', 'RoomController@virtual');
$router->post('/update-room', 'RoomController@update');
$router->post('/delete-room', 'RoomController@delete');

//Prices
$router->post('/add-plan', 'PriceController@store');
$router->post('/update-plan', 'PriceController@update');
$router->post('/delete-plan', 'PriceController@delete');
$router->get('/list-plan', 'PriceController@list');
$router->post('/update-price', 'PriceController@price');

//Availability
$router->post('/update-availability', 'AvailController@update');

//Reservations
$router->post('/add-reservation', 'ReservationController@new');
$router->post('/cancel-reservation', 'ReservationController@delete');
$router->get('/all-reservations', 'ReservationController@list');
$router->get('/single-reservation', 'ReservationController@single');
$router->post('/push-activation', 'ReservationController@activation');
$router->post('/push-url', 'ReservationController@push_url');
$router->post('/fresh-reservations', 'ReservationController@fresh');

//Restrictions
$router->post('/add-restriction', 'RestrictionsController@add');
$router->post('/delete-restriction', 'RestrictionsController@delete');
$router->get('/all-restrictions', 'RestrictionsController@list');
$router->post('/rename-restriction', 'RestrictionsController@rename');
$router->post('/rplan-values', 'RestrictionsController@values');
$router->post('/rplan-rules', 'RestrictionsController@rules');

$router->get('/api/v1/ping/wubook', 'TestController@test');
$router->post('/push-notification', 'UrlController@url');

$router->get('check', function () {
    return view('check');
});

$router->get('url', function () {
    return view('url');
});

<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*$router->group(
    [
        'namespace' => 'Appointment',
        'prefix' => 'appointment'
    ],
    function () use ($router) {
        $router->get('/',  'ListController@list')->name('appointment.list');
        $router->get('/create',  'Appointment@create')->name('appointment.create');
    }
);*/

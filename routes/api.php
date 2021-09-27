<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::group([
    'prefix' => 'v1',
    //'middleware' => 'forceJsonRequest',
], function ($router) {

    // appointment routes
    $router->group(
        [
            'namespace' => 'Appointment',
            'prefix' => 'appointment'
        ],
        function () use ($router) {
            $router->post('/',  'ListController@list');
            $router->post('/schedule',  'ScheduleController@schedule');
        }
    );

    // workshop routes
    $router->group(
        [
            'namespace' => 'Workshop',
            'prefix' => 'workshop'
        ],
        function () use ($router) {
            $router->post('/recommend',  'RecommendController@recommend');
        }
    );
});

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

$app->get('/', function() use ($app) {
    return view('index');
});


$app->get('api/entry', 'EntryController@index');
$app->post('api/entry', 'EntryController@store');
$app->delete('api/entry/{id}', 'EntryController@destroy');

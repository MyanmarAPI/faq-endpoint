<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

$app->get('/', function() use ($app) {
    return $app->welcome();
});

$app->group(['middleware' => 'apiVerify','prefix'=>'faq/api/v1/faq','namespace' => 'App\Http\Controllers'], function () use ($app)
{
    $app->get('/','FaqController@index');

    $app->get('/question/{id}','FaqController@getFaq');

    $app->get('/find-question','FaqController@getFaqByQuestion');

    $app->get('/type','FaqController@getFaqByType');
    
    $app->get('/section','FaqController@getFaqBySections');
    
});

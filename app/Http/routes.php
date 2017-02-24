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

$app->group(['middleware' => 'auth','prefix'=>'faq/v1','namespace' => 'App\Http\Controllers'], function () use ($app)
{
    $app->get('/list','FaqController@index');

    $app->get('/search','FaqController@getFaqByQuestion');

    $app->get('/{id}','FaqController@getFaq');
    
});

$app->group([
	'middleware' => 'auth',
	'prefix'=>'voteredu',
	'namespace' => 'App\Http\Controllers'
	], function() use($app) 
{
	$app->get('/ballots/{type}', 'BallotController@getByType');
});

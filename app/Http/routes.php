<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/
Route::group(['middleware' => 'web'], function () {
    Route::auth();
    Route::resource('message', 'MessageController');
});

//Route::group(['prefix' => 'ajax'], function() {
//    Route::post('/message/show', 'MessageController@show');
//});

Route::post('/addmsg','MessageController@store');
Route::post('/getmsg','MessageController@show');

Route::get('test', function() {
    if (\Cache::has('test')) {
        echo '存在chche,读取' . '<br />';
        echo \Cache::get('test');
    } else {
        echo '不存在cache,现在创建' . '<br />';
        $time = \Carbon\Carbon::now()->addMinutes(10);
        $redis = \Cache::add('test', '我是缓存资源', $time);
        echo \Cache::get('test');
    }
});
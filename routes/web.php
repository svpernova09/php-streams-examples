<?php

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

Route::get('/test', function() {


    $context = [
        'http' => [
            'method' => "POST",
            'header' => "Auth: ApiKeyIsHunter2"
                ."Content-type: application/x-www-form-urlencoded"
                ."Content-length: " . strlen("Posting Content!"),
            'content' => 'Posting Content!'
        ]
    ];
    $default = stream_context_get_default($context);
    file_put_contents('http://myapp.test/post-route');



});
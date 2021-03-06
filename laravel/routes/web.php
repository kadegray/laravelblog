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
    return redirect('/post');
});

Auth::routes();

Route::resource('/post', 'PostController')->names([
    'index' => 'post',
    'show' => 'post.single',
]);
Route::get('/post/{post}/image', 'PostController@downloadHeaderImage')->name('post.headerImage');

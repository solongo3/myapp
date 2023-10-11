<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', 'App\Http\Controllers\PagesController@index');
Route::get('/about', 'App\Http\Controllers\PagesController@about');
Route::get('/services', 'App\Http\Controllers\PagesController@services');
Route::post('/posts', 'App\Http\Controllers\PostsController@store');

// Route::get('/hello', function () {
//     return '<h1> hello laravel </h1>';
// });


// Route::get('/about', function () {
//     return view('pages.about');
// });

// Route::get('/users/{id}/{name}', function ($id, $name) {
//     return 'This is user: '.$id.' and this is name: '.$name;
// });
Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index']);
use App\Http\Controllers\PostsController;
Route::resource('posts' , PostsController::class);
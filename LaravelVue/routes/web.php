<?php
use App\Task;
use App\User;

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


Route::post('todo', 'TaskController@todo');

Route::get('getTasks', 'TaskController@getTasks');

Route::post('deleteTask','TaskController@deleteTask');

Route::post('updateTask','TaskController@updateTask');

Route::post('reset','TaskController@reset');

Route::get('getUsers','UserController@getUsers');

Route::get('{any}', function () {
    return view('welcome');
})->where('any','.*');
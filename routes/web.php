<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', 'IndexController@index')->name('home');

Auth::routes();

Route::get('/admin', 'AdminController@index')->name('admin');

Route::get('/sectors', 'SectorController@index')->name('sectors');

Route::resource('admin/events', EventController::class);
Route::resource('admin/users', UserRightsController::class);

Route::post('tickets/{eventId}', 'ReservationController@store')->name('tickets.create');


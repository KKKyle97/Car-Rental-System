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
})->name('welcome');

Route::resources([
    'cars' => 'CarController',
    'rentals' => 'RentalController',
    'customers' => 'CustomerController',
]);

Route::get('book/','RentalController@book')->name('rentals.book');
Route::get('/book/search','RentalController@search')->name('rentals.search');
Route::get('/book/search/create/{id}','RentalController@create')->name('rentals.create');
Route::get('/book/search/{category}','RentalController@sort')->name('rentals.sort');
Route::get('/book/search/result','RentalController@sort')->name('rentals.result');
Route::get('/book/view','RentalController@view')->name('rentals.view');
Route::get('/book/gallery','RentalController@showall')->name('rentals.gallery');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

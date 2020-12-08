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


//Accessories routes
Route::get('models/show', 'ModelsController@home');
Route::get('models/add', 'ModelsController@add');
Route::get('models/profile/{id}', 'ModelsController@profile');
Route::post('models/update', 'ModelsController@update');
Route::post('models/insert', 'ModelsController@insert');
Route::get('models/toggle/main/{id}', 'ModelsController@toggleMain');
Route::get('models/toggle/active/{id}', 'ModelsController@toggleActive');

//Accessories routes
Route::get('accessories/show', 'AccessoriesController@home');
Route::get('accessories/edit/{id}', 'AccessoriesController@edit');
Route::post('accessories/update', 'AccessoriesController@update');
Route::post('accessories/insert', 'AccessoriesController@insert');

//Types routes
Route::get('types/show', 'CarTypesController@home');
Route::get('types/edit/{id}', 'CarTypesController@edit');
Route::post('types/update', 'CarTypesController@update');
Route::post('types/insert', 'CarTypesController@insert');
Route::get('types/toggle/{id}', 'CarTypesController@toggle');
Route::get('types/delete/{id}', 'CarTypesController@delete');

//Brands routes
Route::get('brands/show', 'BrandsController@home');
Route::get('brands/edit/{id}', 'BrandsController@edit');
Route::post('brands/update', 'BrandsController@update');
Route::post('brands/insert', 'BrandsController@insert');
Route::get('brands/toggle/{id}', 'BrandsController@toggle');
Route::get('brands/delete/{id}', 'BrandsController@delete');



//Dashboard users
Route::get("dash/users/all", 'DashUsersController@index');
Route::post("dash/users/insert", 'DashUsersController@insert');
Route::get("dash/users/edit/{id}", 'DashUsersController@edit');
Route::post("dash/users/update", 'DashUsersController@update');


Route::get('logout', 'HomeController@logout')->name('logout');
Route::get('/login', 'HomeController@login')->name('login');
Route::post('/login', 'HomeController@authenticate')->name('login');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');

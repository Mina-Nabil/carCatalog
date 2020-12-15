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


//Cars routes
Route::get('admin/cars/show', 'CarsController@home');
Route::get('admin/cars/add', 'CarsController@add');
Route::get('admin/cars/profile/{id}', 'CarsController@profile');
Route::post('admin/cars/update', 'CarsController@update');
Route::post('admin/cars/insert', 'CarsController@insert');
Route::get('admin/cars/toggle/main/{id}', 'CarsController@toggleMain');
Route::get('admin/cars/toggle/active/{id}', 'CarsController@toggleActive');

//Accessories routes
Route::get('admin/models/show', 'ModelsController@home');
Route::get('admin/models/add', 'ModelsController@add');
Route::get('admin/models/profile/{id}', 'ModelsController@profile');
Route::post('admin/models/update', 'ModelsController@update');
Route::post('admin/models/insert', 'ModelsController@insert');
Route::get('admin/models/toggle/main/{id}', 'ModelsController@toggleMain');
Route::get('admin/models/toggle/active/{id}', 'ModelsController@toggleActive');

//Accessories routes
Route::get('admin/accessories/show', 'AccessoriesController@home');
Route::get('admin/accessories/edit/{id}', 'AccessoriesController@edit');
Route::post('admin/accessories/update', 'AccessoriesController@update');
Route::post('admin/accessories/insert', 'AccessoriesController@insert');

//Types routes
Route::get('admin/types/show', 'CarTypesController@home');
Route::get('admin/types/edit/{id}', 'CarTypesController@edit');
Route::post('admin/types/update', 'CarTypesController@update');
Route::post('admin/types/insert', 'CarTypesController@insert');
Route::get('admin/types/toggle/{id}', 'CarTypesController@toggle');
Route::get('admin/types/delete/{id}', 'CarTypesController@delete');

//Brands routes
Route::get('admin/brands/show', 'BrandsController@home');
Route::get('admin/brands/edit/{id}', 'BrandsController@edit');
Route::post('admin/brands/update', 'BrandsController@update');
Route::post('admin/brands/insert', 'BrandsController@insert');
Route::get('admin/brands/toggle/{id}', 'BrandsController@toggle');
Route::get('admin/brands/delete/{id}', 'BrandsController@delete');



//Dashboard users
Route::get("dash/users/all", 'DashUsersController@index');
Route::post("dash/users/insert", 'DashUsersController@insert');
Route::get("dash/users/edit/{id}", 'DashUsersController@edit');
Route::post("dash/users/update", 'DashUsersController@update');


Route::get('admin/logout', 'HomeController@logout')->name('logout');
Route::get('admin/login', 'HomeController@login')->name('login');
Route::post('admin/login', 'HomeController@authenticate')->name('login');
Route::get('admin', 'HomeController@index')->name('admin');
Route::get('/', 'HomeController@index')->name('home');

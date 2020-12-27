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
Route::post('admin/cars/images/add', 'CarsController@attachImage');
Route::get('admin/cars/images/del/{id}', 'CarsController@deleteImage');
Route::get('admin/cars/profile/{id}', 'CarsController@profile');
Route::post('admin/cars/update', 'CarsController@update');
Route::post('admin/cars/insert', 'CarsController@insert');
Route::get('admin/cars/toggle/main/{id}', 'CarsController@toggleMain');
Route::get('admin/cars/unlink/accessory/{carID}/{accessoryID}', 'CarsController@deleteAccessoryLink');
Route::post('admin/cars/link/accessory', 'CarsController@linkAccessory');
Route::post('admin/cars/load/data', 'CarsController@loadData');

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

//Partners routes
Route::get('admin/partners/show', 'PartnersController@home');
Route::get('admin/partners/edit/{id}', 'PartnersController@edit');
Route::post('admin/partners/update', 'PartnersController@update');
Route::post('admin/partners/insert', 'PartnersController@insert');
Route::get('admin/partners/toggle/{id}', 'PartnersController@toggle');

//Customers routes
Route::get('admin/customers/show', 'CustomersController@home');
Route::get('admin/customers/edit/{id}', 'CustomersController@edit');
Route::post('admin/customers/update', 'CustomersController@update');
Route::post('admin/customers/insert', 'CustomersController@insert');
Route::get('admin/customers/toggle/{id}', 'CustomersController@toggle');
Route::get('admin/customers/delete/{id}', 'CustomersController@delete');



//Dashboard users
Route::get("admin/dash/users/all", 'DashUsersController@index');
Route::post("admin/dash/users/insert", 'DashUsersController@insert');
Route::get("admin/dash/users/edit/{id}", 'DashUsersController@edit');
Route::post("admin/dash/users/update", 'DashUsersController@update');

//About Us routes
Route::get("admin/manage/about", 'AboutController@home');
Route::post("admin/update/about", 'AboutController@update');

//Website Section route
Route::get("admin/manage/site", 'InfoController@home');
Route::get("admin/toggle/section/{id}", 'InfoController@toggle');
Route::post("admin/update/site", 'InfoController@update');
Route::post("admin/add/field", 'InfoController@addNew');

Route::get('admin/logout', 'HomeController@logout')->name('logout');
Route::get('admin/login', 'HomeController@login')->name('login');
Route::post('admin/login', 'HomeController@authenticate')->name('login');
Route::get('admin', 'HomeController@admin')->name('admin');

/////////Website front end routes 

Route::get('/', 'SiteController@home')->name('home');

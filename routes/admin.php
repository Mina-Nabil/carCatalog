<?php


//Cars routes
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('cars/show', 'CarsController@home');
Route::get('cars/add', 'CarsController@add');
Route::post('cars/images/add', 'CarsController@attachImage');
Route::get('cars/images/del/{id}', 'CarsController@deleteImage');
Route::get('cars/profile/{id}', 'CarsController@profile');
Route::post('cars/update', 'CarsController@update');
Route::post('cars/insert', 'CarsController@insert');
Route::get('cars/toggle/main/{id}', 'CarsController@toggleMain');
Route::get('cars/unlink/accessory/{carID}/{accessoryID}', 'CarsController@deleteAccessoryLink');
Route::post('cars/link/accessory', 'CarsController@linkAccessory');
Route::post('cars/load/data', 'CarsController@loadData');
Route::post('cars/load/accessories', 'CarsController@loadAccessories');
Route::post('cars/update/image', 'CarsController@editImage');

//Models routes
Route::get('models/show', 'ModelsController@home');
Route::get('models/add', 'ModelsController@add');
Route::get('models/profile/{id}', 'ModelsController@profile');
Route::post('models/update', 'ModelsController@update');
Route::post('models/insert', 'ModelsController@insert');
Route::get('models/toggle/main/{id}', 'ModelsController@toggleMain');
Route::get('models/toggle/active/{id}', 'ModelsController@toggleActive');
Route::post('models/add/image', 'ModelsController@attachImage');
Route::post('models/update/image', 'ModelsController@editImage');

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

//Partners routes
Route::get('partners/show', 'PartnersController@home');
Route::get('partners/edit/{id}', 'PartnersController@edit');
Route::post('partners/update', 'PartnersController@update');
Route::post('partners/insert', 'PartnersController@insert');
Route::get('partners/toggle/{id}', 'PartnersController@toggle');

//Customers routes
Route::get('customers/show', 'CustomersController@home');
Route::get('customers/edit/{id}', 'CustomersController@edit');
Route::post('customers/update', 'CustomersController@update');
Route::post('customers/insert', 'CustomersController@insert');
Route::get('customers/toggle/{id}', 'CustomersController@toggle');
Route::get('customers/delete/{id}', 'CustomersController@delete');



//Dashboard users
Route::get("dash/users/all", 'DashUsersController@index');
Route::post("dash/users/insert", 'DashUsersController@insert');
Route::get("dash/users/edit/{id}", 'DashUsersController@edit');
Route::post("dash/users/update", 'DashUsersController@update');

//About Us routes
Route::get("manage/about", 'AboutController@home');
Route::post("update/about", 'AboutController@update');

//Website Section route
Route::get("manage/site", 'InfoController@home');
Route::get("toggle/section/{id}", 'InfoController@toggle');
Route::post("update/site", 'InfoController@update');
Route::post("add/field", 'InfoController@addNew');
Route::post("delete/field/", 'InfoController@deleteField');

Route::get('logout', 'HomeController@logout')->name('logout');
Route::get('/', 'HomeController@admin')->name('admin');

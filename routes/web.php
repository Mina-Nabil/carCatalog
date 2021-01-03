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



/////////Website front end routes 

Route::get('/car/{id}', 'SiteController@car')->name('home');
Route::get('/model/{id}', 'SiteController@model')->name('home');
Route::get('/', 'SiteController@home')->name('home');

//unauthenticated admin login pages
Route::get('admin/login', 'HomeController@login')->name('login')->middleware('web');
Route::post('admin/login', 'HomeController@authenticate')->name('login')->middleware('web');
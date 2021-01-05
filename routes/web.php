<?php

use Illuminate\Http\Request;
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

Route::get('/compare', 'SiteController@compare');
Route::post('/compare/add', function (Request $request) {
    $request->validate([
        "carID" => "required|exists:cars,id"
    ]);

    $compareArr = $request->session()->get('compareArr') ?? [];
    if (!in_array($request->carID, $compareArr)) {
        array_push($compareArr, $request->carID);
        if (count($compareArr) > 3) {
            $compareArr = array_slice($compareArr, 1, 3);
        }
        $request->session()->put('compareArr', $compareArr);
    }
});
Route::post('/compare/remove', function (Request $request) {
    $request->validate([
        "carID" => "required|exists:cars,id"
    ]);

    $compareArr = $request->session()->get('compareArr') ?? [];
    if (in_array($request->carID, $compareArr)) {
        if (($key = array_search($request->carID, $compareArr)) !== false) {
            unset($compareArr[$key]);
        }
        $request->session()->put('compareArr', $compareArr);
    }
});
Route::post('/search', 'SiteController@search');
Route::get('/car/{id}', 'SiteController@car');
Route::get('/model/{id}', 'SiteController@model');
Route::get('/', 'SiteController@home')->name('home');

//unauthenticated admin login pages
Route::get('admin/login', 'HomeController@login')->name('login')->middleware('web');
Route::post('admin/login', 'HomeController@authenticate')->name('login')->middleware('web');

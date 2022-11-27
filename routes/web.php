<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/testRoute', function () {
    return view('secondPageTest');
});

Route::get('/testVue', function () {
    return view('testVueJSPage');
});

// Variable width templates:
Route::get('/login', function () {
    return view('varLogin');
});
Route::get('/login/error', function () {
    return view('varLoginOffCanvasError');
});
Route::get('/register', function () {
    return view('varRegister');
});

// Fixed size templates:
Route::get('/fixedRegister', function () {
    return view('fixedRegister');
});

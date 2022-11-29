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
// Login | Onboarding:
Route::get('/login', function () {
  return view('varLogin');
});
Route::get('/login/error', function () {
  return view('varLoginOffCanvasError');
});
Route::get('/register', function () {
  return view('varRegister');
});
Route::get('/password/reset', function () {
  return view('varPasswordReset');
});
Route::get('/password/reset/change', function () {
  return view('varPasswordResetChange');
});
Route::get('/success', function () {
  return view('varSuccess');
});

// Fixed size templates:
Route::get('/fixedRegister', function () {
  $patates = "patates";
  return view('fixedRegister', ['patates' => $patates]);
});

<?php

/**
 * @file
 * Contains App's web routes.
 */

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

// From the "obsolete" pages, this still acts as the index, so please don't
// delete this blade until we have a brand new front-page to replace it. Also
// has important comments, as Manos decided to use this as a notebook :).
Route::get('/', function () {
    return view('obsolete/laravelWelcome');
});

/*
 * Login | Onboarding.
 * Last update: November 29, 2022.
 * @todo Fix font-weights, currently under-dev by Anna.
 */
Route::get('/login', function () {
    return view('login');
});
Route::get('/login/error', function () {
    return view('loginError');
});
Route::get('/register', function () {
    return view('register');
});
Route::get('/password/reset', function () {
    return view('passwordReset');
});
Route::get('/password/reset/change', function () {
    return view('passwordResetNewPassword');
});
Route::get('/success', function () {
    return view('success');
});
/*
 * Stepper 2 | Profiles?
 * Last update: November 29, 2022.
 * @todo Fix grids, currently under-dev by Anna.
 */
Route::get('/profile/new', function () {
    return view('profileNew');
});

// Obsolete pages:
// Moved to obsolete.
Route::get('/testRoute', function () {
    return view('obsolete/secondPageTest');
});
Route::get('/testVue', function () {
    return view('obsolete/testVueJSPage');
});
// Fixed size templates:
Route::get('/fixedRegister', function () {
    $patates = "patates";
    return view('obsolete/fixedRegister', ['patates' => $patates]);
});

<?php

/**
 * @file
 * Contains App's web routes.
 *
 * These are the default web routes for the app and they should eventually be
 * replaced with a Controller. Until then, enjoy!
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
    return view('extras/laravelWelcome');
});
Route::get('/extras/font-tester', function () {
    return view('extras/fontTester');
});

/*
 * Login | Onboarding.
 * Last update: November 29, 2022.
 * @todo Fix font-weights, currently under-dev by Anna.
 */
Route::get('/login', function () {
    return view('login');
});
Route::get('demo/login/error', function () {
    return view('extras/demoLoginError');
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
 * Stepper 2 | New player profiles
 * Last update: November 30, 2022.
 * @todo Fix next-previous buttons, currently under-dev by Anna.
 */
Route::get('/profiles/new', function () {
    // Starting with tabindex 2, as 1 is the player's name input.
    $tabIndex = 2;
    $avatarData = array(
        0 => [
            "id" => "1",
            "tabindex" => $tabIndex++,
            "title" => "Άβαταρ αγοριού με καστανά μαλιά",
            "asset" => "boy-1.svg",
            "showText" => false,
        ],
        1 => [
            "id" => "2",
            "tabindex" => $tabIndex++,
            "title" => "Άβαταρ αγοριού με μαύρα μαλιά",
            "asset" => "boy-2.svg",
            "showText" => false,
        ],
        2 => [
            "id" => "3",
            "tabindex" => $tabIndex++,
            "title" => "Άβαταρ κοριτσιού με καστανά μαλιά",
            "asset" => "girl-1.svg",
            "showText" => false,
        ],
        3 => [
            "id" => "4",
            "tabindex" => $tabIndex++,
            "title" => "Άβαταρ κοριτσιού με ξανθά μαλιά",
            "asset" => "girl-2.svg",
            "showText" => false,
        ],
        4 => [
            "id" => "5",
            "tabindex" => $tabIndex++,
            "title" => "Άβαταρ γατούλας",
            "asset" => "cat.svg",
            "showText" => false,
        ],
        5 => [
            "id" => "6",
            "tabindex" => $tabIndex++,
            "title" => "Άβαταρ σκύλου",
            "asset" => "dog.svg",
            "showText" => false,
        ],
    );
    view()->share('avatarData', $avatarData);
    return view('profileNew');
});

// Obsolete pages:
// Moved to obsolete.
Route::get('/testRoute', function () {
    return view('extras/obsolete/secondPageTest');
});
Route::get('/testVue', function () {
    return view('extras/obsolete/testVueJSPage');
});
// Fixed size templates:
Route::get('/fixedRegister', function () {
    $patates = "patates";
    return view('extras/obsolete/fixedRegister', ['patates' => $patates]);
});

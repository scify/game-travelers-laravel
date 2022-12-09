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
require __DIR__.'/auth.php';

// From the "obsolete" pages, this still acts as the index, so please don't
// delete this blade until we have a brand new front-page to replace it. Also
// has important comments, as Manos decided to use this as a notebook :).
Route::get('/', function () {
    return view('extras/testViews');
});

// Sample Data used on profileNewStep1 and its 2 demos. Sorry for keeping them
// here for the time being, at least they have been moved to an external file.
require __DIR__.'/sampleData.php';
View::share('avatarData', $sampleAvatarData);

/*
 * Login | Onboarding.
 * Last update: December 5, 2022.
 * @todo Pending fully transparent and extended asset for success page.
 */
/*Route::get('/login', function () {
    return view('login');
});*/
Route::get('demo/login/error', function () {
    return view('extras/demoLoginError');
});
/*Route::get('/register', function () {
    return view('register');
});*/
Route::get('/password/reset', function () {
    return view('passwordReset');
});
Route::get('/password/reset/change', function () {
    return view('passwordResetNewPassword');
});
Route::get('/password/reset/success', function () {
    return view('passwordResetComplete');
});

/*
 * Stepper 2 | New player profiles
 * Last update: December 9, 2022.
 * Demos added.
 */
Route::get('/profiles/new', function () {
    // Starting with tabindex 2, as 1 is the player's name input.
    // Note: The asset's name is the file's name without it's .extension:
    //  - For example: "boy-1"
    //  - Template will  display 1 out of 3 possible files depending on
    //    web browser's pixel density: boy-1.png, boy-1@2x.png or boy-1.svg.
    //    All these files should be under: "/public/images/avatars".
    //
    // Please read the comments on views/components/profileNewAvatar.blade.php
    // for detailed instructions on how to use...
    //
    // Αυτό παραμένει Under Contstruction μέχρι να δούμε στα mock-ups τι
    // άλλο θα μπορούσε δυνητικά να περιέχει το τελικό class. Για εμένα αυτή
    // τη στιγμή είναι χρήσιμο για να δοκιμάζω τα states των avatar buttons και
    // να γράψω μερικές γραμμές JavaScript ώστε τα πλήκτρα να καθορίζουν την
    // τιμή σε checkbox και να αλλάζουν τα states τους.

    return view('profileNewStep1');
});
Route::get('demo/profile/error', function () {
    return view('extras/demoProfileNewError');
});
Route::get('demo/profile/success', function () {
    return view('extras/demoProfileNewSuccess');
});
Route::get('/profiles/new/2', function () {
    return view('profileNewStep2');
});
Route::get('/profiles/new/3', function () {
    return view('profileNewStep3');
});


// Obsolete pages:
// No longer needed, yet they might be useful during development.
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
// Font-tester
Route::get('/extras/font-tester', function () {
    return view('extras/testFont');
});

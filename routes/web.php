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

// Temporary splash screen implementation to hide the /log diary out of sight.
Route::get('/', function () {
    return view('splash');
});

// From the "obsolete" pages, this still acts as the index, so please don't
// delete this blade until we have a brand new front-page to replace it. Also
// has important comments, as some of us decided to use this as a notebook.
Route::get('/log', function () {
    return view('extras/logViews');
});

// Sample Data used on profileNewStep1 and its 2 demos. The exampleData contains
// the $avatar array, which contains all available modules. It's the output of
// the proposed (untested) Avatar model, which also resides in the same folder.
// @see ../docs/examples/exampleData.php Avatar Data Model
// @example ../docs/examples/exampleDataAvatarModel.php Avatar Data Model
require __DIR__.'/../docs/examples/exampleData.php';
View::share('avatars', $avatars);
View::share('players_with_avatars', $players_with_avatars);

/*
 * Travellers | Step 1. New game
 * Last update: December 15, 2022.
 * @link https://xd.adobe.com/view/d308b3ee-c123-48d3-87ff-5304ebdaa85a-865b/
 */
Route::get('/select/player', function () {
    // Requires View::share('players_with_avatars', $players_with_avatars);
    return view('gameSelectPlayer');
});
Route::get('/select/board', function () {
    // Requires Implementation of "User Menu".
    // Select Board page with links for passing data via GET.
    // This is indeed fully implemented and has :comingsoon=true support.
    return view('gameSelectBoard');
});
Route::get('/select/mode', function () {
    // Requires Implementation of "User Menu".
    // Select Mode (single player et.) page with links for passing data via GET.
    // Individual modes can be disabled with the :comingsoon=true attribute.
    return view('gameSelectMode');
});
Route::get('/select/pawn', function () {
    // Requires Implementation of "User Menu".
    // Select Pawn (tutorial, etc.) page with links for passing data via GET.
    return view('gameSelectPawn');
});
Route::get('/select/options', function () {
    // Requires Implementation of "User Menu".
    // Select Options (tutorial, etc.) page with links for passing data via GET.
    return view('gameSelectOptions');
});
// Demos
Route::get('/demo/select/board/form', function () {
    // Select Board page with buttons in a form for passing data via POST/GET.
    return view('extras/demoGameSelectBoardForm');
});

/*
 * Stepper 2 | New player profiles & settings.
 * Last update: December 10, 2022.
 * @link https://xd.adobe.com/view/881b8987-9d56-443d-9e00-c2edcb5a6671-dd48/
 */
Route::get('/profile/new', function () {
    // Requires View::share('avatars', $avatars);
    return view('profileNewStep1');
});
Route::get('/profile/new/2', function () {
    // Requires View::share('avatars', $avatars);
    return view('profileNewStep2');
});
Route::get('/profile/new/3', function () {
    // Requires View::share('avatars', $avatars);
    return view('profileNewStep3');
});
// Demos
Route::get('demo/profile/error', function () {
    return view('extras/demoProfileNewError');
});
Route::get('demo/profile/success', function () {
    return view('extras/demoProfileNewSuccess');
});

/*
 * Travellers | Settings
 * Last update: December 16, 2022.
 * @link https://xd.adobe.com/view/d308b3ee-c123-48d3-87ff-5304ebdaa85a-865b/
 */
Route::get('/settings', function () {
    return view('settings');
});

// Obsolete pages:
// No longer needed, yet they might be useful during development.
Route::get('/testRoute', function () {
    return view('extras/obsolete/secondPageTest');
});
Route::get('/testVue', function () {
    return view('extras/obsolete/testVueJSPage');
});
// Font-tester
Route::get('/extras/font-tester', function () {
    return view('extras/testFont');
});

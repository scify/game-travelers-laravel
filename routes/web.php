<?php

/**
 * @file
 * Contains App's web routes.
 */

use App\Models\User;
use App\Notifications\UserRegistered;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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
require __DIR__ . '/auth.php';

// Temporary splash screen implementation to hide the /log diary out of sight.
Route::get('/', function () {
    return view('splash');
})->name('home');


Route::middleware(['auth'])->group(function () {
    Route::prefix('administration')->middleware('can:manage-platform')->name('administration.')->group(function () {
        Route::get('test-email/{email}', function (Request $request) {
            $user = User::where(['email' => $request->email])->first();
            if (!$user)
                $user = User::findOrFail(1);
            $user->notify(new UserRegistered($user));
            return "Email sent to: " . $user->email;
        });
    });
});

Route::view('/privacy-policy', 'privacy-policy.page')->name('privacy-policy');

// From the "obsolete" pages, this still acts as the index, so please don't
// delete this blade until we have a brand new front-page to replace it. Also
// has important comments, as some of us decided to use this as a notebook.
Route::get('/log', function () {
    return view('extras/logViews');
});

// Sample Data used on settingsProfile, settingsProfileNew and 2 demos.
// The exampleData.php file contains the $avatar array will all the available
// avatars. It's the (emulated) output of the proposed (untested) Avatar model,
// which also resides in the same folder.
// @see ../docs/examples/exampleData.php Avatar Data Model
// @example ../docs/examples/exampleDataAvatarModel.php Avatar Data Model
require __DIR__ . '/../docs/examples/exampleData.php';
/** @var array $avatars */
View::share('avatars', $avatars);
/** @var array $players_with_avatars */
View::share('players_with_avatars', $players_with_avatars);

/*
 * Travellers | Step 1. New game
 * Last update: December 18, 2022.
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
 * Stepper 2 | New player settings.
 * Last update: December 20, 2022.
 * @link https://xd.adobe.com/view/881b8987-9d56-443d-9e00-c2edcb5a6671-dd48/
 */
Route::get('/settings/profile/new', function () {
    // New Player Step 1: Player's Profile
    // Requires View::share('avatars', $avatars);
    // Same form, fields, purpose as Existing Player Profile Settings.
    return view('settingsProfileNew');
});
Route::get('/settings/controls/new', function () {
    // New Player Step 2: Player's Control Settings
    // Same form, fields, purpose as Existing Player Control Settings.
    return view('settingsControlsNew');
});
Route::get('/settings/difficulty/new', function () {
    // New Player Step 3: Player's Difficulty Settings
    // Same form, fields, purpose as Existing Player Difficulty Settings.
    return view('settingsDifficultyNew');
});
// Demos
Route::get('demo/settings/profile/new/error', function () {
    // DEMO - Error - New Player Step 1: Player's Profile
    // Requires View::share('avatars', $avatars);
    return view('extras/demoPlayerProfileNewError');
});
Route::get('demo/settings/profile/new/success', function () {
    // DEMO - Success - New Player Step 1: Player's Profile
    // Requires View::share('avatars', $avatars);
    return view('extras/demoPlayerProfileNewSuccess');
});

/*
 * Travellers | Existing Player Settings.
 * Last update: December 20, 2022.
 * @link https://xd.adobe.com/view/d308b3ee-c123-48d3-87ff-5304ebdaa85a-865b/
 */
Route::get('/settings', function () {
    // Should be /player/{playerid}/settings allowing easier access via userMenu
    // without having to have a 2nd form on each individual page.
    return view('settings');
});
Route::get('/settings/profile', function () {
    // Should be /player/{playerid}/settings/profile allowing easier access
    // via userMenu without having to have a 2nd form on each individual page.
    // Same form, fields, purpose as New Player Control Settings.
    // @see settingsProfileNew.blade.php
    // Final version (might or might not) have a different layout.
    return view('settingsProfile');
});
Route::get('/settings/controls', function () {
    // Should be /player/{playerid}/settings/controls allowing easier access
    // via userMenu without having to have a 2nd form on each individual page.
    // Same form, fields, purpose as New Player Control Settings.
    // @see settingsControlsNew.blade.php
    // Final version (might or might not) have a different layout.
    return view('settingsControls');
});
Route::get('/settings/difficulty', function () {
    // Should be /player/{playerid}/settings/difficulty allowing easier access
    // via userMenu without having to have a 2nd form on each individual page.
    // Same form, fields, purpose as New Player Control Settings.
    // @see settingsDifficultyNew.blade.php
    // Final version (might or might not) have a different layout.
    return view('settingsDifficulty');
});

// Random x-layout component demos for No-Vue (default), Vue (optional):
Route::get('/demo/noVue', function () {
    return view('extras/demoNoVue');
});
Route::get('/demo/hasVue', function () {
    return view('extras/demoHasVue');
});
Route::get('/demo/hasVueBlank', function () {
    return view('extras/demoHasVueBlank');
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

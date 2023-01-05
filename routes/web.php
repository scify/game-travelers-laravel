<?php

/**
 * @file
 * Contains App's web routes.
 */
use App\Http\Middleware\EnsurePlayerIdIsValid;
use App\Models\User;
use App\Notifications\UserRegistered;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SetupGameController;

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

/*
 * Travellers | Step 1. New game
 * Last update: December 18, 2022.
 * @link https://xd.adobe.com/view/d308b3ee-c123-48d3-87ff-5304ebdaa85a-865b/
 */
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


//Integrated pages
Route::middleware('auth')->group(function () {
    Route::get('/select/player', [UserController::class, 'show'])
        ->name('select.player');

    Route::post('/select/player', [UserController::class, 'select'])
        ->name('select.player');

    Route::get('/create/player', [UserController::class, 'newPlayer'])
        ->name('new.player')->middleware(EnsurePlayerIdIsValid::class);

    Route::post('/create/player', [UserController::class, 'savePlayer'])
        ->name('new.player')->middleware(EnsurePlayerIdIsValid::class);

    Route::get('/controls/player', [UserController::class, 'controlsConfigure'])
        ->name('controls.player')->middleware(EnsurePlayerIdIsValid::class);

    Route::post('/controls/player', [UserController::class, 'controlsSave'])
        ->name('controls.player')->middleware(EnsurePlayerIdIsValid::class);

    Route::get('/difficulty/player', [UserController::class, 'difficultyConfigure'])
        ->name('difficulty.player')->middleware(EnsurePlayerIdIsValid::class);

    Route::post('/difficulty/player', [UserController::class, 'difficultySave'])
        ->name('difficulty.player')->middleware(EnsurePlayerIdIsValid::class);

    Route::get('/settings', [SettingsController::class, 'settingsShow'])
        ->name('settings')->middleware(EnsurePlayerIdIsValid::class);

    Route::post('/settings', [SettingsController::class, 'settingsSelect'])
        ->name('settings')->middleware(EnsurePlayerIdIsValid::class);

    Route::get('/settings/profile', [SettingsController::class, 'profileShow'])
        ->name('settings.profile')->middleware(EnsurePlayerIdIsValid::class);

    Route::post('/settings/profile', [SettingsController::class, 'profileSave'])
        ->name('settings.profile')->middleware(EnsurePlayerIdIsValid::class);

    Route::get('/settings/controls', [SettingsController::class, 'controlsShow'])
        ->name('settings.controls')->middleware(EnsurePlayerIdIsValid::class);

    Route::post('/settings/controls', [SettingsController::class, 'controlsSave'])
        ->name('settings.controls')->middleware(EnsurePlayerIdIsValid::class);

    Route::get('/settings/difficulty', [SettingsController::class, 'difficultyShow'])
        ->name('settings.difficulty')->middleware(EnsurePlayerIdIsValid::class);

    Route::post('/settings/difficulty', [SettingsController::class, 'difficultySave'])
        ->name('settings.difficulty')->middleware(EnsurePlayerIdIsValid::class);

    Route::get('/select/board', [SetupGameController::class, 'show'])
        ->name('select.board');

    Route::get('home', function () {
        return redirect('/select/player');
    });

    Route::get('logout', function () {
        return view('logoutDummy');
    });
});

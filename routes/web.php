<?php

/**
 * @file
 * Contains App's web routes.
 */
use App\Http\Middleware\EnsureIdsAreValid;
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

// Demos
// 1. Scanning Controller JavaScript demo:
Route::get('/demo/select/pawn', function () {
    return view('extras/demoGameSelectPawnScanning');
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
    Route::get('/select/player/{player_id}/{from}/{game_id}', [UserController::class, 'show'])
        ->name('select.player');

    Route::post('/select/player/{player_id}/{from}/{game_id}', [UserController::class, 'select'])
        ->name('select.player');

    Route::get('/create/player/{player_id}/{from}/{game_id}', [UserController::class, 'newPlayer'])
        ->name('new.player')->middleware(EnsureIdsAreValid::class);

    Route::post('/create/player/{player_id}/{from}/{game_id}', [UserController::class, 'savePlayer'])
        ->name('new.player')->middleware(EnsureIdsAreValid::class);

    Route::get('/controls/player/{player_id}/{from}/{game_id}', [UserController::class, 'controlsConfigure'])
        ->name('controls.player')->middleware(EnsureIdsAreValid::class);

    Route::post('/controls/player/{player_id}/{from}/{game_id}', [UserController::class, 'controlsSave'])
        ->name('controls.player')->middleware(EnsureIdsAreValid::class);

    Route::get('/difficulty/player/{player_id}/{from}/{game_id}', [UserController::class, 'difficultyConfigure'])
        ->name('difficulty.player')->middleware(EnsureIdsAreValid::class);

    Route::post('/difficulty/player/{player_id}/{from}/{game_id}', [UserController::class, 'difficultySave'])
        ->name('difficulty.player')->middleware(EnsureIdsAreValid::class);

    Route::get('/settings/{player_id}/{from}/{game_id}', [SettingsController::class, 'settingsShow'])
        ->name('settings')->middleware(EnsureIdsAreValid::class);

    Route::post('/settings/{player_id}/{from}/{game_id}', [SettingsController::class, 'settingsSelect'])
        ->name('settings')->middleware(EnsureIdsAreValid::class);

    Route::get('/settings/profile/{player_id}/{from}/{game_id}', [SettingsController::class, 'profileShow'])
        ->name('settings.profile')->middleware(EnsureIdsAreValid::class);

    Route::post('/settings/profile/{player_id}/{from}/{game_id}', [SettingsController::class, 'profileSave'])
        ->name('settings.profile')->middleware(EnsureIdsAreValid::class);

    Route::get('/settings/controls/{player_id}/{from}/{game_id}', [SettingsController::class, 'controlsShow'])
        ->name('settings.controls')->middleware(EnsureIdsAreValid::class);

    Route::post('/settings/controls/{player_id}/{from}/{game_id}', [SettingsController::class, 'controlsSave'])
        ->name('settings.controls')->middleware(EnsureIdsAreValid::class);

    Route::get('/settings/difficulty/{player_id}/{from}/{game_id}', [SettingsController::class, 'difficultyShow'])
        ->name('settings.difficulty')->middleware(EnsureIdsAreValid::class);

    Route::post('/settings/difficulty/{player_id}/{from}/{game_id}', [SettingsController::class, 'difficultySave'])
        ->name('settings.difficulty')->middleware(EnsureIdsAreValid::class);

    Route::get('/select/board/{player_id}/{from}/{game_id}', [SetupGameController::class, 'boardShow'])
        ->name('select.board')->middleware(EnsureIdsAreValid::class);

    Route::post('/select/board/{player_id}/{from}/{game_id}', [SetupGameController::class, 'boardSave'])
        ->name('select.board')->middleware(EnsureIdsAreValid::class);

    Route::get('/select/mode/{player_id}/{from}/{game_id}', [SetupGameController::class, 'modeShow'])
        ->name('select.mode')->middleware(EnsureIdsAreValid::class);

    Route::post('/select/mode/{player_id}/{from}/{game_id}', [SetupGameController::class, 'modeSave'])
        ->name('select.mode')->middleware(EnsureIdsAreValid::class);

    Route::get('/select/pawn/{player_id}/{from}/{game_id}', [SetupGameController::class, 'pawnShow'])
        ->name('select.pawn')->middleware(EnsureIdsAreValid::class);

    Route::post('/select/pawn/{player_id}/{from}/{game_id}', [SetupGameController::class, 'pawnSave'])
        ->name('select.pawn')->middleware(EnsureIdsAreValid::class);

    Route::get('/select/options/{player_id}/{from}/{game_id}', [SetupGameController::class, 'optionsShow'])
        ->name('select.options')->middleware(EnsureIdsAreValid::class);

    Route::post('/select/options/{player_id}/{from}/{game_id}', [SetupGameController::class, 'optionsSave'])
        ->name('select.options')->middleware(EnsureIdsAreValid::class);

    Route::get('home', function () {
        return redirect()->route('select.player', [0, "user", 0]);
    });

    Route::get('logout', function () {
        return view('logoutDummy');
    })->name('dummy.logout');
});

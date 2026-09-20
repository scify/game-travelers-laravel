<?php

declare(strict_types=1);

/**
 * @file
 * Contains App's web routes.
 */
use App\Http\Controllers\BoardController;
use App\Http\Controllers\CustomAudioController;
use App\Http\Controllers\Debug\GameStateController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SetupGameController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\EnsureDebugMode;
use App\Http\Middleware\EnsureIdsAreValid;
use App\Models\User;
use App\Notifications\UserRegistered;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

// Non-game pages.
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::view('/about', 'about')->name('about');
Route::view('/credits', 'credits')->name('credits');
Route::view('/cookies-policy', 'cookies')->name('cookies-policy');

// For crawlers. The sitemap it names is written by sitemap:generate.
Route::get('robots.txt', fn (): Response => response()->view('robots')->header('Content-Type', 'text/plain'));

Route::middleware(['auth'])->group(function (): void {
    Route::prefix('administration')->middleware('can:manage-platform')->name('administration.')->group(function (): void {
        Route::get('test-email/{email}', function (Request $request): string {
            $user = User::query()->where(['email' => $request->email])->first();
            if (! $user) {
                $user = User::query()->findOrFail(1);
            }

            $user->notify(new UserRegistered($user));

            return 'Email sent to: ' . $user->email;
        });
    });
});

// Integrated pages
Route::middleware('auth')->group(function (): void {
    // Choosing a player carries no ids yet, so the guard has nothing to read.
    Route::get('/select/player/{player_id}/{game_id}', [UserController::class, 'show'])->name('select.player');
    Route::post('/select/player/{player_id}/{game_id}', [UserController::class, 'select'])->name('select.player');

    Route::middleware(EnsureIdsAreValid::class)->group(function (): void {
        Route::prefix('select')->name('select.')->group(function (): void {
            Route::get('continue/{player_id}/{game_id}', [SetupGameController::class, 'continueShow'])->name('continue');
            Route::post('continue/{player_id}/{game_id}', [SetupGameController::class, 'continueSave'])->name('continue');

            Route::get('board/{player_id}/{game_id}', [SetupGameController::class, 'boardShow'])->name('board');
            Route::post('board/{player_id}/{game_id}', [SetupGameController::class, 'boardSave'])->name('board');

            Route::get('mode/{player_id}/{game_id}', [SetupGameController::class, 'modeShow'])->name('mode');
            Route::post('mode/{player_id}/{game_id}', [SetupGameController::class, 'modeSave'])->name('mode');

            Route::get('pawn/{player_id}/{game_id}', [SetupGameController::class, 'pawnShow'])->name('pawn');
            Route::post('pawn/{player_id}/{game_id}', [SetupGameController::class, 'pawnSave'])->name('pawn');

            Route::get('pawn-two/{player_id}/{game_id}', [SetupGameController::class, 'pawnTwoShow'])->name('pawnTwo');
            Route::post('pawn-two/{player_id}/{game_id}', [SetupGameController::class, 'pawnTwoSave'])->name('pawnTwo');

            Route::get('options/{player_id}/{game_id}', [SetupGameController::class, 'optionsShow'])->name('options');
            Route::post('options/{player_id}/{game_id}', [SetupGameController::class, 'optionsSave'])->name('options');
        });

        Route::prefix('settings')->name('settings.')->group(function (): void {
            Route::get('{player_id}/{back}/{game_id}', [SettingsController::class, 'settingsShow'])->name('index');
            Route::post('{player_id}/{back}/{game_id}', [SettingsController::class, 'settingsSelect'])->name('index');

            Route::get('profile/{player_id}/{back}/{game_id}', [SettingsController::class, 'profileShow'])->name('profile');
            Route::post('profile/{player_id}/{back}/{game_id}', [SettingsController::class, 'profileSave'])->name('profile');

            Route::get('controls/{player_id}/{back}/{game_id}', [SettingsController::class, 'controlsShow'])->name('controls');
            Route::post('controls/{player_id}/{back}/{game_id}', [SettingsController::class, 'controlsSave'])->name('controls');

            Route::get('difficulty/{player_id}/{back}/{game_id}', [SettingsController::class, 'difficultyShow'])->name('difficulty');
            Route::post('difficulty/{player_id}/{back}/{game_id}', [SettingsController::class, 'difficultySave'])->name('difficulty');

            /*Route::get('audio/{player_id}/{back}/{game_id}', [CustomAudioController::class, 'audioShow'])->name('audio');
            Route::post('audio/{player_id}/{back}/{game_id}', [CustomAudioController::class, 'audioSave'])->name('audio');*/
        });

        // The new player wizard. Its three steps do not share a prefix yet.
        Route::get('/create/player/{player_id}/{game_id}', [UserController::class, 'newPlayer'])->name('new.player');
        Route::post('/create/player/{player_id}/{game_id}', [UserController::class, 'savePlayer'])->name('new.player');

        Route::get('/controls/player/{player_id}/{game_id}', [UserController::class, 'controlsConfigure'])->name('controls.player');
        Route::post('/controls/player/{player_id}/{game_id}', [UserController::class, 'controlsSave'])->name('controls.player');

        Route::get('/difficulty/player/{player_id}/{game_id}', [UserController::class, 'difficultyConfigure'])->name('difficulty.player');
        Route::post('/difficulty/player/{player_id}/{game_id}', [UserController::class, 'difficultySave'])->name('difficulty.player');

        Route::get('board/{player_id}/{game_id}', [BoardController::class, 'play'])->name('board');
    });

    Route::get('home', fn () => to_route('select.player', [0, 0]))->name('dashboard');

    Route::get('logout', fn (): Factory|View => view('logoutDummy'))->name('dummy.logout');

    Route::post('board/fromVue', [BoardController::class, 'fromVue'])->name('to.backend');

    // Stages a game for testing from the board's debug strip; a 404 unless DebugMode is on.
    Route::post('debug/game/{game_id}/state', [GameStateController::class, 'store'])
        ->name('debug.game.state')->middleware(EnsureDebugMode::class);

    Route::post('audio/updateVolumes', [CustomAudioController::class, 'updateVolumes'])->name('audio.updateVolumes');

    /*Route::post('audio/upload', [CustomAudioController::class, 'uploadCustomAudioFile'])->name('audio.upload');
    Route::post('audio/remove', [CustomAudioController::class, 'removeCustomAudioFile'])->name('audio.remove');*/
});

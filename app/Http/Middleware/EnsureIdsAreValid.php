<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Repository\Game\GameRepository;
use App\Repository\Player\PlayerRepository;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Redirect;

class EnsureIdsAreValid
{
    public function __construct(protected PlayerRepository $playerRepository, protected GameRepository $gameRepository) {}

    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response|RedirectResponse)  $next
     *
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $parameters = $request->route()->parameters;
        $player_id = (int) $parameters['player_id'];
        $game_id = (int) $parameters['game_id'];
        $user_id = auth()->id();
        if ($player_id === 0) {
            return $next($request);
        }

        if (! $this->playerRepository->playerExists($player_id, $user_id)) {
            abort(403, __('messages.unauthorized_action'));
        } elseif ($game_id !== 0) {
            if (! $this->gameRepository->gameExists($game_id, $user_id)) {
                if ($this->gameRepository->gameExistsAsInactive($game_id, $user_id)) {
                    return Redirect::route('select.board', [$player_id, 'board', 0]);
                }
                abort(403, __('messages.unauthorized_action'));

            }
        }

        return $next($request);
    }
}

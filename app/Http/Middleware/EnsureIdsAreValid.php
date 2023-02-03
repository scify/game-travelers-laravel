<?php

namespace App\Http\Middleware;

use App\Repository\Game\GameRepository;
use App\Repository\Player\PlayerRepository;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EnsureIdsAreValid {

    protected PlayerRepository $playerRepository;
    protected GameRepository $gameRepository;

    public function __construct(PlayerRepository $playerRepository, GameRepository $gameRepository) {
        $this->playerRepository = $playerRepository;
        $this->gameRepository = $gameRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response|RedirectResponse) $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next) {
        $parameters = $request->route()->parameters;
        $player_id = (int)$parameters['player_id'];
        $game_id = (int)$parameters['game_id'];
        $user_id = auth()->id();
        if ($player_id == 0)
            return $next($request);

        if (!$this->playerRepository->playerExists($player_id, $user_id))
            abort(403, __('messages.unauthorized_action'));
        else if ($game_id != 0) {
            if (!$this->gameRepository->gameExists($game_id, $user_id)) {
                if ($this->gameRepository->gameExistsAsInactive($game_id, $user_id))
                    return \Redirect::route('select.board', [$player_id, 'board', 0]);
                else
                    abort(403, __('messages.unauthorized_action'));
            }
        }
        return $next($request);
    }
}

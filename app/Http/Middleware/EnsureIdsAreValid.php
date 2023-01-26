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
        if ($player_id == 0)
            return $next($request);

        $problem_found = false;
        $user_id = auth()->id();
        $entry = $this->playerRepository->allWhere(['id' => $player_id], ['user_id']);
        if ($entry->count() == 0)
            $problem_found = true;
        else if ($entry[0]->user_id != $user_id)
            $problem_found = true;

        if ($game_id != 0) {
            $entry = $this->gameRepository->allWhere(['id' => $game_id, 'active' => true], ['user_id']);
            if ($entry->count() == 0)
                $problem_found = true;
            else if ($entry[0]->user_id != $user_id)
                $problem_found = true;
        }

        if ($problem_found)
            abort(403, 'Unauthorized action.');
        else
            return $next($request);

    }
}

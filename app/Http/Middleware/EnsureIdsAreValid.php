<?php

namespace App\Http\Middleware;

use App\Repository\Game\GameRepository;
use App\Repository\Player\PlayerRepository;
use Closure;
use Illuminate\Http\Request;

class EnsureIdsAreValid
{

    protected PlayerRepository $playerRepository;
    protected GameRepository $gameRepository;


    public function __construct(PlayerRepository $playerRepository, GameRepository $gameRepository)
    {
        $this->playerRepository = $playerRepository;
        $this->gameRepository = $gameRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $parameters = $request->route()->parameters;
        $player_id = (int) $parameters['player_id'];
        $game_id = (int) $parameters['game_id'];
        if ($player_id == 0)
            return $next($request);
        else {
            $problem_found = false;
            $user_id = auth()->user()->id;
            $entry = $this->playerRepository->allWhere(['id' => $player_id],['user_id'])->all();
            if (sizeof($entry) == 0)
                $problem_found = true;
            else if ($entry[0]->user_id != $user_id)
                $problem_found = true;

            if ($game_id != 0) {
                $entry = $this->gameRepository->allWhere(['id' => $game_id], ['user_id'])->all();
                if (sizeof($entry) == 0)
                    $problem_found = true;
                else if ($entry[0]->user_id != $user_id)
                    $problem_found = true;
            }

            if ($problem_found)
                return abort(403, 'Unauthorized action.');
            else
                return $next($request);
        }
    }
}

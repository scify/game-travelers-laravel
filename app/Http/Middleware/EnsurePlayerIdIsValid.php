<?php

namespace App\Http\Middleware;

use App\Repository\Player\PlayerRepository;
use Closure;
use Illuminate\Http\Request;

class EnsurePlayerIdIsValid
{

    protected PlayerRepository $playerRepository;

    public function __construct(PlayerRepository $playerRepository)
    {
        $this->playerRepository = $playerRepository;
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
        $player_id = $request->cookie('player_id');
        if ($player_id == null)
            return $next($request);
        else {
            $user_id = auth()->user()->id;
            $entry = $this->playerRepository->allWhere(['id' => $player_id],['user_id'])->all();
            if (sizeof($entry) == 1 && $entry[0]->user_id == $user_id)
                return $next($request);
            return abort(403, 'Unauthorized action.');
        }
    }
}

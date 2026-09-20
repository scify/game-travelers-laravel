<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Repository\Game\GameRepository;
use App\Repository\Player\PlayerRepository;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
        $player_id = $this->id($request, 'player_id');
        $game_id = $this->id($request, 'game_id');
        $user_id = auth()->id();

        // No player in the route means none has been chosen, so there is
        // nothing here to check yet.
        if ($player_id === null) {
            return $next($request);
        }

        abort_unless($this->playerRepository->playerExists($player_id, $user_id), 403, __('messages.unauthorized_action'));

        if ($game_id !== null && ! $this->gameRepository->gameExists($game_id, $user_id)) {
            if ($this->gameRepository->gameExistsAsInactive($game_id, $user_id)) {
                return to_route('select.board', [$player_id]);
            }

            abort(403, __('messages.unauthorized_action'));
        }

        return $next($request);
    }

    /**
     * A route parameter as an integer, or null where the segment is absent.
     */
    private function id(Request $request, string $name): ?int
    {
        $value = $request->route()?->parameter($name);

        return $value === null ? null : (int) $value;
    }
}

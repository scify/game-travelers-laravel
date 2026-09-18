<?php

declare(strict_types=1);

namespace App\Http\Controllers\Debug;

use App\Http\Controllers\Controller;
use App\Http\Requests\Debug\SetGameStateRequest;
use App\Repository\Game\GameRepository;
use Illuminate\Http\JsonResponse;

/**
 * Stages a game for testing: writes the columns the debug strip asks for and returns the row.
 *
 * Reachable only through the EnsureDebugMode middleware; the game must belong to the visitor.
 */
final class GameStateController extends Controller
{
    public function __construct(private readonly GameRepository $gameRepository) {}

    public function store(SetGameStateRequest $request, int $game_id): JsonResponse
    {
        $game = $this->gameRepository->find($game_id);
        abort_if($game === null, 404);
        abort_if($game->user_id !== auth()->id(), 403, __('messages.unauthorized_action'));

        $this->gameRepository->update($request->gameAttributes(), $game_id);

        return new JsonResponse($this->gameRepository->find($game_id)?->only([
            'id', 'location_1', 'location_2', 'first_player_turn', 'game_phase', 'latest_random_result', 'active',
        ]));
    }
}

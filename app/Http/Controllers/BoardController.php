<?php

namespace App\Http\Controllers;

use App\Repository\Game\GameRepository;
use App\Repository\Player\PlayerRepository;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Boolean;

class BoardController extends Controller
{

    protected PlayerRepository $playerRepository;
    protected GameRepository $gameRepository;

    public function __construct(PlayerRepository $playerRepository, GameRepository $gameRepository)
    {
        $this->playerRepository = $playerRepository;
        $this->gameRepository = $gameRepository;
    }

    public function play(Request $request, int $player_id, int $game_id)
    {
        if ($player_id == 0 || $game_id == 0)
            return abort(403, 'Unauthorized action.');
        $player = $this->playerRepository->allWhere(['id' => $player_id]);
        $player_data = [
            'name' => $player[0]->name,
            'avatar_id' => $player[0]->avatar_id,
            'auto' => $player[0]->auto,
            'select_key' => $player[0]->select_key,
            'navigate_key' => $player[0]->navigate_key,
            'help_after_x_mistakes' => $player[0]->help_after_x_mistakes,
            'scanning_speed' => $player[0]->scanning_speed,
            'dice_type' => $player[0]->dice_type,
            'difficulty' => $player[0]->difficulty,
            'movement_mode' => $player[0]->movement_mode
        ];
        $game = $this->gameRepository->allWhere(['id' => $game_id]);
        $game_data = [
            'board' => $game[0]->board_id,
            'mode' => $game[0]->mode_id,
            'pawn1' => $game[0]->pawn_id_1,
            'pawn2' => $game[0]->pawn_id_2,
            'tutorial' => $game[0]->use_tutorial,
            'pos1' => $game[0]->location_1,
            'pos2' => $game[0]->location_2,
            'firstPlayerTurn' => $game[0]->first_player_turn,
            'board_size' => $game[0]->selected_board_size,
            'game_phase' => $game[0]->game_phase,
        ];
        return view('board', ['player_id' => $player_id, 'game_id' => $game_id, 'player_data' => $player_data, 'game_data' => $game_data]);
    }

    public function fromVue(Request $request)
    {
        $user_id = auth()->user()->id;
        $player_id = $request->player_id;
        $game_id = $request->game_id;
        $first_player_turn = $request->first_player_turn;
        $location_1 = $request->location_1;
		$location_2 = $request->location_2;
		$game_phase = $request->game_phase;

        $games = $this->gameRepository->allWhere(['id' => $game_id]);
        if (sizeof($games) != 1)
            return response(['message' => 'Game not found'], 302);
        else {
            $game = $games[0];
        }

        return response([ 'game_phase' => 1]);
    }

    protected function rollDieForPlayer() {

    }

}

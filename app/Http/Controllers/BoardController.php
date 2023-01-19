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
        $dice_type = $request->dice_type;
        $game_phase = $request->game_phase;
        $difficulty = $request->difficulty;
        $games = $this->gameRepository->allWhere(['id' => $game_id]);
        if (sizeof($games) != 1)
            return response(['message' => 'Game not found'], 302);
        else {
            $game = $games[0];

            if ($user_id != $game->user_id || $player_id != $game->player_id)
                return response(['message' => 'Unauthorized action.'], 403);

            $board_size = $game->selected_board_size;
            $tutorial_mode = $game->use_tutorial;
            $db_game_phase = $game->game_phase;
            $latest_random_result = $game->latest_random_result;
            $active_player_pos = $location_2;
            if ($first_player_turn)
                $active_player_pos = $location_1;

            //check if game is over
            if ($active_player_pos == $this->getFinalPos($board_size)) {
                if ($first_player_turn) {
                    $entry = ['active' => false, 'location_1' => $active_player_pos];
                    $this->gameRepository->updateOrCreate(['id' => $game_id], $entry);
                    return response(['gameEnded' => 1]);
                } else {
                    $entry = ['active' => false, 'location_2' => $active_player_pos];
                    $this->gameRepository->updateOrCreate(['id' => $game_id], $entry);
                    return response(['gameEnded' => -1]);
                }
            } else if ($game_phase == 1) { // asked to roll dice and compute new target position
                $new_position = $latest_random_result;
                if ($game_phase != $db_game_phase || $latest_random_result == 0) {
                    $new_position = $this->rollDieForPlayerAndReturnNewPosition($active_player_pos, $board_size, $tutorial_mode, $first_player_turn, $difficulty);
                    $entry = ['latest_random_result' => $new_position, 'game_phase' => 1];
                    $this->gameRepository->updateOrCreate(['id' => $game_id], $entry);
                }
                $dice_result = $new_position - $active_player_pos;
                if ($dice_type == 3)
                    $dice_result = $this->getColourIdOfPos($new_position);
                return response(['gameEnded' => 0, 'newPosition' => $new_position, 'diceResult' => $dice_result]);
            } else if ($game_phase == 2) { // move performed by die roll in the front-end
                //check if you must draw card
                $colour_id = $this->getColourIdOfPos($active_player_pos);
                if ($colour_id == 3 || $colour_id == 5) {
                    if ($db_game_phase != $game_phase) {
                        $latest_random_result = rand(1, 10);
                        $randomPolarity = rand(1, 2);
                        if ($randomPolarity == 2)
                            $latest_random_result = -1 * $latest_random_result;
                    }
                    $random_card = $latest_random_result;
                    $entry = ['latest_random_result' => $latest_random_result, 'game_phase' => 2, 'location_1' => $active_player_pos];
                    if (!$first_player_turn)
                        $entry = ['latest_random_result' => $latest_random_result, 'game_phase' => 2, 'location_2' => $active_player_pos];
                    $this->gameRepository->updateOrCreate(['id' => $game_id], $entry);
                    return response(['gameEnded' => 0, 'drawCard' => $random_card]);
                } else {
                    $entry = ['latest_random_result' => 0, 'game_phase' => 2, 'location_1' => $active_player_pos];
                    if (!$first_player_turn)
                        $entry = ['latest_random_result' => 0, 'game_phase' => 2, 'location_2' => $active_player_pos];
                    $this->gameRepository->updateOrCreate(['id' => $game_id], $entry);
                    return response(['gameEnded' => 0, 'drawCard' => 0]);
                }
            } else if ($game_phase == 3) { //move performed by card
                $entry = ['latest_random_result' => 0, 'game_phase' => 3, 'location_1' => $active_player_pos];
                if (!$first_player_turn)
                    $entry = ['latest_random_result' => 0, 'game_phase' => 3, 'location_2' => $active_player_pos];
                $this->gameRepository->updateOrCreate(['id' => $game_id], $entry);
                return response(['gameEnded' => 0]);
            }
        }
    }

    protected function rollDieForPlayerAndReturnNewPosition($pos, $board_size, $tutorial_mode, $first_player_turn, $difficulty): int
    {
        $final_pos = $this->getFinalPos($board_size);
        $roll_threshold = $final_pos - $pos;
        if ($roll_threshold > 6)
            $roll_threshold = 6;

        $dice_result = rand(1, $roll_threshold);
        if ($difficulty == 1 && $first_player_turn) {
            $dice_result2 = rand(1, $roll_threshold);
            if ($dice_result2 > $dice_result)
                $dice_result = $dice_result2;
        }

        if ($tutorial_mode && $first_player_turn) {
            if ($pos == 0)
                return 2;
            else if ($pos == 2)
                return 4;
            else if ($pos == 4)
                return 5;
        } elseif ($tutorial_mode && !$first_player_turn) {
            if ($pos == 0)
                return 1;
            else if ($pos == 1)
                return 4;
        }
        return $pos + $dice_result;
    }

    protected function getFinalPos(int $board_size): int
    {
        if ($board_size == 1)
            return 15;
        else if ($board_size == 2)
            return 30;
        else
            return 45;
    }

    protected function getColourIdOfPos(int $pos): int
    {
        $modulo = $pos % 6;
        if ($modulo == 0)
            return 6;
        else
            return $modulo;
    }

}

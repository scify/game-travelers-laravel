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
            abort(403, __('messages.unauthorized_action'));
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
            'movement_mode' => $player[0]->movement_mode,
            'music_volume' => (float)$player[0]->music_volume,
            'sound_volume' => (float)$player[0]->sound_volume,
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

        return view('board', ['player_id' => $player_id, 'game_id' => $game_id, 'player_data' => $player_data, 'game_data' => $game_data, 'cards' => $this->getCards($game[0]->board_id)]);
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
        $game_mode = $request->game_mode;
        $board_id = $request->board_id;
        $games = $this->gameRepository->allWhere(['id' => $game_id]);
        if (sizeof($games) != 1)
            return response(['message' => 'Game not found'], 302);
        else {
            $game = $games[0];

            if ($user_id != $game->user_id || $player_id != $game->player_id)
                return response(['message' => __('messages.unauthorized_action')], 403);

            $board_size = $game->selected_board_size;
            $tutorial_mode = $game->use_tutorial;
            $db_game_phase = $game->game_phase;
            $db_first_player_turn = $game->first_player_turn;
            $db_active_player_pos = $game->location_1;
            if (!$first_player_turn)
                $db_active_player_pos = $game->location_2;
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
                //check if call is made again before

                if ($game_phase == $db_game_phase) {
                    $active_player_pos = $db_active_player_pos;
                }
                //check if you must draw card
                $colour_id = $this->getColourIdOfPos($active_player_pos);
                if ($colour_id == 3 || $colour_id == 5) {
                    if ($db_game_phase != $game_phase) {
                        $latest_random_result = $this->getAValidCard($board_size, $active_player_pos, $board_id, $tutorial_mode);
                    }
                    $random_card = $latest_random_result;
                    if ($game_phase != $db_game_phase) {
                        $entry = ['latest_random_result' => $latest_random_result, 'game_phase' => 2, 'location_1' => $active_player_pos];
                        if (!$first_player_turn)
                            $entry = ['latest_random_result' => $latest_random_result, 'game_phase' => 2, 'location_2' => $active_player_pos];
                        $this->gameRepository->updateOrCreate(['id' => $game_id], $entry);
                    }
                    return response(['gameEnded' => 0, 'drawCard' => $random_card, 'firstPlayerTurn' => $db_first_player_turn]);
                } else {
                    if ($game_phase != $db_game_phase) {
                        $first_player_turn_new_value = true;
                        if ($game_mode > 1) { // switch player only if the game is not solo
                            if ($first_player_turn)
                                $first_player_turn_new_value = false;
                        }
                        $entry = ['latest_random_result' => 0, 'game_phase' => 2, 'location_1' => $active_player_pos, 'first_player_turn' => $first_player_turn_new_value];
                        if (!$first_player_turn)
                            $entry = ['latest_random_result' => 0, 'game_phase' => 2, 'location_2' => $active_player_pos, 'first_player_turn' => $first_player_turn_new_value];
                        $this->gameRepository->updateOrCreate(['id' => $game_id], $entry);
                        return response(['gameEnded' => 0, 'drawCard' => 0, 'firstPlayerTurn' => $first_player_turn_new_value]);
                    } else
                        return response(['gameEnded' => 0, 'drawCard' => 0, 'firstPlayerTurn' => $db_first_player_turn]);
                }
            } else if ($game_phase == 3) { //move performed by card
                if ($game_phase != $db_game_phase) {
                    $first_player_turn_new_value = true;
                    if ($game_mode > 1) { // switch player only if the game is not solo
                        if ($first_player_turn)
                            $first_player_turn_new_value = false;
                    }
                    $entry = ['latest_random_result' => 0, 'game_phase' => 3, 'location_1' => $active_player_pos, 'first_player_turn' => $first_player_turn_new_value];
                    if (!$first_player_turn)
                        $entry = ['latest_random_result' => 0, 'game_phase' => 3, 'location_2' => $active_player_pos, 'first_player_turn' => $first_player_turn_new_value];
                    $this->gameRepository->updateOrCreate(['id' => $game_id], $entry);
                    return response(['gameEnded' => 0, 'firstPlayerTurn' => $first_player_turn_new_value]);
                } else
                    return response(['gameEnded' => 0, 'firstPlayerTurn' => $db_first_player_turn]);
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
                return 4;
            else if ($pos == 4)
                return 6;
            else if ($pos == 6)
                return 9;
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
        if ($modulo === 0)
            return 6;
        else
            return $modulo;
    }

    protected function getAValidCard($board_size, $pos, $board_id, $is_tutorial): int
    {
        $max = $this->getFinalPos($board_size);
        $random = rand(1, 10);
        if (!$is_tutorial) {
            $randomPolarity = rand(1, 2);
            if ($randomPolarity == 2)
                $random *= -1;
        }
        $value = $this->getCards($board_id)[$random]['value'];
        $new_pos = $value + $pos;
        if ($new_pos <= 0) { //the card was negative we need a smaller card
            $random = -1 * rand(1, 7);
            $value = $this->getCards($board_id)[$random]['value'];
            if (($value + $pos) <= 0)
                $random = -1 * rand(1, 3);
        } else if ($new_pos > $max) { //the card was positive we need a smaller positive card
            $random = rand(1, 7);
            $value = $this->getCards($board_id)[$random]['value'];
            if (($value + $pos) > $max)
                $random = rand(1, 3);
        }
        return $random;
    }

    protected function getCards($board_id)
    {
        if ($board_id == 1) {
            return [
                1 => [
                    'name' => 'Fish',
                    'value' => 1,
                ],
                2 => [
                    'name' => 'Dolphin',
                    'value' => 1,
                ],
                3 => [
                    'name' => 'Note',
                    'value' => 1,
                ],
                4 => [
                    'name' => 'Map',
                    'value' => 1,
                ],
                5 => [
                    'name' => 'Van',
                    'value' => 3,
                ],
                6 => [
                    'name' => 'Boat',
                    'value' => 3,
                ],
                7 => [
                    'name' => 'Mermaid',
                    'value' => 3,
                ],

                8 => [
                    'name' => 'Car',
                    'value' => 5,
                ],
                9 => [
                    'name' => 'Octopus',
                    'value' => 5,
                ],
                10 => [
                    'name' => 'Path',
                    'value' => 5,
                ],
                -1 => [
                    'name' => 'Tire',
                    'value' => -1,
                ],
                -2 => [
                    'name' => 'IceCream',
                    'value' => -1,
                ],
                -3 => [
                    'name' => 'Pelican',
                    'value' => -1,
                ],
                -4 => [
                    'name' => 'Cow',
                    'value' => -3,
                ],
                -5 => [
                    'name' => 'Water',
                    'value' => -3,
                ],
                -6 => [
                    'name' => 'Wind',
                    'value' => -3,
                ],
                -7 => [
                    'name' => 'Crab',
                    'value' => -3,
                ],
                -8 => [
                    'name' => 'WrongPath',
                    'value' => -5,
                ],
                -9 => [
                    'name' => 'Bird',
                    'value' => -5,
                ],
                -10 => [
                    'name' => 'Hat',
                    'value' => -5,
                ],
            ];
        } else if ($board_id == 2) {
            return [
                1 => [
                    'name' => 'Map',
                    'value' => 1,
                ],
                2 => [
                    'name' => 'Deer',
                    'value' => 1,
                ],
                3 => [
                    'name' => 'Skier',
                    'value' => 1,
                ],
                4 => [
                    'name' => 'Snowman',
                    'value' => 3,
                ],
                5 => [
                    'name' => 'Car',
                    'value' => 3,
                ],
                6 => [
                    'name' => 'Note',
                    'value' => 3,
                ],
                7 => [
                    'name' => 'Shovel',
                    'value' => 3,
                ],
                8 => [
                    'name' => 'OldMan',
                    'value' => 5,
                ],
                9 => [
                    'name' => 'CableCar',
                    'value' => 5,
                ],
                10 => [
                    'name' => 'Sleigh',
                    'value' => 5,
                ],
                -1 => [
                    'name' => 'Chocolate',
                    'value' => -1,
                ],
                -2 => [
                    'name' => 'Scarf',
                    'value' => -1,
                ],
                -3 => [
                    'name' => 'Cap',
                    'value' => -1,
                ],
                -4 => [
                    'name' => 'WrongPath',
                    'value' => -3,
                ],
                -5 => [
                    'name' => 'WrongNote',
                    'value' => -3,
                ],
                -6 => [
                    'name' => 'Wind',
                    'value' => -3,
                ],
                -7 => [
                    'name' => 'Squirrel',
                    'value' => -3,
                ],
                -8 => [
                    'name' => 'Snow',
                    'value' => -5,
                ],
                -9 => [
                    'name' => 'Hail',
                    'value' => -5,
                ],
                -10 => [
                    'name' => 'Bear',
                    'value' => -5,
                ],
            ];
        } else return [];
    }

}

<?php

declare(strict_types=1);

namespace App\Http\Requests\Debug;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * The fields the board's debug strip may stage on a game. Every field is optional.
 */
final class SetGameStateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, list<mixed>>
     */
    public function rules(): array
    {
        return [
            'pos1' => ['sometimes', Rule::numeric()->integer()->between(0, 45)],
            'pos2' => ['sometimes', Rule::numeric()->integer()->between(0, 45)],
            'phase' => ['sometimes', Rule::numeric()->integer()->between(1, 3)],
            'turn' => ['sometimes', 'boolean'],
            'next' => ['sometimes', Rule::numeric()->integer()->between(1, 45)],
            'card' => ['sometimes', Rule::numeric()->integer()->between(-10, 10), Rule::notIn([0])],
        ];
    }

    /**
     * The games columns to write, from the fields present.
     *
     * next and card both land in latest_random_result: in game_phase 1 the
     * backend returns it as the square the next roll reaches, in game_phase 2 on
     * a card square as the card to draw. A staged game is active again.
     *
     * @return array<string, int|bool>
     */
    public function gameAttributes(): array
    {
        $input = $this->safe();
        $columns = [
            'pos1' => 'location_1',
            'pos2' => 'location_2',
            'phase' => 'game_phase',
            'next' => 'latest_random_result',
            'card' => 'latest_random_result',
        ];

        $attributes = ['active' => true];
        foreach ($columns as $field => $column) {
            if ($input->has($field)) {
                $attributes[$column] = $input->integer($field);
            }
        }

        if ($input->has('turn')) {
            $attributes['first_player_turn'] = $input->boolean('turn');
        }

        return $attributes;
    }
}

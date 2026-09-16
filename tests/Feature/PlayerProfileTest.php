<?php

namespace Tests\Feature;

use App\Models\Player;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PlayerProfileTest extends TestCase {
    use RefreshDatabase;

    protected $seed = true;

    public function test_the_new_player_form_opens(): void {
        $this->actingAs($this->seededUser())
            ->get(route('new.player', [0, 'user', 0]))
            ->assertOk();
    }

    public function test_a_new_player_is_created_and_the_flow_continues_with_controls(): void {
        $this->actingAs($this->seededUser())
            ->post(route('new.player', [0, 'user', 0]), ['name' => ' Μαρία ', 'avatarId' => 3]);

        $player = Player::where('name', 'Μαρία')->firstOrFail();
        $this->assertSame(2, $player->user_id);
        $this->assertSame(3, $player->avatar_id);
    }

    public function test_creating_a_player_redirects_to_its_controls(): void {
        $response = $this->actingAs($this->seededUser())
            ->post(route('new.player', [0, 'user', 0]), ['name' => 'Μαρία', 'avatarId' => 3]);

        $player = Player::where('name', 'Μαρία')->firstOrFail();
        $response->assertRedirect(route('controls.player', [$player->id, 'user', 0]));
    }

    // The check lowercases with strtolower(), which leaves Greek capitals alone, so only an exact
    // duplicate is caught today. Making it mb_strtolower() is a behaviour change, tracked in the plan.
    public function test_a_duplicate_player_name_is_rejected(): void {
        $this->actingAs($this->seededUser())
            ->from(route('new.player', [0, 'user', 0]))
            ->post(route('new.player', [0, 'user', 0]), ['name' => 'Κώστας Παπ.', 'avatarId' => 3])
            ->assertRedirect(route('new.player', [0, 'user', 0]))
            ->assertSessionHasErrors('name');

        $this->assertSame(2, Player::where('user_id', 2)->count());
    }

    public function test_controls_are_saved_and_the_flow_continues_with_difficulty(): void {
        $this->actingAs($this->seededUser())
            ->post(route('controls.player', [1, 'user', 0]), [
                'controlType' => 2,
                'controlAutomaticSelectionButton' => 'Enter',
                'controlManualSelectionButton' => 'a',
                'controlManualNavigationButton' => 'b',
                'helpAfterTries' => 2,
                'scanningSpeed' => 3,
                'submit' => 'next',
            ])
            ->assertRedirect(route('difficulty.player', [1, 'user', 0]));

        $this->assertDatabaseHas('players', [
            'id' => 1,
            'auto' => 2,
            'select_key' => 'a',
            'navigate_key' => 'b',
            'help_after_x_mistakes' => 2,
            'scanning_speed' => 3,
        ]);
    }

    public function test_difficulty_is_saved_and_the_flow_returns_to_player_selection(): void {
        $this->actingAs($this->seededUser())
            ->post(route('difficulty.player', [1, 'user', 0]), [
                'dice' => 3,
                'gameDuration' => 1,
                'level' => 2,
                'movement' => 3,
                'submit' => 'save',
            ])
            ->assertRedirect(route('select.player', [0, 'user', 0]));

        $this->assertDatabaseHas('players', [
            'id' => 1,
            'dice_type' => 3,
            'board_size' => 1,
            'difficulty' => 2,
            'movement_mode' => 3,
        ]);
    }

    public function test_volumes_are_saved_from_the_board(): void {
        $this->actingAs($this->seededUser())
            ->post(route('audio.updateVolumes'), ['player_id' => 1, 'music_volume' => 0.5, 'sound_volume' => 0.7])
            ->assertOk();

        $player = $this->seededPlayer();
        $this->assertEqualsWithDelta(0.5, $player->music_volume, 0.001);
        $this->assertEqualsWithDelta(0.7, $player->sound_volume, 0.001);
    }
}

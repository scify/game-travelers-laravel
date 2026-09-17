<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Player;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PlayerProfileTest extends TestCase
{
    use LazilyRefreshDatabase;

    protected $seed = true;

    #[Test]
    public function new_player_form_opens(): void
    {
        $this->actingAs($this->seededUser())
            ->get(route('new.player', [0, 'user', 0]))
            ->assertOk();
    }

    #[Test]
    public function new_player_is_created_with_trimmed_name(): void
    {
        $this->actingAs($this->seededUser())
            ->post(route('new.player', [0, 'user', 0]), ['name' => ' Μαρία ', 'avatarId' => 3]);

        $player = Player::where('name', 'Μαρία')->firstOrFail();
        $this->assertSame(2, $player->user_id);
        $this->assertSame(3, $player->avatar_id);
    }

    #[Test]
    public function creating_player_redirects_to_its_controls(): void
    {
        $response = $this->actingAs($this->seededUser())
            ->post(route('new.player', [0, 'user', 0]), ['name' => 'Μαρία', 'avatarId' => 3]);

        $player = Player::where('name', 'Μαρία')->firstOrFail();
        $response->assertRedirect(route('controls.player', [$player->id, 'user', 0]));
    }

    #[Test]
    public function duplicate_player_name_is_rejected_case_insensitively(): void
    {
        $this->actingAs($this->seededUser())
            ->from(route('new.player', [0, 'user', 0]))
            ->post(route('new.player', [0, 'user', 0]), ['name' => 'κώστας παπ.', 'avatarId' => 3])
            ->assertRedirect(route('new.player', [0, 'user', 0]))
            ->assertSessionHasErrors('name');

        $this->assertSame(2, Player::where('user_id', 2)->count());
    }

    #[Test]
    public function renaming_player_from_settings_is_saved(): void
    {
        $this->actingAs($this->seededUser())
            ->post(route('settings.profile', [1, 'user', 0]), ['name' => 'Κωνσταντίνος', 'avatarId' => 6])
            ->assertRedirect(route('settings', [1, 'user', 0]));

        $this->assertDatabaseHas('players', ['id' => 1, 'name' => 'Κωνσταντίνος', 'avatar_id' => 6]);
    }

    #[Test]
    public function renaming_player_to_name_of_another_player_is_rejected_case_insensitively(): void
    {
        $this->actingAs($this->seededUser())
            ->from(route('settings.profile', [1, 'user', 0]))
            ->post(route('settings.profile', [1, 'user', 0]), ['name' => 'ΝΊΚΗ ΚΑΡΑΓ.', 'avatarId' => 5])
            ->assertRedirect(route('settings.profile', [1, 'user', 0]))
            ->assertSessionHasErrors('name');

        $this->assertDatabaseHas('players', ['id' => 1, 'name' => 'Κώστας Παπ.']);
    }

    #[Test]
    public function saving_controls_continues_to_difficulty(): void
    {
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

    #[Test]
    public function saving_difficulty_returns_to_player_selection(): void
    {
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

    #[Test]
    public function volumes_are_saved_from_board(): void
    {
        $this->actingAs($this->seededUser())
            ->post(route('audio.updateVolumes'), ['player_id' => 1, 'music_volume' => 0.5, 'sound_volume' => 0.7])
            ->assertOk();

        $player = $this->seededPlayer();
        $this->assertEqualsWithDelta(0.5, $player->music_volume, 0.001);
        $this->assertEqualsWithDelta(0.7, $player->sound_volume, 0.001);
    }
}

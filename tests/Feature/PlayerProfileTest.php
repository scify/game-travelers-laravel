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
            ->get(route('create.profile'))
            ->assertOk();
    }

    #[Test]
    public function new_player_is_created_with_trimmed_name(): void
    {
        $name = 'Μαρία';
        $avatarId = 3;

        $this->actingAs($this->seededUser())
            ->post(route('create.profile'), ['name' => ' ' . $name . ' ', 'avatarId' => $avatarId]);

        $player = Player::query()->where('name', $name)->firstOrFail();
        $this->assertSame(2, $player->user_id);
        $this->assertSame($avatarId, $player->avatar_id);
    }

    #[Test]
    public function creating_player_redirects_to_its_controls(): void
    {
        $name = 'Γιώργος';

        $response = $this->actingAs($this->seededUser())
            ->post(route('create.profile'), ['name' => $name, 'avatarId' => 3]);

        $player = Player::query()->where('name', $name)->firstOrFail();
        $response->assertRedirect(route('create.controls', [$player->id]));
    }

    #[Test]
    public function duplicate_player_name_is_rejected_case_insensitively(): void
    {
        $newPlayer = route('create.profile');
        $taken = 'κώστας παπ.';

        $this->actingAs($this->seededUser())
            ->from($newPlayer)
            ->post($newPlayer, ['name' => $taken, 'avatarId' => 3])
            ->assertRedirect($newPlayer)
            ->assertSessionHasErrors('name')
            ->assertSessionHasInput('name', $taken);

        $this->assertSame(2, Player::query()->where('user_id', 2)->count());
    }

    #[Test]
    public function renaming_player_from_settings_is_saved(): void
    {
        $name = 'Κωνσταντίνος';
        $avatarId = 6;

        $this->actingAs($this->seededUser())
            ->post(route('settings.profile', [1, 'user']), ['name' => $name, 'avatarId' => $avatarId])
            ->assertRedirect(route('settings.index', [1, 'user']));

        $this->assertDatabaseHas('players', ['id' => 1, 'name' => $name, 'avatar_id' => $avatarId]);
    }

    #[Test]
    public function renaming_player_to_name_of_another_player_is_rejected_case_insensitively(): void
    {
        $profile = route('settings.profile', [1, 'user']);
        $taken = 'ΝΊΚΗ ΚΑΡΑΓ.';

        $this->actingAs($this->seededUser())
            ->from($profile)
            ->post($profile, ['name' => $taken, 'avatarId' => 5])
            ->assertRedirect($profile)
            ->assertSessionHasErrors('name')
            ->assertSessionHasInput('name', $taken);

        $this->assertDatabaseHas('players', ['id' => 1, 'name' => 'Κώστας Παπ.']);
    }

    #[Test]
    public function renaming_player_with_taken_name_returns_typed_name_and_chosen_avatar(): void
    {
        $profile = route('settings.profile', [1, 'user']);
        $taken = 'ΝΊΚΗ ΚΑΡΑΓ.';
        $avatarId = 2;

        $this->actingAs($this->seededUser())
            ->from($profile)
            ->followingRedirects()
            ->post($profile, ['name' => $taken, 'avatarId' => $avatarId])
            ->assertOk()
            ->assertSeeHtml('value="' . $taken . '"')
            ->assertSeeHtml('data-value="' . $avatarId . '"');

        $this->assertDatabaseHas('players', ['id' => 1, 'name' => 'Κώστας Παπ.', 'avatar_id' => 5]);
    }

    #[Test]
    public function controls_form_shows_saved_keys(): void
    {
        $selectionKey = 'a';
        $navigationKey = 'b';

        Player::query()->where('id', 1)->update([
            'auto' => 2,
            'select_key' => $selectionKey,
            'navigate_key' => $navigationKey,
        ]);

        $this->actingAs($this->seededUser())
            ->get(route('create.controls', [1]))
            ->assertOk()
            ->assertSeeHtml('name="controlManualSelectionButton" value="' . $selectionKey . '"')
            ->assertSeeHtml('name="controlManualNavigationButton" value="' . $navigationKey . '"');
    }

    #[Test]
    public function saving_controls_continues_to_difficulty(): void
    {
        $controlType = 2;
        $selectionKey = 'a';
        $navigationKey = 'b';
        $helpAfterTries = 2;
        $scanningSpeed = 3;

        $this->actingAs($this->seededUser())
            ->post(route('create.controls', [1]), [
                'controlType' => $controlType,
                'controlAutomaticSelectionButton' => 'Enter',
                'controlManualSelectionButton' => $selectionKey,
                'controlManualNavigationButton' => $navigationKey,
                'helpAfterTries' => $helpAfterTries,
                'scanningSpeed' => $scanningSpeed,
                'submit' => 'next',
            ])
            ->assertRedirect(route('create.difficulty', [1]));

        $this->assertDatabaseHas('players', [
            'id' => 1,
            'auto' => $controlType,
            'select_key' => $selectionKey,
            'navigate_key' => $navigationKey,
            'help_after_x_mistakes' => $helpAfterTries,
            'scanning_speed' => $scanningSpeed,
        ]);
    }

    #[Test]
    public function difficulty_form_shows_saved_choices(): void
    {
        $gameDuration = 3;
        $movement = 1;

        Player::query()->where('id', 1)->update([
            'board_size' => $gameDuration,
            'movement_mode' => $movement,
        ]);

        $response = $this->actingAs($this->seededUser())
            ->get(route('create.difficulty', [1]));

        $response->assertOk();

        $page = $response->getContent() ?: '';
        $this->assertMatchesRegularExpression('/id="gameDuration' . $gameDuration . '"[^>]*\schecked/', $page);
        $this->assertMatchesRegularExpression('/id="movement' . $movement . '"[^>]*\schecked/', $page);
    }

    #[Test]
    public function saving_difficulty_returns_to_player_selection(): void
    {
        $dice = 3;
        $gameDuration = 1;
        $level = 2;
        $movement = 3;

        $this->actingAs($this->seededUser())
            ->post(route('create.difficulty', [1]), [
                'dice' => $dice,
                'gameDuration' => $gameDuration,
                'level' => $level,
                'movement' => $movement,
                'submit' => 'save',
            ])
            ->assertRedirect(route('select.player'));

        $this->assertDatabaseHas('players', [
            'id' => 1,
            'dice_type' => $dice,
            'board_size' => $gameDuration,
            'difficulty' => $level,
            'movement_mode' => $movement,
        ]);
    }

    #[Test]
    public function volumes_are_saved_from_board(): void
    {
        $musicVolume = 0.5;
        $soundVolume = 0.7;

        $this->actingAs($this->seededUser())
            ->post(route('audio.updateVolumes'), ['player_id' => 1, 'music_volume' => $musicVolume, 'sound_volume' => $soundVolume])
            ->assertOk();

        $player = $this->seededPlayer();
        $this->assertEqualsWithDelta($musicVolume, $player->music_volume, 0.001);
        $this->assertEqualsWithDelta($soundVolume, $player->sound_volume, 0.001);
    }
}

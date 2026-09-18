<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * The volume endpoint receives what the settings scripts send: a JSON body whose
 * player id and slider value are strings, because they are sliced from a URL and
 * read from an input.
 */
class AudioVolumeTest extends TestCase
{
    use LazilyRefreshDatabase;

    protected $seed = true;

    #[Test]
    public function volume_update_stores_music_volume_sent_as_string(): void
    {
        $player = $this->seededPlayer();

        $this->actingAs($this->seededUser())
            ->postJson(route('audio.updateVolumes'), ['player_id' => (string) $player->id, 'music_volume' => '0.35'])
            ->assertOk();

        $this->assertDatabaseHas('players', ['id' => $player->id, 'music_volume' => 0.35]);
    }

    #[Test]
    public function volume_update_stores_sound_volume_without_touching_music_volume(): void
    {
        $player = $this->seededPlayer();
        $musicBefore = $player->music_volume;

        $this->actingAs($this->seededUser())
            ->postJson(route('audio.updateVolumes'), ['player_id' => (string) $player->id, 'sound_volume' => '0.6'])
            ->assertOk();

        $this->assertDatabaseHas('players', ['id' => $player->id, 'music_volume' => $musicBefore, 'sound_volume' => 0.6]);
    }
}

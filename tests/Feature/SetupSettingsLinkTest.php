<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Game;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SetupSettingsLinkTest extends TestCase
{
    use LazilyRefreshDatabase;

    protected $seed = true;

    /**
     * Every setup page that offers the settings menu, and the name it carries.
     *
     * @return array<string, array{route: string, step: string}>
     */
    public static function setupPageProvider(): array
    {
        return [
            'continue' => ['route' => 'select.continue', 'step' => 'continue'],
            'board' => ['route' => 'select.board', 'step' => 'board'],
            'mode' => ['route' => 'select.mode', 'step' => 'mode'],
            'pawn' => ['route' => 'select.pawn', 'step' => 'pawn'],
            'second pawn' => ['route' => 'select.pawnTwo', 'step' => 'pawn-two'],
            'options' => ['route' => 'select.options', 'step' => 'option'],
        ];
    }

    #[Test]
    #[DataProvider('setupPageProvider')]
    public function settings_link_carries_step_of_page_it_sits_on(string $route, string $step): void
    {
        $game = $this->unstartedGame();

        $response = $this->actingAs($this->seededUser())
            ->get(route($route, [$game->player_id, $game->id]));

        $response->assertOk();

        $this->assertSame(
            route('settings.index', [$game->player_id, $step, $game->id]),
            $this->settingsLinkOf($response->getContent() ?: ''),
        );
    }

    #[Test]
    public function settings_link_on_settings_page_passes_step_through(): void
    {
        $game = $this->unstartedGame();

        $response = $this->actingAs($this->seededUser())
            ->get(route('settings.profile', [$game->player_id, 'pawn', $game->id]));

        $response->assertOk();

        $this->assertSame(
            route('settings.index', [$game->player_id, 'pawn', $game->id]),
            $this->settingsLinkOf($response->getContent() ?: ''),
        );
    }

    #[Test]
    public function settings_page_rejects_unknown_step(): void
    {
        $game = $this->unstartedGame();

        $this->actingAs($this->seededUser())
            ->get(route('settings.index', [$game->player_id, 'nonsense', $game->id]))
            ->assertNotFound();
    }

    #[Test]
    public function settings_page_rejects_step_in_wrong_case(): void
    {
        $game = $this->unstartedGame();

        $this->actingAs($this->seededUser())
            ->get(route('settings.index', [$game->player_id, 'BOARD', $game->id]))
            ->assertNotFound();
    }

    private function unstartedGame(): Game
    {
        return $this->startedGame($this->seededPlayer(), [
            'started' => false,
            'mode_id' => 2,
            'pawn_id_1' => 1,
            'pawn_id_2' => 0,
        ]);
    }

    private function settingsLinkOf(string $html): string
    {
        $menuItem = '#<a class="user-menu-item dropdown-item" href="([^"]*/settings/[^"]*)"#';
        if (preg_match($menuItem, $html, $href) !== 1) {
            $this->fail('The user menu rendered no link to the settings page.');
        }

        return $href[1];
    }
}

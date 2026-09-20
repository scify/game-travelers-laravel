<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SetupBackLinkTest extends TestCase
{
    use LazilyRefreshDatabase;

    /**
     * The value every route expects to see in its own {from} segment.
     *
     * A page carries this so that settings, opened from it, knows where to
     * return. A link that sends a visitor to a page must therefore stamp the
     * name of that page, not of any other.
     *
     * @var array<string, string>
     */
    private const array OWN_NAME = [
        'select.player' => 'user',
        'select.continue' => 'continue',
        'select.board' => 'board',
        'select.mode' => 'mode',
        'select.pawn' => 'pawn',
        'select.pawnTwo' => 'pawn-two',
        'select.options' => 'option',
    ];

    protected $seed = true;

    /**
     * @return array<string, array{route: string}>
     */
    public static function pageWithBackLinkProvider(): array
    {
        return [
            'continue' => ['route' => 'select.continue'],
            'board' => ['route' => 'select.board'],
            'mode' => ['route' => 'select.mode'],
            'pawn' => ['route' => 'select.pawn'],
            'second pawn' => ['route' => 'select.pawnTwo'],
            'options' => ['route' => 'select.options'],
        ];
    }

    #[Test]
    #[DataProvider('pageWithBackLinkProvider')]
    public function setup_back_link_names_page_it_points_to(string $route): void
    {
        $game = $this->startedGame($this->seededPlayer(), [
            'started' => false,
            'mode_id' => 2,
            'pawn_id_1' => 1,
            'pawn_id_2' => 0,
        ]);

        $response = $this->actingAs($this->seededUser())
            ->get(route($route, [$game->player_id, self::OWN_NAME[$route], $game->id]));

        $response->assertOk();

        $destination = Route::getRoutes()->match(Request::create($this->backLinkOf($response->getContent() ?: '')));
        $name = $destination->getName();

        $this->assertArrayHasKey($name, self::OWN_NAME, "Back link of $route points at $name, which carries no name of its own.");
        $this->assertSame(self::OWN_NAME[$name], $destination->parameter('from'), "Back link of $route sends a visitor to $name but stamps another page.");
    }

    private function backLinkOf(string $html): string
    {
        if (preg_match('/<a\b[^>]*\bid="backButton"[^>]*>/', $html, $tag) !== 1) {
            $this->fail('No element with id backButton was rendered.');
        }

        if (preg_match('/\bhref="([^"]+)"/', $tag[0], $href) !== 1) {
            $this->fail('The back link carries no href.');
        }

        return $href[1];
    }
}

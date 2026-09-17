<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    use LazilyRefreshDatabase;

    /**
     * @return array<string, array{uri: string}>
     */
    public static function publicPageProvider(): array
    {
        return [
            'landing' => ['uri' => '/'],
            'about' => ['uri' => '/about'],
            'credits' => ['uri' => '/credits'],
            'cookie policy' => ['uri' => '/cookies-policy'],
            'login' => ['uri' => '/login'],
            'register' => ['uri' => '/register'],
        ];
    }

    #[Test]
    #[DataProvider('publicPageProvider')]
    public function public_page_renders_for_guest(string $uri): void
    {
        $this->get($uri)->assertOk();
    }

    #[Test]
    public function landing_page_shows_game_title_and_testimonials(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('Ταξιδιώτες')
            ->assertSee('ΕΛΕΠΑΠ');
    }
}

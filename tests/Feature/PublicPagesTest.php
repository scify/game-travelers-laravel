<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicPagesTest extends TestCase {
    use RefreshDatabase;

    public function test_public_pages_render_for_guests(): void {
        foreach (['/', '/about', '/credits', '/cookies-policy', '/login', '/register'] as $uri) {
            $this->get($uri)->assertOk();
        }
    }

    public function test_home_page_shows_the_game_title_and_the_testimonials(): void {
        $this->get('/')
            ->assertOk()
            ->assertSee('Ταξιδιώτες')
            ->assertSee('ΕΛΕΠΑΠ');
    }
}

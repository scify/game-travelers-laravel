<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * robots.txt is served by the application so it can name the installation's own sitemap URL.
 */
class RobotsTest extends TestCase
{
    use LazilyRefreshDatabase;

    #[Test]
    public function robots_file_allows_crawling_and_names_sitemap(): void
    {
        $this->get('/robots.txt')
            ->assertOk()
            ->assertHeader('Content-Type', 'text/plain; charset=UTF-8')
            ->assertSeeHtml("User-agent: *\nDisallow:\n")
            ->assertSeeHtml('Sitemap: ' . url('sitemap.xml'));
    }
}

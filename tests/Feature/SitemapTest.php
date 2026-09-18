<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Support\Facades\File;
use PHPUnit\Framework\Attributes\Test;
use SimpleXMLElement;
use Tests\TestCase;

/**
 * sitemap:generate writes the file the deploy publishes, from the installation's own URL.
 *
 * The public path is moved to a scratch directory for each test, so the
 * developer's own public/sitemap.xml is never touched.
 */
class SitemapTest extends TestCase
{
    use LazilyRefreshDatabase;

    private string $publicPath;

    protected function setUp(): void
    {
        parent::setUp();

        $this->publicPath = sys_get_temp_dir() . '/sitemap-test-' . uniqid();
        File::makeDirectory($this->publicPath);
        $this->app->usePublicPath($this->publicPath);
    }

    protected function tearDown(): void
    {
        File::deleteDirectory($this->publicPath);

        parent::tearDown();
    }

    #[Test]
    public function command_writes_sitemap_into_public_directory(): void
    {
        $this->artisan('sitemap:generate')->assertSuccessful();

        $this->assertFileExists($this->publicPath . '/sitemap.xml');
    }

    #[Test]
    public function sitemap_lists_public_pages_by_priority(): void
    {
        $locations = array_map(
            static fn (SimpleXMLElement $url): string => (string) $url->loc,
            iterator_to_array($this->generatedSitemap()->url, false),
        );

        $this->assertSame([route('home'), route('login'), route('register'), route('about')], $locations);
    }

    #[Test]
    public function sitemap_entries_carry_logo_image(): void
    {
        foreach ($this->generatedSitemap()->url as $url) {
            $image = $url->children('image', true);
            $this->assertInstanceOf(SimpleXMLElement::class, $image);

            $this->assertSame(asset('images/taxidiotes_logo.webp'), (string) $image->image->loc);
            $this->assertNotSame('', (string) $image->image->caption);
        }
    }

    private function generatedSitemap(): SimpleXMLElement
    {
        $this->artisan('sitemap:generate')->assertSuccessful();
        $sitemap = simplexml_load_file($this->publicPath . '/sitemap.xml');
        $this->assertNotFalse($sitemap);

        return $sitemap;
    }
}

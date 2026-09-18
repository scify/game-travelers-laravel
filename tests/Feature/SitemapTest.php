<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use SimpleXMLElement;
use Tests\TestCase;

/**
 * sitemap:generate writes the file the deploy publishes, from the installation's own URL.
 *
 * The public path is moved to a scratch directory while the command runs, so
 * the developer's own public/sitemap.xml is never touched. Pages are fetched
 * before the move: they read the published assets from the real public path.
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
    }

    protected function tearDown(): void
    {
        File::deleteDirectory($this->publicPath);

        parent::tearDown();
    }

    /**
     * @return array<string, array{string}>
     */
    public static function publicPages(): array
    {
        return [
            'landing page' => ['home'],
            'login' => ['login'],
            'registration' => ['register'],
            'about' => ['about'],
        ];
    }

    #[Test]
    public function command_writes_sitemap_into_public_directory(): void
    {
        $this->generateSitemap();

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
    #[DataProvider('publicPages')]
    public function sitemap_entry_mirrors_page_title_and_social_image(string $route): void
    {
        $html = $this->get(route($route))->assertOk()->getContent();
        $this->assertIsString($html);
        $title = $this->decoded(Str::betweenFirst($html, '<title>', '</title>'));
        $socialImage = $this->decoded(Str::betweenFirst($html, 'property="og:image" content="', '"'));

        $entry = array_find(
            iterator_to_array($this->generatedSitemap()->url, false),
            static fn (SimpleXMLElement $url): bool => (string) $url->loc === route($route),
        );
        $this->assertInstanceOf(SimpleXMLElement::class, $entry);
        $image = $entry->children('image', true);
        $this->assertInstanceOf(SimpleXMLElement::class, $image);

        $this->assertSame($title, (string) $image->image->caption);
        $this->assertSame($socialImage, (string) $image->image->loc);
    }

    /** Runs the command with the public path moved to the scratch directory. */
    private function generateSitemap(): void
    {
        $this->app->usePublicPath($this->publicPath);
        $this->artisan('sitemap:generate')->assertSuccessful();
    }

    private function generatedSitemap(): SimpleXMLElement
    {
        $this->generateSitemap();
        $sitemap = simplexml_load_file($this->publicPath . '/sitemap.xml');
        $this->assertNotFalse($sitemap);

        return $sitemap;
    }

    /** Text as Blade rendered it, with the HTML escaping undone. */
    private function decoded(string $html): string
    {
        return html_entity_decode($html, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }
}

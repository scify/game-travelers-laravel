<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * The Google tag loads only once the visitor has consented to analytics.
 *
 * The layout reads the consent cookie from $_COOKIE, so the tests set it there.
 */
class AnalyticsTagTest extends TestCase
{
    use LazilyRefreshDatabase;

    protected function tearDown(): void
    {
        unset($_COOKIE[$this->consentCookie()]);

        parent::tearDown();
    }

    /**
     * @return array<string, array{consent: array<string, bool>|null, loaded: bool}>
     */
    public static function consentProvider(): array
    {
        return [
            'no consent given' => ['consent' => null, 'loaded' => false],
            'analytics rejected' => ['consent' => ['strictly_necessary' => true, 'analytics' => false], 'loaded' => false],
            'analytics accepted' => ['consent' => ['strictly_necessary' => true, 'analytics' => true], 'loaded' => true],
        ];
    }

    /**
     * @param  array<string, bool>|null  $consent
     */
    #[Test]
    #[DataProvider('consentProvider')]
    public function google_tag_follows_analytics_consent(?array $consent, bool $loaded): void
    {
        config()->set('app.google_analytics_id', 'G-ABC123');
        if ($consent !== null) {
            $_COOKIE[$this->consentCookie()] = json_encode($consent, JSON_THROW_ON_ERROR);
        }

        $response = $this->get('/')->assertOk();

        if ($loaded) {
            $response->assertSeeHtml('https://www.googletagmanager.com/gtag/js?id=G-ABC123');
        } else {
            $response->assertDontSee('googletagmanager.com');
        }
    }

    private function consentCookie(): string
    {
        return config()->string('cookies_consent.cookie_prefix') . 'cookies_consent';
    }
}

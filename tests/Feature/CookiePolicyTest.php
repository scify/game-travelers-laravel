<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Support\CookieNames;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * The cookie policy declares the cookies the game sets, by their real names.
 *
 * CookieNames guarantees the derivations agree; these tests guarantee that both
 * config files still call it, which no analyser reads.
 */
class CookiePolicyTest extends TestCase {
    use LazilyRefreshDatabase;

    #[Test]
    public function policy_declares_session_cookie_by_configured_name(): void {
        $this->assertContains(config()->string('session.cookie'), $this->declaredNames('strictly_necessary'));
    }

    #[Test]
    public function policy_declares_consent_cookie_with_configured_prefix(): void {
        $this->assertContains(
            config()->string('cookies_consent.cookie_prefix') . 'cookies_consent',
            $this->declaredNames('strictly_necessary'),
        );
    }

    #[Test]
    public function policy_declares_ga_session_cookie_for_configured_measurement_id(): void {
        $this->assertContains(
            CookieNames::gaSession(config()->string('app.google_analytics_id', '')),
            $this->declaredNames('analytics'),
        );
    }

    /**
     * @return list<mixed>
     */
    private function declaredNames(string $category): array {
        return array_column(config()->array('cookies_consent.cookies.' . $category), 'name');
    }
}

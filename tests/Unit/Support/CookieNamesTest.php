<?php

declare(strict_types=1);

namespace Tests\Unit\Support;

use App\Support\CookieNames;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CookieNamesTest extends TestCase
{
    /**
     * @return array<string, array{measurementId: string|null}>
     */
    public static function unrecognisedMeasurementIdProvider(): array
    {
        return [
            'missing' => ['measurementId' => null],
            'empty' => ['measurementId' => ''],
            'universal analytics property' => ['measurementId' => 'UA-12345-1'],
        ];
    }

    #[Test]
    public function laravel_session_derives_from_app_name(): void
    {
        $this->assertSame('travelers_game_session', CookieNames::laravelSession(null, 'Travelers Game'));
    }

    #[Test]
    public function laravel_session_keeps_configured_name(): void
    {
        $this->assertSame('custom_session', CookieNames::laravelSession('custom_session', 'Travelers Game'));
    }

    #[Test]
    public function ga_session_follows_measurement_id(): void
    {
        $this->assertSame('_ga_ABC123', CookieNames::gaSession('G-ABC123'));
    }

    #[Test]
    #[DataProvider('unrecognisedMeasurementIdProvider')]
    public function ga_session_keeps_placeholder_for_unrecognised_id(?string $measurementId): void
    {
        $this->assertSame('_ga_<container-id>', CookieNames::gaSession($measurementId));
    }
}

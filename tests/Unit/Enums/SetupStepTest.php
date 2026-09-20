<?php

declare(strict_types=1);

namespace Tests\Unit\Enums;

use App\Enums\SetupStep;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SetupStepTest extends TestCase
{
    /**
     * @return array<string, array{step: SetupStep}>
     */
    public static function stepProvider(): array
    {
        $cases = [];
        foreach (SetupStep::cases() as $step) {
            $cases[$step->value] = ['step' => $step];
        }

        return $cases;
    }

    #[Test]
    #[DataProvider('stepProvider')]
    public function route_name_names_registered_route(SetupStep $step): void
    {
        $routeName = $step->routeName();
        $value = $step->value;

        $this->assertTrue(Route::has($routeName), "Step $value names $routeName, which is not registered.");
    }

    #[Test]
    #[DataProvider('stepProvider')]
    public function for_route_inverts_route_name(SetupStep $step): void
    {
        $this->assertSame($step, SetupStep::forRoute($step->routeName()));
    }

    #[Test]
    public function for_route_returns_null_for_route_outside_flow(): void
    {
        $this->assertNull(SetupStep::forRoute('board'));
    }

    #[Test]
    public function for_route_returns_null_without_route_name(): void
    {
        $this->assertNull(SetupStep::forRoute(null));
    }
}

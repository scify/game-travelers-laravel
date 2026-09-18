<?php

declare(strict_types=1);

namespace Tests\Unit\Support;

use App\Support\DebugMode;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class DebugModeTest extends TestCase
{
    #[Test]
    public function enabled_holds_in_local_environment_with_debug_flag(): void
    {
        $this->app->instance('env', 'local');
        config()->set('app.debug', true);

        $this->assertTrue(DebugMode::enabled($this->app));
    }

    #[Test]
    public function enabled_requires_debug_flag(): void
    {
        $this->app->instance('env', 'local');
        config()->set('app.debug', false);

        $this->assertFalse(DebugMode::enabled($this->app));
    }

    #[Test]
    public function enabled_requires_local_environment(): void
    {
        $this->app->instance('env', 'production');
        config()->set('app.debug', true);

        $this->assertFalse(DebugMode::enabled($this->app));
    }
}

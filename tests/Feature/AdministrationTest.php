<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Notifications\UserRegistered;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Notification;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class AdministrationTest extends TestCase
{
    use LazilyRefreshDatabase;

    protected $seed = true;

    #[Test]
    public function administrator_may_manage_platform(): void
    {
        $this->assertTrue(Gate::forUser($this->seededAdmin())->allows('manage-platform'));
    }

    #[Test]
    public function registered_user_cannot_manage_platform(): void
    {
        $this->assertFalse(Gate::forUser($this->seededUser())->allows('manage-platform'));
    }

    #[Test]
    public function administrator_sends_test_email(): void
    {
        Notification::fake();

        $this->actingAs($this->seededAdmin())
            ->get('/administration/test-email/user-taxidiotes@scify.org')
            ->assertOk()
            ->assertSee('Email sent to: user-taxidiotes@scify.org');

        Notification::assertSentTo($this->seededUser(), UserRegistered::class);
    }

    #[Test]
    public function registered_user_cannot_send_test_email(): void
    {
        $this->actingAs($this->seededUser())
            ->get('/administration/test-email/user-taxidiotes@scify.org')
            ->assertForbidden();
    }
}

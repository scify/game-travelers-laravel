<?php

namespace Tests\Feature;

use App\Notifications\UserRegistered;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class AdministrationTest extends TestCase {
    use RefreshDatabase;

    protected $seed = true;

    public function test_only_the_administrator_may_manage_the_platform(): void {
        $this->assertTrue(Gate::forUser($this->seededAdmin())->allows('manage-platform'));
        $this->assertFalse(Gate::forUser($this->seededUser())->allows('manage-platform'));
    }

    public function test_a_registered_user_cannot_send_the_test_email(): void {
        $this->actingAs($this->seededUser())
            ->get('/administration/test-email/user-taxidiotes@scify.org')
            ->assertForbidden();
    }

    public function test_the_administrator_can_send_the_test_email(): void {
        Notification::fake();

        $this->actingAs($this->seededAdmin())
            ->get('/administration/test-email/user-taxidiotes@scify.org')
            ->assertOk()
            ->assertSee('Email sent to: user-taxidiotes@scify.org');

        Notification::assertSentTo($this->seededUser(), UserRegistered::class);
    }
}

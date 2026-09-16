<?php

namespace Tests\Feature;

use App\Models\User;
use App\Notifications\UserRegistered;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class AuthenticationTest extends TestCase {
    use RefreshDatabase;

    protected $seed = true;

    public function test_guests_are_redirected_to_login_from_game_pages(): void {
        $this->get(route('select.player', [0, 'user', 0]))->assertRedirect(route('login'));
        $this->get(route('board', [1, 1]))->assertRedirect(route('login'));
    }

    public function test_seeded_user_can_log_in_and_lands_on_player_selection(): void {
        $this->post('/login', [
            'email' => 'user-taxidiotes@scify.org',
            'password' => 'develop',
        ])->assertRedirect('/home');

        $this->assertAuthenticatedAs($this->seededUser());

        $this->get('/home')->assertRedirect(route('select.player', [0, 'user', 0]));
    }

    public function test_wrong_password_is_rejected(): void {
        $this->post('/login', [
            'email' => 'user-taxidiotes@scify.org',
            'password' => 'wrong',
        ])->assertSessionHasErrors('email');

        $this->assertGuest();
    }

    public function test_logout_returns_to_the_home_page(): void {
        $this->actingAs($this->seededUser())
            ->post('/logout')
            ->assertRedirect('/');

        $this->assertGuest();
    }

    public function test_registration_creates_a_registered_user_and_notifies_them(): void {
        Notification::fake();

        $this->post('/register', [
            'email' => 'new-player@example.org',
            'password' => 'Passw0rd12',
            'password_confirmation' => 'Passw0rd12',
            'captchaNumber1' => 3,
            'captchaNumber2' => 4,
            'captcha' => 7,
        ])->assertRedirect('/home');

        $user = User::where('email', 'new-player@example.org')->firstOrFail();
        $this->assertAuthenticatedAs($user);
        $this->assertFalse(Gate::forUser($user)->allows('manage-platform'));
        Notification::assertSentTo($user, UserRegistered::class);
    }

    public function test_registration_rejects_a_wrong_captcha_answer(): void {
        $this->post('/register', [
            'email' => 'new-player@example.org',
            'password' => 'Passw0rd12',
            'password_confirmation' => 'Passw0rd12',
            'captchaNumber1' => 3,
            'captchaNumber2' => 4,
            'captcha' => 8,
        ])->assertSessionHasErrors('captcha');

        $this->assertGuest();
        $this->assertDatabaseMissing('users', ['email' => 'new-player@example.org']);
    }
}

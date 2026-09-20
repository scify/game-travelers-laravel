<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use App\Notifications\UserRegistered;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use LazilyRefreshDatabase;

    private const string REGISTRATION_EMAIL = 'new-player@example.org';

    protected $seed = true;

    /**
     * @return array<string, array{route: string, parameters: list<int|string>}>
     */
    public static function gamePageProvider(): array
    {
        return [
            'player selection' => ['route' => 'select.player', 'parameters' => [0, 'user', 0]],
            'board' => ['route' => 'board', 'parameters' => [1, 1]],
        ];
    }

    /**
     * @param  list<int|string>  $parameters
     */
    #[Test]
    #[DataProvider('gamePageProvider')]
    public function guest_is_redirected_to_login_from_game_page(string $route, array $parameters): void
    {
        $this->get(route($route, $parameters))->assertRedirect(route('login'));
    }

    #[Test]
    public function login_sends_user_to_dashboard(): void
    {
        $this->post('/login', [
            'email' => 'user-taxidiotes@scify.org',
            'password' => 'develop',
        ])->assertRedirect(route('dashboard'));

        $this->assertAuthenticatedAs($this->seededUser());
    }

    #[Test]
    public function dashboard_sends_user_to_player_selection(): void
    {
        $this->actingAs($this->seededUser())
            ->get(route('dashboard'))
            ->assertRedirect(route('select.player', [0, 0]));
    }

    #[Test]
    public function login_rejects_wrong_password(): void
    {
        $this->post('/login', [
            'email' => 'user-taxidiotes@scify.org',
            'password' => 'wrong',
        ])->assertSessionHasErrors('email');

        $this->assertGuest();
    }

    #[Test]
    public function logout_returns_to_landing_page(): void
    {
        $this->actingAs($this->seededUser())
            ->post('/logout')
            ->assertRedirect('/');

        $this->assertGuest();
    }

    #[Test]
    public function registration_creates_registered_user_and_notifies_them(): void
    {
        Notification::fake();

        $this->post(route('register'), $this->registration())->assertRedirect(route('dashboard'));

        $user = User::query()->where('email', self::REGISTRATION_EMAIL)->firstOrFail();
        $this->assertAuthenticatedAs($user);
        $this->assertFalse(Gate::forUser($user)->allows('manage-platform'));
        Notification::assertSentTo($user, UserRegistered::class);
    }

    #[Test]
    public function registration_completes_when_welcome_mail_cannot_be_sent(): void
    {
        // An empty sender address makes the mailer refuse the message; the registration must survive it.
        config()->set('mail.from.address', '');
        $log = Log::spy();

        $this->post(route('register'), $this->registration())->assertRedirect(route('dashboard'));

        $user = User::query()->where('email', self::REGISTRATION_EMAIL)->firstOrFail();
        $this->assertAuthenticatedAs($user);
        $log->shouldHaveReceived('error')->once();
    }

    #[Test]
    public function registration_rejects_wrong_captcha_answer(): void
    {
        $this->post(route('register'), $this->registration(captcha: 8))->assertSessionHasErrors('captcha');

        $this->assertGuest();
        $this->assertDatabaseMissing('users', ['email' => self::REGISTRATION_EMAIL]);
    }

    #[Test]
    public function logged_in_user_opening_login_is_sent_to_dashboard(): void
    {
        $this->actingAs($this->seededUser())
            ->get(route('login'))
            ->assertRedirect(route('dashboard'));
    }

    /**
     * A valid registration form; the captcha asks for 3 + 4.
     *
     * @return array<string, int|string>
     */
    private function registration(int $captcha = 7): array
    {
        return [
            'email' => self::REGISTRATION_EMAIL,
            'password' => 'Passw0rd12',
            'password_confirmation' => 'Passw0rd12',
            'captchaNumber1' => 3,
            'captchaNumber2' => 4,
            'captcha' => $captcha,
        ];
    }
}

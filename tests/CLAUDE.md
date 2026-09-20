# Testing Conventions

PHPUnit 13 with Laravel's testing utilities, SQLite in memory, no front-end build. These conventions are canonical for new tests and for refactoring existing ones. The project guideline "Every installation is someone else's" (`.ai/guidelines/10-project.blade.php`) applies to tests too: no installation's names, hosts or ids in fixtures beyond what the seeders provide.

## Essentials

- Every change is tested: write or update a test, then run the affected tests.
- `tests/Feature/` holds workflows as the player meets them: routes, auth, the board's backend calls. Most tests are feature tests. `tests/Unit/` holds one class answering for its own behaviour, mirrored by namespace (`tests/Unit/Support/` for `app/Support/`).
- Create tests with `php artisan make:test {Name}` (feature) or `--unit`, then reshape to the class structure below.
- `#[Test]` on every method, `snake_case` names, no `test_` prefix.
- Seeded data comes from `Tests\TestCase` helpers (`seededAdmin()`, `seededUser()`, `seededPlayer()`, `startedGame()`); do not recreate what the seeders provide. The one factory, `UserFactory`, is unused; propose a factory before writing the same setup by hand a third time.
- Run the minimum: `vendor/bin/phpunit --filter method_name` or a file path. The full suite before declaring work complete.
- Eloquent calls start from `Model::query()` (`Player::query()->where(...)`, `Game::query()->create(...)`). Rector rewrites the magic static forms, so `composer test:lint` fails on `Player::where(...)`.

## Class Structure

```php
<?php

declare(strict_types=1);

namespace Tests\Feature;

// Imports alphabetical within groups: App\, Illuminate\, PHPUnit\, Tests\

class SomethingTest extends TestCase
{
    use LazilyRefreshDatabase;

    protected $seed = true;

    #[Test]
    public function descriptive_snake_case_name(): void
    {
        // Arrange, act, assert
    }
}
```

Braces of classes and methods open on the next line, braces of control structures on the same line (`pint.json`, Laravel preset). `LazilyRefreshDatabase` defers migration and seeding to the first query, so a test that touches no table costs nothing. Base class `Tests\TestCase`, also for unit tests.

## Naming

Test names describe the behaviour, not the setup. The runner shows only the method name; if understanding the test needs the setup, the name is wrong.

- `snake_case`, no `test_`, `it_` or `should_` prefix; `#[Test]` already marks the method.
- No articles: `a`, `an`, `the` never appear anywhere in a name. `board_page_renders_for_game_owner`, not `the_board_page_renders_for_the_games_owner`.
- No possessives, no abbreviations. A dropped apostrophe reads as a plural (`another_users_game`: whose?). Rephrase: `game_owned_by_another_user`.
- The subject is what the test exercises: a surface or scenario for feature tests (`login_`, `registration_`, `selecting_board_`), the method for unit tests (`laravel_session_derives_from_app_name`).
- When behaviour varies by actor, the actor leads, powers first, refusals after: `administrator_sends_test_email`, `registered_user_cannot_send_test_email`.
- Never lead with a bare status: `registration_rejects_wrong_captcha_answer`, never `fails_when_...`.
- Every name must survive a zero-context read: read it as a stranger before landing it.
- The seed to copy is `tests/Feature/CookiePolicyTest.php`; when unsure, copy its shape.

## Attributes

- `#[Test]` on every test method.
- `#[DataProvider('providerMethod')]` for parameterised tests; static providers returning keyed arrays with descriptive case names.
- `#[Group('name')]` when filtering a set is useful.

## Configuration Hermeticity

Tests never assume or pin configuration. Set what the test needs with `config()->set()` and read it back through the typed accessors (`config()->string()`, `config()->array()`). Never read `env()`; `putenv()` is for a subject that itself reads the process environment. A value derived when config loads (the cookie names, anything built from `env()` inside a config file) cannot be re-derived by `config()->set()`: assert the relation between loaded values, or set a fictional input where the code reads config at runtime and observe the output, never the literal the local `.env` produces. Fixtures are fictional; seeded reference data is the exception, because the seeder is the contract.

## Network Hermeticity

The suite never touches the network. `Tests\TestCase` calls `Http::preventStrayRequests()`, so an unfaked request through the Http facade fails the test. Mail runs on the array driver (`phpunit.xml`).

## Assertions

- Name the values that cross from the action into the assertion. A local variable used in both places says the two are the same value on purpose; two matching literals only look alike, and the reader has to compare them character by character. It also makes a deliberate difference visible, as in `' ' . $name . ' '` posted against `$name` read back, and shows which request field becomes which column, as in `'board_size' => $gameDuration`. `tests/Feature/PlayerProfileTest.php` is the worked example.
- Strict: `assertSame()` over `assertEquals()` when the type matters.
- Database: `assertDatabaseHas()`, `assertDatabaseMissing()`, `assertDatabaseCount()`.
- HTTP: `assertOk()`, `assertRedirect()`, `assertForbidden()`, `assertStatus()`. One request per test method; a flow becomes several tests, each starting from its own state through `startedGame()`; a loop becomes a data provider.
- Session: `assertSessionHasErrors(['field'])`. Auth: `assertAuthenticatedAs()`, `assertGuest()`.

## Doubles

- `Notification::fake()`, `Log::spy()` and the other facade fakes for Laravel seams.
- `createStub()` when only canned return values are needed; `createMock()` when the interaction is the assertion. PHPUnit 13 flags a mock that never receives `->expects()`.
- Never mock the database in feature tests.

## Organising Tests

- No section comments; different concerns are different classes, same concern with several scenarios is one class.
- Choose the subject under test before asserting. When it is configuration or seeded data, author the expected values by hand from the specification; never read them back from the fixture, or drift can never be caught. `DatabaseSeederTest` is the worked example.

## Running Tests

```bash
vendor/bin/phpunit                                   # full suite
vendor/bin/phpunit --filter method_name              # one method
vendor/bin/phpunit tests/Feature/BoardTest.php       # one file
vendor/bin/phpunit --testdox                         # names as sentences
```

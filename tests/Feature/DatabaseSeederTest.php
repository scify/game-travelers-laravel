<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Player;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class DatabaseSeederTest extends TestCase {
    use LazilyRefreshDatabase;

    protected $seed = true;

    #[Test]
    public function seeder_creates_two_roles(): void {
        $this->assertDatabaseHas('user_roles_lkp', ['id' => 1, 'name' => 'Platform Administrator']);
        $this->assertDatabaseHas('user_roles_lkp', ['id' => 2, 'name' => 'Registered User']);
    }

    #[Test]
    public function seeder_creates_administrator_and_user_with_roles(): void {
        $this->assertDatabaseHas('users', ['id' => 1, 'email' => 'admin-taxidiotes@scify.org']);
        $this->assertDatabaseHas('users', ['id' => 2, 'email' => 'user-taxidiotes@scify.org']);
        $this->assertDatabaseHas('user_roles', ['user_id' => 1, 'role_id' => 1]);
        $this->assertDatabaseHas('user_roles', ['user_id' => 2, 'role_id' => 2]);
    }

    #[Test]
    public function seeder_gives_user_two_players_with_default_controls(): void {
        $players = Player::where('user_id', 2)->orderBy('id')->get();

        $this->assertCount(2, $players);
        $this->assertSame(['Κώστας Παπ.', 'Νίκη Καραγ.'], $players->pluck('name')->all());
        foreach ($players as $player) {
            $this->assertSame(1, $player->auto);
            $this->assertSame('Enter', $player->select_key);
            $this->assertSame('Space', $player->navigate_key);
            $this->assertSame(2, $player->scanning_speed);
            $this->assertSame(2, $player->movement_mode);
        }
    }
}

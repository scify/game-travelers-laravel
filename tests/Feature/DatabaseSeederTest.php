<?php

namespace Tests\Feature;

use App\Models\Player;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DatabaseSeederTest extends TestCase {
    use RefreshDatabase;

    protected $seed = true;

    public function test_the_two_roles_exist(): void {
        $this->assertDatabaseHas('user_roles_lkp', ['id' => 1, 'name' => 'Platform Administrator']);
        $this->assertDatabaseHas('user_roles_lkp', ['id' => 2, 'name' => 'Registered User']);
    }

    public function test_the_administrator_and_the_user_exist_with_their_roles(): void {
        $this->assertDatabaseHas('users', ['id' => 1, 'email' => 'admin-taxidiotes@scify.org']);
        $this->assertDatabaseHas('users', ['id' => 2, 'email' => 'user-taxidiotes@scify.org']);
        $this->assertDatabaseHas('user_roles', ['user_id' => 1, 'role_id' => 1]);
        $this->assertDatabaseHas('user_roles', ['user_id' => 2, 'role_id' => 2]);
    }

    public function test_the_user_owns_two_players_with_the_default_controls(): void {
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

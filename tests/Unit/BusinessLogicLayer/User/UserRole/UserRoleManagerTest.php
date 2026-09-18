<?php

declare(strict_types=1);

namespace Tests\Unit\BusinessLogicLayer\User\UserRole;

use App\BusinessLogicLayer\User\UserRole\UserRoleManager;
use App\Repository\User\UserRole\UserRolesLkp;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Support\Facades\Cache;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * Role checks answer from the database once and from the cache afterwards.
 *
 * Assignment writes the cache, revocation forgets it, and a check fills a miss
 * with the answer it computed, whichever way that answer went.
 */
class UserRoleManagerTest extends TestCase
{
    use LazilyRefreshDatabase;

    protected $seed = true;

    #[Test]
    public function seeded_administrator_has_admin_role(): void
    {
        $this->assertTrue($this->manager()->userHasAdminRole($this->seededAdmin()));
    }

    #[Test]
    public function seeded_user_does_not_have_admin_role(): void
    {
        $this->assertFalse($this->manager()->userHasAdminRole($this->seededUser()));
    }

    #[Test]
    public function role_assigned_through_manager_is_reported_on_next_check(): void
    {
        $user = $this->seededUser();
        $manager = $this->manager();
        $this->assertFalse($manager->userHasAdminRole($user));

        $manager->assignAdminUserRoleTo($user);

        $this->assertTrue($manager->userHasAdminRole($user));
    }

    #[Test]
    public function role_removed_through_manager_is_not_reported_on_next_check(): void
    {
        $user = $this->seededUser();
        $manager = $this->manager();
        $manager->assignAdminUserRoleTo($user);
        $this->assertTrue($manager->userHasAdminRole($user));

        $manager->removeAdminRoleFromUser($user);

        $this->assertFalse($manager->userHasAdminRole($user));
    }

    /**
     * The key format is the manager's private contract between its check, its
     * assignment and its revocation; the test spells it out on purpose, so a
     * change to the format is a change to this test as well.
     */
    #[Test]
    public function negative_answer_is_cached_as_false(): void
    {
        $user = $this->seededUser();

        $this->assertFalse($this->manager()->userHasAdminRole($user));

        $this->assertFalse(Cache::get('user-role:' . $user->id . ':' . UserRolesLkp::ADMIN));
    }

    private function manager(): UserRoleManager
    {
        return $this->app->make(UserRoleManager::class);
    }
}

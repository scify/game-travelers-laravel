<?php

namespace App\BusinessLogicLayer\User\UserRole;

use App\Models\User;
use App\Models\UserRole\UserRole;
use App\Repository\User\UserRole\UserRoleLkpRepository;
use App\Repository\User\UserRole\UserRoleRepository;
use App\Repository\User\UserRole\UserRolesLkp;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;

class UserRoleManager {
    private UserRoleRepository $userRoleRepository;
    private UserRoleLkpRepository $userRoleLkpRepository;

    public function __construct(UserRoleRepository $userRoleRepository, UserRoleLkpRepository $userRoleLkpRepository) {
        $this->userRoleRepository = $userRoleRepository;
        $this->userRoleLkpRepository = $userRoleLkpRepository;
    }

    public function registerUserPolicies(): void {
        Gate::define('manage-platform', function ($user) {
            return $this->userHasAdminRole($user);
        });
    }

    public function getAllUserRoles() {
        return $this->userRoleLkpRepository->all()->where('id', '<>', UserRolesLkp::ADMIN);
    }

    public function assignRegisteredUserRoleTo(User $user) {
        return $this->assignRoleTo($user, UserRolesLkp::USER);
    }

    public function assignAdminUserRoleTo(User $user) {
        return $this->assignRoleTo($user, UserRolesLkp::ADMIN);
    }

    protected function assignRoleTo(User $user, int $roleId) {
        $arr = ['user_id' => $user->id, 'role_id' => $roleId];
        if ($this->userHasRole($user, $roleId)) {
            return $this->userRoleRepository->where($arr)->first();
        }
        $this->storeUserRoleInCache($user->id, $roleId);
        // check if exists but is soft deleted
        $existingRole = $this->userRoleRepository->getUserRoleWithTrashed($arr);
        if ($existingRole) {
            $existingRole->restore();

            return $existingRole;
        }

        return $this->userRoleRepository->updateOrCreate($arr, $arr);
    }

    /**
     * Checks if a given @param User $user the @see User instance
     *
     * @return bool
     *
     * @see User has the admin role
     */
    public function userHasAdminRole(User $user): bool {
        return $this->userHasRole($user, UserRolesLkp::ADMIN);
    }

    public function removeAdminRoleFromUser(User $user): void {
        $this->removeRoleFromUser($user, UserRolesLkp::ADMIN);
    }

    public function removeRoleFromUser(User $user, $roleId): void {
        if ($this->userHasRole($user, $roleId)) {
            $userRole = $this->userRoleRepository->where(['user_id' => $user->id, 'role_id' => $roleId]);
            $this->userRoleRepository->delete($userRole->id);
            $this->removeRoleFromCache($user, $roleId);
        }
    }

    /**
     * Checks if a given @param User $user the @see User instance
     *
     * @param int $roleId
     * @return bool
     *
     * @see User has the admin role
     */
    public function userHasRole(User $user, int $roleId): bool {
        if ($user == null) {
            return false;
        }

        return $this->checkCacheOrDBForRoleAndStore($user, $roleId);
    }

    /**
     * Checks if a role (identified by role id) exists in a given collection of @param Collection $userRoles the user roles collection
     *
     * @param int $roleId
     * @return bool
     *
     * @see UserRole
     */
    private function rolesInclude(Collection $userRoles, int $roleId): bool {
        return $userRoles->contains($roleId);
    }

    private function checkCacheOrDBForRoleAndStore(User $user, $roleId) {
        $cacheKey = $this->getRoleCacheKey($user->id, $roleId);
        $result = Cache::get($cacheKey . $user->id);
        if ($result == null) {
            $userRoles = $user->roles;
            $result = $this->rolesInclude($userRoles, $roleId);
            $this->storeUserRoleInCache($user->id, $roleId);
        }

        return $result;
    }

    private function storeUserRoleInCache(int $userId, int $roleId): bool {
        $cacheKey = $this->getRoleCacheKey($userId, $roleId);

        return Cache::forever($cacheKey, true);
    }

    private function removeRoleFromCache(User $user, int $roleId): void {
        Cache::forget($this->getRoleCacheKey($user->id, $roleId));
    }

    private function getRoleCacheKey(int $userId, int $roleId): string {
        return 'user_' . $userId . '_role_' . $roleId;
    }

    public function getUserRoleMapping() {
        return $this->userRoleRepository->all();
    }
}

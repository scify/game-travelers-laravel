<?php

namespace App\BusinessLogicLayer\User;

use App\BusinessLogicLayer\User\UserRole\UserRoleManager;
use App\Models\User;
use App\Repository\User\UserRepository;
use App\Repository\User\UserRole\UserRolesLkp;
use Illuminate\Support\Facades\Hash;

class UserManager {
    protected UserRepository $userRepository;
    protected UserRoleManager $userRoleManager;

    public function __construct(UserRoleManager $userRoleManager, UserRepository $userRepository) {
        $this->userRoleManager = $userRoleManager;
        $this->userRepository = $userRepository;
    }

    /**
     * Creates a @User record and assigns the RegisteredUser role
     * by default. If the data array includes a field for Administrator role,
     * the role is added as well.
     *
     * @param  array  $requestData array with the form data
     * @return User the newly created user
     */
    public function create(array $requestData): User {
        $email = $requestData['email'];
        $user = $this->userRepository->create([
            'email' => $email,
            'password' => $requestData['password']
        ]);
        $this->userRoleManager->assignRegisteredUserRoleTo($user);
        if (isset($requestData['admin']) && $requestData['admin']) {
            $this->userRoleManager->assignAdminUserRoleTo($user);
        }
        return $user;
    }

    public function isAdmin($user): bool {
        return $this->userRoleManager->userHasAdminRole($user);
    }

    /**
     * Updates a User in the DB.
     * Also checks the existence of the administrator field
     * in the request data, and adds or removes the administrator role.
     *
     * @param  int  $id the id of the user to be updated
     * @param  array  $requestData array with the form data
     * @return User the newly created user
     */
    public function update(int $id, array $requestData): User {
        $user = $this->userRepository->update([
            'email' => trim($requestData['email']),
        ], $id);
        if ($requestData['password']) {
            $user = $this->userRepository->update([
                'password' =>  Hash::make($requestData['password']),
            ], $id);
        }


        if ($requestData['type_id'] !== $requestData['prev_type_id']) {
            $this->userRoleManager->assignRegisteredUserRoleTo($user);
            $this->userRoleManager->removeRoleFromUser($user, $requestData['prev_type_id']);
        }

        if (isset($requestData['admin']) && $requestData['admin']) {
            $this->userRoleManager->assignAdminUserRoleTo($user);
        } else {
            $this->userRoleManager->removeAdminRoleFromUser($user);
        }

        return $user;
    }

    public function delete($id) {
        return $this->userRepository->delete($id);
    }

    public function get_admin_users() {
        $users = $this->userRepository->getUsersWithAdminRoleStatus(-1);

        return $users->filter(
            function ($obj) {
                return $obj->is_admin === 1;
            })->map(
                function ($obj) {
                    return $this->userRepository->find($obj->id);
                });
    }

    public function getUserRoles() {
        return $this->userRoleManager->getAllUserRoles();
    }

    public function getUserRolesMapping() {
        return $this->userRoleManager->getUserRoleMapping();
    }

    public function getUsers() {
        return $this->userRepository->all();
    }

    public function getUser($id) {
        return $this->userRepository->find($id);
    }
}

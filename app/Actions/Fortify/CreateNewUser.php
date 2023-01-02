<?php

namespace App\Actions\Fortify;

use App\BusinessLogicLayer\User\UserManager;
use App\Models\User;
use App\Notifications\UserRegistered;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers {
    use PasswordValidationRules;


    protected UserManager $userManager;

    public function __construct(UserManager $userManager) {
        $this->userManager = $userManager;
    }

    /**
     * Validate and create a newly registered user.
     *
     * @param array $input
     * @return User
     * @throws ValidationException
     */
    public function create(array $input) {
        Validator::make($input, [
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
        ])->validate();

        $user = $this->userManager->create([
            'email' => trim($input['email']),
            'password' => trim($input['password'])
        ]);
        $user->notify(new UserRegistered($user));
        return $user;
    }
}

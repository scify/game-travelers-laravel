<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\BusinessLogicLayer\User\UserManager;
use App\Http\Controllers\Controller;
use App\Notifications\UserRegistered;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;
use Throwable;

class RegisteredUserController extends Controller
{
    public function __construct(protected UserManager $userManager) {}

    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $captchaNumbers = [random_int(1, 49), random_int(1, 49)];

        return view('auth.register', ['captchaNumbers' => $captchaNumbers]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @return RedirectResponse
     */
    public function store(Request $request): Redirector|RedirectResponse
    {
        $captchaInput1 = (int) $request->input('captchaNumber1');
        $captchaInput2 = (int) $request->input('captchaNumber2');
        $sum = $captchaInput1 + $captchaInput2;
        $captchaRule = 'size:' . $sum;

        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()],
            'captcha' => ['required', 'numeric', $captchaRule],
        ]);

        // The framework's TrimStrings middleware trims the email and leaves the password alone, on purpose.
        $user = $this->userManager->create($request->only('email', 'password'));

        // The welcome mail must not take the registration down with it: the user
        // row exists, so report the failure and let them in.
        try {
            $user->notify(new UserRegistered($user));
        } catch (Throwable $throwable) {
            report($throwable);
        }

        event(new Registered($user));

        Auth::login($user);

        return to_route('dashboard');
    }
}

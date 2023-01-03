<?php

namespace App\Http\Controllers\Auth;

use App\BusinessLogicLayer\User\UserManager;
use App\Http\Controllers\Controller;
use App\Notifications\UserRegistered;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller {

    protected UserManager $userManager;

    /**
     * @param UserManager $userManager
     */
    public function __construct(UserManager $userManager) {
        $this->userManager = $userManager;
    }

    /**
     * Display the registration view.
     *
     * @return View
     */
    public function create(): View {
        $captchaNumbers = [rand(1, 49), rand(1, 49)];

        return view('auth.register', ['captchaNumbers' => $captchaNumbers]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @param Request $request
     * @return RedirectResponse
     *
     */
    public function store(Request $request) {
        $captchaInput1 = (int) $request->get('captchaNumber1');
        $captchaInput2 = (int) $request->get('captchaNumber2');
        $sum = $captchaInput1 + $captchaInput2;
        $captchaRule = 'size:' . $sum;

        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::min(8)->letters()->numbers()],
            'captcha' => ['required', 'numeric', $captchaRule],
        ]);


        $user = $this->userManager->create([
            'email' => trim($request->email),
            'password' => trim($request->password)
        ]);

        $user->notify(new UserRegistered($user));

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}

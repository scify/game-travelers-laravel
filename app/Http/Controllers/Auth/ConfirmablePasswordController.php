<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConfirmablePasswordController extends Controller
{
    /**
     * Show the confirm password view.
     */
    public function show(): never
    {
        abort(501);

        // return view('auth.confirm-password');
    }

    /**
     * Confirm the user's password.
     */
    public function store(Request $request): never
    {
        abort(501);

        // if (! Auth::guard('web')->validate([
        //     'email' => $request->user()->email,
        //     'password' => $request->password,
        // ])) {
        //     throw ValidationException::withMessages([
        //         'password' => __('auth.password'),
        //     ]);
        // }
        //
        // $request->session()->put('auth.password_confirmed_at', time());
        //
        // return redirect()->intended(route('dashboard', absolute: false));
    }
}

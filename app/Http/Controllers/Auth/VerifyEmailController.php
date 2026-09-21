<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): never
    {
        abort(501);

        // if ($request->user()->hasVerifiedEmail()) {
        //     return redirect()->intended(route('dashboard', ['verified' => 1], absolute: false));
        // }
        //
        // if ($request->user()->markEmailAsVerified()) {
        //     event(new Verified($request->user()));
        // }
        //
        // return redirect()->intended(route('dashboard', ['verified' => 1], absolute: false));
    }
}

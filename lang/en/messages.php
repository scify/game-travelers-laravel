<?php

return [

    /*
    |--------------------------------------------------------------------------
    | App elements
    |--------------------------------------------------------------------------

    */
    'app_name' => 'Travellers',
    'privacy_policy' => 'Privacy Policy',
    /* Generic */
    'close' => 'Close', // i.e. "Close" window
    'congratulations' => 'Congratulations',
    'continue' => 'Continue', // i.e. "Continue" to the next step
    'email' => 'Email',
    'login' => 'Login',
    'password' => 'Password',
    'register' => 'Register',
    /* Forms Generic */
    'error_form' => 'Please, fill the fields of this form based on the instructions bellow:',
    /* splash.blade.php */
    'coming_soon' => 'Coming soon',
    'coming_soon_description' => 'Travellers: Coming soon from SciFY',
    /* views/auth/*.blade.php */
    'captcha' => 'CAPTCHA',
    'captcha_description' => 'Please add the numbers and enter the answer.',
    'captcha_placeholder' => 'sum',
    'login_prompt' => 'Existing user?',
    'login_title' => 'Welcome!', // Welcome!
    'password_change' => 'Change your password',
    'password_new' => 'New password', // New Password
    'password_new_label' => 'Enter your new password', // New Password
    'password_new_validation' => 'Confirm your new password',
    'password_new_validation_label' => 'Re-enter your new password for validation',
    'password_new_description' => 'Please enter a new password which you will be able to use from now on for logging in.',
    'password_label' => 'Enter password',
    'password_reset' => 'Reset Password ',
    'password_reset_description' => 'If you can not recall your password, please provide your email address and we will send you instructions on how to proceed with resetting it.',
    'password_reset_error' => 'Unfortunately, we can\'t find your email. Please make sure you\'ve entered it correctly and try again.',
    'password_reset_prompt' => 'Did you forget your password?',
    'password_reset_success' => 'Your new password has been saved succesfully.',
    'password_reset_request_success' => 'Your request for resetting your password was succesfull. Please check your email to proceed.',
    'password_rules' => 'Use 8 characters or more with at least one letter and one digit.',
    'password_validation' => 'Confirm your password',
    'password_validation_label' => 'Confirm your password',
    'registration' => 'Create account', // Create new account
    'registration_title' => 'New User Registration', // New User Registration
    'registration_prompt' => 'New user?', // New user?
    'stay_online' => 'Keep me logged-in',

    /* New game */
    'new_game' => 'New Game',
    'select_pawn' => 'Choose your pawn', // Choose Player 1 Pawn
    'select_pawn_coplayer' => 'Choose your co-player\'s pawn', // Choose Player 2 Pawn

    // Most of the following strings have already been moved to validation as
    // custom rules and have been commented out from this file.
    // @todo Fix password_token_error to somehow inject this:
    // <li>{{ __("messages.password_token_error") }}
    //    <a href="{{ route('password.request') }}">
    //      {{ __("messages.password_token_error_link") }}.
    //    </a>
    // </li>
    // Until then we are using the same error via passwords.token without the
    // helpful link.
    //
    // 'error_email_exists' => 'The email is already in use by another user of the platform.',
    // 'error_password_chars' => 'Password should have 8 or more characters.',
    // 'error_password_letter' => 'Password should have at least 1 letter.',
    // 'error_password_symbol' => 'Password should have at least 1 symbol.',
    // 'error_password_digit' => 'Password should have at least 1 digit.',
    // 'error_password_match' => 'Passwords do not match.',
    'password_token_error' => 'Unfortunately, your password reset request has expired.',
    'password_token_error_link' => 'Start over the process of reseting your password.',
    // 'error_password_captcha' => 'Incorrect CAPTCHA value.',

];

<x-layout :title="__('messages.registration') . ' | ' . __('messages.app_name')">
    {{-- Note: A generic error alert (#form-alert) is thrown just below the
        form's header. Additionally, each field with an error is highlighted.
    --}}
    @section('scripts')
        {{-- Optional: Custom JS scripts for authentication --}}
    @endsection

    <!-- register content -->
    <div class="section background background-group-1 container-xxl px-4">
        <div class="row">
            <div class="col-lg-3 order-lg-2">
                <div class="ps-4 ps-md-6 ps-lg-0 pt-4">
                    {{ __("messages.login_prompt") }}<br/>
                    <a href="{{ route('login') }}" tabindex="6">{{ __("messages.login") }}</a>
                </div>
            </div>
            <div class="col-lg-9 order-lg-1">
                <!-- form -->
                <form method="post" action="">
                    @csrf
                    <div class="form px-0 px-md-6">
                        <div class="form-header p-4">
                            <h1>{{ __("messages.registration_title") }}</h1>
                        </div>

                        {{-- @see https://laravel.com/docs/9.x/validation#quick-displaying-the-validation-errors --}}
                        @if($errors->any())
                            <!-- errors -->
                            <div class="form-alert alert alert-danger mx-4" id="form-alert">
                                {{ __("messages.error_form") }}
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- errors -->
                        @endif

                        <!-- email -->
                        <div class="field p-4 @error('email') is-invalid @enderror">
                            <label class="field-label extended" for="email">{{ __("messages.email") }}</label>
                            <input
                                class="field-input underlined extended"
                                type="email"
                                name="email"
                                required="required"
                                aria-required="true"
                                autocomplete="email"
                                autocapitalize="off"
                                spellcheck="false"
                                tabindex="1"
                                id="email"
                            />
                            <div class="field-description"></div>
                        </div>
                        <!-- / email -->
                        <!-- passwords -->
                        <div class="
                            field-group px-4 py-2 container-fluid
                            @error('password') is-invalid @enderror
                            @error('password_confirmation') is-invalid @enderror
                        ">
                            <div class="row">
                                <div class="field col-lg-6">
                                    <label class="field-label extended" for="password">{{ __("messages.password") }}</label>
                                    <input
                                        class="field-input underlined extended"
                                        type="password"
                                        name="password"
                                        required="required"
                                        minlength="8"
                                        maxlength="255"
                                        passwordrules="minlength: 8; required: lower; required: upper; required: digit;"
                                        autocomplete="new-password"
                                        autocorrect="off"
                                        autocapitalize="off"
                                        spellcheck="false"
                                        aria-required="true"
                                        aria-label="{{ __('messages.password_label') }}"
                                        aria-describedby="password-description"
                                        tabindex="2"
                                        id="password"
                                    />
                                </div>
                                <div class="field col-lg-6 pt-4 pt-lg-0 ">
                                    <label class="field-label extended text-nowrap text-truncate"
                                           for="password_confirmation">{{ __("messages.password_validation") }}</label>
                                    <input
                                        class="field-input underlined extended"
                                        type="password"
                                        name="password_confirmation"
                                        required="required"
                                        minlength="8"
                                        maxlength="255"
                                        passwordrules="minlength: 8; required: lower; required: upper; required: digit;"
                                        autocomplete="new-password"
                                        autocorrect="off"
                                        autocapitalize="off"
                                        spellcheck="false"
                                        aria-required="true"
                                        aria-label="{{ __('messages.password_validation_label') }}"
                                        aria-describedby="password-description"
                                        tabindex="3"
                                        id="password_confirmation"
                                    />
                                </div>
                            </div>
                            <div class="row">
                                <div class="field-description" id="password-description">
                                    {{ __("messages.password_rules") }}
                                </div>
                            </div>
                        </div>
                        <!-- passwords -->
                        <!-- captcha -->
                        <div class="
                            field captcha p-4
                            @error('captcha') is-invalid @enderror
                        ">
                            <label class="field-label extended" for="captcha">{{ __("messages.captcha") }}</label>
                            <div class="captcha-prompt" id="captcha-prompt">
                                {{ $captchaNumbers[0] }} +
                                {{ $captchaNumbers[1] }} =
                            </div>
                            <input type="hidden" name="captchaNumber1" value="{{ $captchaNumbers[0] }}">
                            <input type="hidden" name="captchaNumber2" value="{{ $captchaNumbers[1] }}">
                            <input
                                class="field-input field-captcha underlined"
                                type="text"
                                name="captcha"
                                inputmode="numeric"
                                pattern="[0-9]*"
                                maxlength="2"
                                placeholder="{{ __('messages.captcha_placeholder') }}"
                                required="required"
                                aria-required="true"
                                aria-placeholder="{{ __('messages.captcha_placeholder') }}"
                                aria-labelledby="captcha-prompt"
                                aria-describedby="captcha-description"
                                autocomplete="off"
                                spellcheck="false"
                                tabindex="4"
                                id="captcha"
                            />
                            <div class="field-description" id="captcha-description">
                                {{ __("messages.captcha_description") }}
                            </div>
                        </div>
                        <!-- / captcha -->
                        <div class="form-actions p-2 text-center">
                            <button class="btn btn-lg btn-primary text-nowrap responsive-expand" tabindex="5"
                                    type="submit" id="submit">{{ __("messages.register") }}
                            </button>
                        </div>
                    </div>
                </form>
                <!-- / form -->
            </div>
        </div>
    </div>
    <!-- end of register content -->

</x-layout>

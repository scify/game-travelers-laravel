<x-layout :title="__('messages.password_change'). ' | ' . __('messages.app_name')">
    {{-- Note: A generic error alert (#form-alert) is thrown just below the
        form's header in case of any error and the password fields are also
        highlighted just in case... --}}
    @section('scripts')
    {{-- Optional: Custom JS scripts for authentication --}}
    @endsection

    <!-- password reset / change password-content -->
    <div class="section background background-group-1 container-xxl px-4 responsive-hide">
        <div class="row">
            <div class="col-lg-3 order-md-2">
                <!-- no content yet -->
            </div>
            <div class="col-lg-9 order-md-1">
                <!-- form -->
                <form method="post" action="{{ route('password.update') }}">
                    @csrf

                    <div class="form px-0 px-md-6">
                        <div class="form-header p-4 mb-4">
                            <h1>{{ __("messages.password_change") }}</h1>
                            <p class="my-4">
                                {{ __("messages.password_new_description") }}
                            </p>
                            {{-- @see https://laravel.com/docs/9.x/validation#quick-displaying-the-validation-errors --}}
                            @if($errors->any())
                            <!-- errors -->
                            <div class="form-alert alert alert-danger" id="form-alert">
                                {{ __("messages.error_form") }}
                                <ul>
                                    {{-- Note: @see messages.password_token_error --}}
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- errors -->
                            @endif

                        </div>

                        <!-- passwords -->
                        <div class="
                            field-group px-4 py-2 container-fluid
                            @error('password') is-invalid @enderror
                            @error('password_confirmation') is-invalid @enderror
                        ">
                            <div class="row">
                                <div class="field col-lg-6">
                                    <label class="field-label extended" for="password">{{ __("messages.password_new") }}</label>
                                    <input
                                        class="field-input underlined extended"
                                        type="password"
                                        name="password"
                                        required="required"
                                        minlength="8"
                                        maxlength="255"
                                        passwordrules="minlength: 8; required: lower; required: upper; required: digit;"
                                        autocorrect="off"
                                        autocomplete="new-password"
                                        autocapitalize="off"
                                        spellcheck="false"
                                        aria-required="true"
                                        aria-label="{{ __('messages.password_new_label') }}"
                                        aria-describedby="password-description"
                                        tabindex="1"
                                        id="password"
                                    />
                                </div>

                                <input type="hidden" name="token" value="{{ request()->route('token') }}">
                                <input type="hidden" name="email" value="{{ request()->all()['email'] }}">

                                <div class="field col-lg-6 pt-4 pt-lg-0 ">
                                    <label class="field-label extended text-nowrap text-truncate" for="password_confirmation">{{ __("messages.password_new_validation") }}</label>
                                    <input
                                        class="field-input underlined extended"
                                        type="password"
                                        name="password_confirmation"
                                        required="required"
                                        minlength="8"
                                        maxlength="255"
                                        passwordrules="minlength: 8; required: lower; required: upper; required: digit;"
                                        autocorrect="off"
                                        autocomplete="new-password"
                                        autocapitalize="off"
                                        spellcheck="false"
                                        aria-required="true"
                                        aria-label="{{ __('messages.password_new_validation_label') }}"
                                        aria-describedby="password-description"
                                        tabindex="2"
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

                        <div class="form-actions p-4 text-center">
                            <button
                                class="btn btn-lg btn-primary text-nowrap responsive-expand"
                                tabindex="3"
                                type="submit"
                            >{{ __("messages.password_change") }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- / password reset / change password-content -->

</x-layout>

<x-layout :title="__('messages.login') . ' | ' . __('messages.app_name')">
    {{-- Notes: An off-canvas generic alert (#offcanvasMessage) is displayed
        in case of error. More notes for implementation are provided below. --}}
    @section('scripts')
    {{-- Optional: Custom JS scripts for authentication --}}
    @endsection

    <!-- login content -->
    <div class="section background background-group-1 responsive-hide-completely container-xxl px-4">
        <div class="row">
            <div class="col-md-3 order-md-2">
                <div class="ps-4 ps-md-0 pt-4">
                    {{ __("messages.registration_prompt") }}<br />
                    <a href="{{ url('/register') }}" tabindex="6">{{ __("messages.registration") }}</a>
                </div>
            </div>
            <div class="col-md-9 order-md-1">
                <!-- form -->
                <form method="post" action="{{ route('login') }}">
                    @csrf

                    <div class="form px-0 px-md-6">
                        <div class="form-header p-4">
                            <h1>{{ __("messages.login_title")}}</h1>
                        </div>
                        <div class="field p-4">
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
                                id="email" />
                        </div>
                        <div class="field p-4">
                            <label class="field-label extended" for="password">{{ __("messages.password") }}</label>
                            <input
                                class="field-input underlined extended"
                                type="password"
                                name="password"
                                required="required"
                                aria-required="true"
                                autocomplete="current-password"
                                autocapitalize="off"
                                spellcheck="false"
                                aria-label="{{ __("messages.password_label") }}"
                                tabindex="2"
                                id="password"
                            />
                        </div>
                        <div class="form-options px-4 py-2 container-fluid">
                            <div class="row">
                                <div class="field col-sm-6 col-md-12 col-lg-6 text-start text-nowrap">
                                    <label class="field-label form-check-label" for="remember">{{ __("messages.stay_online") }}</label>
                                    <input class="field-input form-check-input ms-2" type="checkbox" tabindex="3" name="remember" id="remember">
                                </div>
                                <div class="col-sm-6 col-md-12 col-lg-6 pt-2 pt-sm-0 pt-md-2 pt-lg-0 text-start-end-start-end">
                                    <a href="{{ route('password.request') }}" tabindex="5">{{ __("messages.password_reset_prompt") }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="ms-4 me-4 ms-lg-0 mt-4 p-4 alert alert-note progressive-alert d-flex align-items-center" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" class="bi flex-shrink-0 me-4" role="img" aria-label="{{ __("messages.alert_notice") }}:" viewBox="0 0 16 16">
                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                            </svg>
                            <div>{{ __("messages.game_note") }}</div>
                        </div>
                        <div class="form-actions p-4 text-center">
                            <button class="btn btn-primary btn-lg text-nowrap responsive-expand" tabindex="4" type="submit" id="submit">{{ __("messages.login") }}</button>
                        </div>
                    </div>
                </form>
                <!-- / form -->
            </div>
        </div>

        @if($errors->any())
        <x-errorOffCanvas>
            {{ __("auth.email_password") }}
        </x-errorOffCanvas>
        @endif

    </div>
    <!-- end of login content -->

</x-layout>

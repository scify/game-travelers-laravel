<!-- /resources/views/layout/landing/header.blade.php -->
<header class="trvl-landing-header bg-green">
    <div class="container-xxl p-4 px-sm-5 px-lg-4">
        <div class="logo d-flex justify-content-center">
            <a class="d-block text-center" href="{{ route('home') }}">
                <img
                    class="img-fluid"
                    src="{{ asset('images/logo_blue.svg') }}"
                    width="358" height="195"
                    role="img"
                    alt="{{ __('messages.app_name') }}"
                >
            </a>
        </div>
    </div>
</header>
<div aria-hidden="true" class="trvl-curve trvl-curve--header-extended bg-green">
    <div class="trvl-curve trvl-curve--header trvl-curve--header--dash">
        &nbsp;
    </div>
</div>

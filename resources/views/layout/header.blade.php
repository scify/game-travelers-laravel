<!-- /resources/views/layout/header.blade.php -->
<header class="container-xxl clearfix trvl-header {{ $background ?? '' }} p-4">
    <div class="logo float-start">
        <a href="{{ url('/') }}">
            <img src="{{ asset('images/logo.svg') }}" width="145" height="79" role="img" alt="Ταξιδιώτες" />
        </a>
    </div>
    <div class="user float-end">
        @isset($hasUserMenu)
            @include('layout.user')
        @endisset
    </div>
</header>

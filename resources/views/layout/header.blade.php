<!-- /resources/views/layout/header.blade.php -->
<header class="container-xxl clearfix p-4 trvl-header centered {{ $headerBackground ?? '' }} @isset($overflow)add-overflow-margin @endisset">
    <div class="logo float-start">
        <a href="{{ url('/') }}">
            <img src="{{ asset('images/logo.svg') }}" width="145" height="79" role="img" alt="{{ config('app.name') }}">
        </a>
    </div>
    <div class="user float-end">
        @isset($hasUserMenu)
            @include('layout.user')
        @endisset
    </div>
</header>

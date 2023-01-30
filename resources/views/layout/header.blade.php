<!-- /resources/views/layout/header.blade.php -->
{{-- Default: No overflow-y expected (:overflow=null or unset) - Page is aligned at the middle of the screen. --}}
@empty($overflow)
<header class="container-xxl clearfix p-4 trvl-header centered {{ $background ?? '' }}">
@endempty
{{-- Overflow expected: Overflow-y expected (:overflow=true).- Page might be scrollable due to excess content. --}}
@isset($overflow)
<header class="container-xxl clearfix p-4 trvl-header {{ $background ?? '' }}">
@endisset
    <div class="logo float-start">
        <a href="{{ url('/') }}">
            <img src="{{ asset('images/logo.svg') }}" width="145" height="79" role="img" alt="{{ config('app.name') }}" />
        </a>
    </div>
    <div class="user float-end">
        @isset($hasUserMenu)
            @include('layout.user')
        @endisset
    </div>
</header>

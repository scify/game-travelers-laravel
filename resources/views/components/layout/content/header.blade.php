<!-- /resources/views/layout/content/header.blade.php -->
@php
/* Colorful green/white header with curves for Taxidiotes.
 *
 * @param string|null $headerBackgroundColor
 *    Optional header background color. Allowed values: green, white. Defaults
 *    to white, assuming that the element following the header has green
 *    background (which is the default for all pages). Green should only be
 *    set if the content that follows the header is in white backround.
 */
$supportedColors = ["green", "white"];
$headerBackgroundColor = isset($headerBackgroundColor) ? $headerBackgroundColor : "green";
if (!in_array($headerBackgroundColor, $supportedColors)) {
    $headerBackgroundColor = "green";
}
foreach ($supportedColors as $color) {
    $varName = "headerIs" . ucfirst($color);
    $$varName = ($headerBackgroundColor === $color);
}
@endphp
<header @class([
    'trvl-landing-header',
    'bg-green' => $headerIsGreen,
    'bg-light' => $headerIsWhite,
])>
    <div class="container-xxl p-4 px-sm-5 px-lg-4">
        <div class="logo d-flex justify-content-center">
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/logo.svg') }}" width="145" height="79" role="img" alt="{{ __('messages.app_name') }}">
            </a>
        </div>
    </div>
</header>
<div aria-role="presentation" @class([
    'trvl-curve',
    'trvl-curve--header',
    'trvl-curve--header--color',
    'trvl-curve--header--color--green' => $headerIsWhite,
    'trvl-curve--header--color--white' => $headerIsGreen,
    'bg-green' => $headerIsGreen,
    'bg-light' => $headerIsWhite,
])>
    <div class="trvl-curve trvl-curve--header trvl-curve--header--dash">
        &nbsp;
    </div>
</div>

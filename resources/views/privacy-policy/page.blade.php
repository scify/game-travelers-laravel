<x-layout :title="'Privacy Policy | Ταξιδιώτες'" :description="'This is the privacy policy page'">
    <div class="container p-3 mt-2 mb-5" style="background-color: #FFFFFF">
        @include('privacy-policy.content-' . app()->getLocale())
    </div>
</x-layout>

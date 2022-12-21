{{-- Hint: You can check the Diff on this page to discover how easy it is to use
    our own layout. Basically, all the HTML content inside <x-layout> goes to
    the  {{slot}} of /views/components/layout.blade.php. That's all! --}}
<x-layout :title="'Dummy home page | Ταξιδιώτες'" :description="'This is a dummy home page'">

    <div class="container">
        <div class="alert alert-dark" role="alert">
            Dummy home page
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-primary" type="submit">logout</button>
        </form>
    </div>

</x-layout>

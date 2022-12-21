<x-layout :title="'VUE PAGE TITLE HERE'" :hasVue=true>

    {{-- Note that #app has no stylesheets yet so class="container"
    has been added to make sure it's inside Bootstrap's width limits. --}}
    <div class="container" id="app">
        <example-component></example-component>
    </div>

</x-layout>

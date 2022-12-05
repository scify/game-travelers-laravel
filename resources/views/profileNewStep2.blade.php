<x-layout :title="'Νέο προφίλ παίκτη: 2ο βήμα | Ταξιδιώτες'">
    @section('scripts')
    {{-- Optional: Custom JS scripts for profiles --}}
    @endsection

    <!-- step counter 2/3 -->
    <div class="stepper container-xxl">
        <div class="step2 row">
            <div class="step2-1 col-1">
                <!-- empty -->
            </div>
            <div class="step2-2 col-4">
                <button class="btn btn-round past" type="button">1</button>
            </div>
            <div class="step2-3 col-7">
                <button class="btn btn-round current" type="button">2</button>
            </div>
        </div>
    </div>

    <!-- profile step 2 content -->
    <div class="section profiles container-xxl px-4 px-sm-5 px-xl-6">

        <form>

        </form>

    </div>
    <!-- / profile step 2 content -->

</x-layout>

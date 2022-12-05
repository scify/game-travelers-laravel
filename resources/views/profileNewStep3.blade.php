<x-layout :title="'Νέο προφίλ παίκτη: 3ο βήμα | Ταξιδιώτες'">
    @section('scripts')
    {{-- Optional: Custom JS scripts for profiles --}}
    @endsection

    <!-- step counter 3/3 -->
    <div class="stepper container-xxl">
        <div class="step3 row">
            <div class="step3-1 col-1">
                <!-- empty -->
            </div>
            <div class="step3-2 col-4">
                <button class="btn btn-round past" type="button">1</button>
            </div>
            <div class="step3-3 col-5">
                <button class="btn btn-round past" type="button">2</button>
            </div>
            <div class="step3-4 col-2">
                <button class="btn btn-round current" type="button">3</button>
            </div>
        </div>
    </div>

    <!-- profile step 3 content -->
    <div class="section profiles container-xxl px-4 px-sm-5 px-xl-6">

        <form>

        </form>

    </div>
    <!-- / profile step 3 content -->

</x-layout>

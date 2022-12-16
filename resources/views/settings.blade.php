<x-layout :title="'Ρυθμίσεις | Ταξιδιώτες'">
    @section('scripts')
    @endsection

    <!-- section header -->
    <div class="gamesettings-header container-xxl px-4 mt-lg-n4 mb-2 mb-lg-1">
        <div class="row">
            <div class="col-1">
                {{-- Reserved for header navigation buttons. --}}
            </div>
            <div class="col-10 text-center" id="currentPageHeader">
                <h1 id="currentPageLabel">Ρυθμίσεις</h1>
                <p>
                    <strong class="fs-5" id="currentPageDescription"> {{-- Why is this fs-5? cause it acts as the label of the radio buttons! --}}
                        Ρυθμίσεις παίκτη.
                    </strong>
                </p>
            </div>
            <div class="col-1">
                {{-- Note that this side conflicts with random trees. --}}
            </div>
        </div>
    </div>
    <!-- / section header -->

        <div class="section gamesettings container-xxl px-4"> {{-- background-dash-down removed --}}
        </div>


</x-layout>

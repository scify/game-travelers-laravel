<x-layout :title="'Επίλεξε πίστα | Νέο παιχνίδι | Ταξιδιώτες'" :hasUserMenu=true>
    @section('scripts')
    @endsection

    <form method="post" action="" id="newGame"> {{-- unused id --}}
        @csrf

            <!-- section header -->
        <div class="gamesettings-header container-lg px-4 mb-2 mb-lg-1">
            <div class="row">
                <div class="col-1">
                    <x-buttonBack
                        :label="'Ακύρωση και επιστροφή στην επιλογή παίκτη'"
                        :align="'left'"
                        :url="'select/player'"
                    />
                </div>
                <div class="col-10 text-center" id="currentPageHeader"> {{-- Why is this fs-5? cause it acts as the label of the radio buttons! --}}
                    <h1 id="currentPageLabel">Διάλεξε πίστα</h1>
                    <p>
                        <strong class="fs-5" id="currentPageDescription"> {{-- Why is this fs-5? cause it acts as the label of the radio buttons! --}}
                            Νησί, βουνό ή πόλη; Που θα ήθελες να ταξιδέψεις;
                        </strong>
                    </p>
                </div>
                <div class="col-1">
                    {{-- @TODO: ELI5 Logging-out without selecting a player. --}}
                </div>
            </div>
        </div>
        <!-- / section header -->

        <div class="section gamesettings container-xxl px-4">
            <div class="row gx-0">
            </div>
        </div>

    </form>

</x-layout>

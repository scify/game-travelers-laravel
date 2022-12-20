<x-layout :title="'Ρυθμίσεις παίκτη | Ταξιδιώτες'" :hasUserMenu=true>
    {{-- Note that player's name appears on currentPageDescription and is
        passed to the delete player modal via a component, so don't forget
        to update this page with proper values returned from the Controller.
        The back button goes back to the "previous" page via previous() and
        hopefully that will be sufficient. --}}
    @section('scripts')
    @endsection

    <!-- section header -->
    <div class="gamesettings-header container-xxl px-4 mt-lg-n4 mb-2 mb-lg-1">
        <div class="row">
            <div class="col-1">
                <x-buttonBack
                :label="'Επιστροφή στην προηγούμενη σελίδα'"
                :align="'left'"
                :url="url()->previous()" {{-- hopefully this is good enough. --}}
            />
            </div>
            <div class="col-10 text-center" id="currentPageHeader">
                <h1 id="currentPageLabel">Ρυθμίσεις</h1>
                <p>
                    <strong class="fs-5" id="currentPageDescription">
                        Διαμόρφωση επιλογών για τον παίκτη <em>Μανώλης</em>. {{-- Player Name goes here. --}}
                    </strong>
                </p>
            </div>
            <div class="col-1">
                {{-- Note that this side conflicts with decorative trees. --}}
            </div>
        </div>
    </div>
    <!-- / section header -->

    <div class="background background-group-3 background-group-3--dash container-xxl px-0">
        <div class="background-group-3--abstract container-xxl px-0">
            <div class="section gamesettings background-group-3--flowers container-xxl px-4">

                <div class="buttonstack vstack gap-4 pt-4 mx-auto settings-options text-center">
                    <a class="btn btn-lg btn-primary" tabindex="1">
                        <span class="balloon"></span> Προφίλ παίκτη
                    </a>
                    <a class="btn btn-lg btn-primary disabled" tabindex="-1" >
                        <span class="balloon"></span> Μουσική & ήχος
                    </a>
                    <a class="btn btn-lg btn-primary" tabindex="3">
                        <span class="balloon"></span> Πλοήγηση
                    </a>
                    <a class="btn btn-lg btn-primary" tabindex="4">
                        <span class="balloon"></span> Επίπεδο δυσκολίας
                    </a>
                    <!-- delete player button -->
                    <button class="btn btn-lg btn-danger" data-bs-toggle="modal" data-bs-target="#modalPlayerDelete" tabindex="5">
                        <span class="balloon"></span> Διαγραφή παίκτη
                    </button> {{-- Modal located outside this messy nest. --}}
                    <!-- / delete player button -->

                </div>

            </div>
        </div>
    </div>

{{-- Modals should be at a top-level position.
    @see https://getbootstrap.com/docs/5.1/components/modal/
    --}}
<x-modalPlayerDelete
    {{-- Please note that the modal is styled, yet has a dummy
        confirmation button that does nothing as we don't yet have
        the link. --}}
    :playerName="'Μανώλης'" {{-- Player Name goes here. --}}
    :playerId=1 {{-- Player ID goes here. --}}
/>

</x-layout>

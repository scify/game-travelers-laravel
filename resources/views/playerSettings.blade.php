<x-layout :title="'Ρυθμίσεις παίκτη | Ταξιδιώτες'" :hasUserMenu=true>
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
                        Διαμόρφωση επιλογών για τον παίκτη <em>Μανώλης</em>.
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
                        <span class="balloon"></span> Τρόπος χειρισμού
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

<style type="text/css">

    .buttonstack {
        width: 16rem;
    }
    .buttonstack a,
    .buttonstack button {
        white-space: nowrap;
        position: relative;
    }
    .btn > .balloon {
        cursor: default;
        opacity: 0;
        transition: all 0.2s ease-in-out;
        color: #aaaaaa;
        content: '';
        width: 44px;
        height: 44px;
        position: absolute;
        line-height: 1;
        right: 22rem;
        bottom: 0;
        background-image: url("data:image/svg+xml,%3Csvg height='44' viewBox='0 0 44 44' width='44' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='m14 43c-.20962-.064766-3-1-3-1-1.513595-.358608-.996483-1.043674-.521459-2.285126l.570313-1.755859.117187-4.958984h.072266c-.266076-1.18224-.724609-3.123047-.724609-3.123047-.00153-.003392-.002357-.006352-.003907-.009766-21.728994-27.037796 5.156163-28.990047 5.244141-28.990234 3.417121-.755005 7.148822-.472699 10.583985.65039l.22461.072266c3.529783 1.156998 6.787941 3.213177 9.111328 5.953125 2.912235 2.364143 17.446834 16.384024-12.476563 25.953125-.267002.122036-.486084.231048-.658203.330078-.04026.03434-2.667726 2.277378-3.019531 2.605469-.354504.330612-.624661.496433-.830078.429687l-.054688-.017578-1.611328 2.705078.208985.06836c.110805.036579.172779.154644.136718.265625l-.611328 1.878906c-.681677 1.665386-.815669 1.828548-2.757839 1.228485zm2.046902-3.759735 1.611328-2.707031-1.876954-.613282-1.132813 2.861329zm-2.431642-.796875 1.132813-2.861328-2.457032-.804688-.076172 3.207032z' fill='%23383735' fill-rule='evenodd'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
    }
    .btn:hover > .balloon {
        opacity: 1;
    }

    @media (max-width: 575.98px) {
        .buttonstack {
            width: 100%;
        }
        .btn > .balloon {
            width: 38px;
            height: 38px;
            background-size: 32px 32px;
        }
        .btn:hover > .balloon {
            opacity: 0.9;
        }
    }
</style>


</x-layout>

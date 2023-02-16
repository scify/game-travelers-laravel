<x-layout :title="'Ρυθμίσεις ήχου | Ταξιδιώτες'" :hasUserMenu=true :headerBackground="'background-dash-up'">
    @section('scripts')
        <script src="{{ mix('js/functions/settings.js') }}" defer></script>
    @endsection

    <form
        method="post" {{-- should be post, get is for testing --}}
        action="{{ route('settings.audio', [ request()->player_id, request()->from, request()->game_id ]) }}"
        id="settingsAudio"
    >
        @csrf

        <!-- section header -->
        <div class="gamesettings-header container-xxl px-4 mb-2 mb-lg-3 mt-3 pt-3 pb-3"> {{-- New/Existing diff: mb-2 mb-lg-3 mt-3 pt-3 pb-3 --}}
            <div class="row">
                <div class="col-1">
                    <x-linkButtonBack
                    :label="'Επιστροφή στις ρυθμίσεις'"
                    :align="'left'"
                    :url="route('settings', [ request()->player_id, request()->from, request()->game_id ] )"
                />
                </div>
                <div class="col-10 text-center" id="currentPageHeader">
                    <h1 id="currentPageLabel">Ρυθμίσεις μουσικής & ήχου</h1>
                    <p>
                        <strong id="currentPageDescription">
                            Ένταση μουσικής & ήχου και προσωπικοί ήχοι για τον παίκτη <em> {{ $name }}</em>.
                        </strong>
                    </p>
                </div>
                <div class="col-1">
                    {{-- Reserved for navigation buttons. --}}
                </div>
            </div>
        </div>
        <!-- / section header -->
        <div class="section settings container-xxl px-4 px-sm-5 px-xl-6">
            <div id="settingsGroup" class="row mx-0 mx-md-6">
                <div class="border-bottom border-1 my-3">
                    <h2>Ένταση</h2>
                </div>
                <div class="my-4 mx-2">
                    <div class="volume-slider">
                        <label class="form-label" for="musicVolume">Μουσική</label>
                        <div class="position-relative">
                            <div>
                                <input
                                    class="form-range form-volume-slider"
                                    type="range"
                                    name="musicVolume"
                                    data-function="volume-slider"
                                    data-prevent-min-value="false"
                                    value="{{ $musicVolume }}"
                                    min="0"
                                    max="1"
                                    step="0.1"
                                    tabindex="1"
                                    id="musicVolume"
                                />
                            </div>
                            <div class="position-relative volume-slider--progress" data-function="volume-progress" id="musicVolumeProgress" aria-hidden="true">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="my-4 mx-2">
                    <div class="volume-slider">
                        <label class="form-label" for="soundVolume">Ήχος</label>
                        <div class="position-relative">
                            <div>
                                <input
                                    class="form-range form-volume-slider"
                                    type="range"
                                    name="soundVolume"
                                    data-function="volume-slider"
                                    data-prevent-min-value="true"
                                    value="{{ $soundVolume }}"
                                    min="0"
                                    max="1"
                                    step="0.1"
                                    tabindex="2"
                                    id="soundVolume"
                                />
                            </div>
                            <div class="position-relative volume-slider--progress" data-function="volume-progress" id="soundVolumeProgress" aria-hidden="true" >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="border-bottom border-1 my-3">
                    <h2>Λίστα ήχων</h2>
                </div>
                <!-- soundAccordion -->
                <div class="accordion accordion-flush" id="soundsAccordion">
                    <!-- soundAccordion item -->
                    <div class="accordion-item">
                        <h3 class="accordion-header" id="soundsAccordionWinHead">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#soundsAccordionWin" aria-expanded="false" aria-controls="soundsAccordionWin">
                                Ήχοι νίκης
                            </button>
                        </h3>
                        <div id="soundsAccordionWin" class="accordion-collapse collapse hide" aria-labelledby="soundsAccordionWinHead" data-bs-parent="#soundsAccordion">
                            <div class="accordion-body form-sound">
                                <div class="input-group input-group-sm mb-3">
                                    <label class="input-group-text" for="inputWinFile1">Ήχος 1</label>
                                    <input type="file" class="form-control" id="inputWinFile1" accept="audio/mpeg,.mp3">
                                    <button class="btn btn-secondary" type="button" id="playWinFile1">Αναπαραγωγή</button>
                                    <button class="btn btn-danger" type="button" id="resetWinFile1">Επαναφορά</button>
                                </div>
                                <div class="input-group input-group-sm mb-3">
                                    <label class="input-group-text" for="inputWinFile2">Ήχος 2</label>
                                    <input type="file" class="form-control" id="inputWinFile2" accept="audio/mpeg,.mp3">
                                    <button class="btn btn-secondary" type="button" id="playWinFile2" disabled>Αναπαραγωγή</button>
                                    <button class="btn btn-danger" type="button" id="resetWinFile2" disabled>Επαναφορά</button>
                                </div>
                                <div class="input-group input-group-sm mb-3">
                                    <label class="input-group-text" for="inputWinFile3">Ήχος 3</label>
                                    <input type="file" class="form-control" id="inputWinFile3" accept="audio/mpeg,.mp3">
                                    <button class="btn btn-secondary" type="button" id="playWinFile3" disabled>Αναπαραγωγή</button>
                                    <button class="btn btn-danger" type="button" id="resetWinFile3" disabled>Επαναφορά</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- / soundAccordion item -->
                    <!-- soundAccordion item -->
                    <div class="accordion-item">
                        <h3 class="accordion-header" id="soundsAccordionLoseHead">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#soundsAccordionLose" aria-expanded="false" aria-controls="soundsAccordionLose">
                                Ήχοι ήττας
                            </button>
                        </h3>
                        <div id="soundsAccordionLose" class="accordion-collapse collapse hide" aria-labelledby="soundsAccordionLoseHead" data-bs-parent="#soundsAccordion">
                            <div class="accordion-body form-sound">
                                <div class="input-group input-group-sm mb-3">
                                    <label class="input-group-text" for="inputWinFile1">Ήχος 1</label>
                                    <input type="file" class="form-control" id="inputWinFile1" accept="audio/mpeg,.mp3">
                                    <button class="btn btn-secondary" type="button" id="playWinFile1">Αναπαραγωγή</button>
                                    <button class="btn btn-danger" type="button" id="resetWinFile1">Επαναφορά</button>
                                </div>
                                <div class="input-group input-group-sm mb-3">
                                    <label class="input-group-text" for="inputWinFile2">Ήχος 2</label>
                                    <input type="file" class="form-control" id="inputWinFile2" accept="audio/mpeg,.mp3">
                                    <button class="btn btn-secondary" type="button" id="playWinFile2" disabled>Αναπαραγωγή</button>
                                    <button class="btn btn-danger" type="button" id="resetWinFile2" disabled>Επαναφορά</button>
                                </div>
                                <div class="input-group input-group-sm mb-3">
                                    <label class="input-group-text" for="inputWinFile3">Ήχος 3</label>
                                    <input type="file" class="form-control" id="inputWinFile3" accept="audio/mpeg,.mp3">
                                    <button class="btn btn-secondary" type="button" id="playWinFile3" disabled>Αναπαραγωγή</button>
                                    <button class="btn btn-danger" type="button" id="resetWinFile3" disabled>Επαναφορά</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- / soundAccordion item -->
                </div>
                <!-- / soundAccordion -->
                <div id="navGroup" class="form-actions d-flex align-items-end flex-column py-3">
                    <button
                        class="btn btn-primary btn-lg responsive-expand"
                        id="submitButton"
                        tabindex="200"
                        type="submit"
                        name="submit"
                        value="save"
                    >
                        αποθήκευση
                    </button>
                </div>
            </div>
        </div>

    </form>

<style type="text/css">
.settings .accordion h3 button {
    font-size: 1.15rem;
    font-weight: 700;
}
.settings .accordion {
    --bs-accordion-border-color: rgba(var(--trvl-color-rgb), 0.2);
    --bs-accordion-active-color: var(--trvl-color);
    --bs-accordion-active-bg: rgba(var(--trvl-bg-rgb),1);
    --bs-accordion-btn-icon-width: 1.3em;
    --bs-accordion-btn-focus-border-color: rgba(var(--trvl-c-green-pale-rgb), 0.7);
    --bs-accordion-btn-focus-box-shadow: 0 0 0 0.25rem rgba(var(--trvl-c-green-pale-rgb), 0.4);
    --bs-accordion-btn-active-icon: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23000000'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e")
}
.settings .accordion-button:not(.collapsed) {
    border-bottom: 2px solid rgba(var(--trvl-color-rgb), 0.9);
}

.form-sound h3 button {
    font-size: 1.15em;
    font-weight: 700;
}
.form-sound .input-group-text {
    background: rgba(var(--trvl-color-rgb), 0.9);
    color: var(--trvl-c-bright);
    border: 1px solid rgba(var(--trvl-color-rgb), 0.5);
}
.form-sound input {
    background: rgba(var(--trvl-color-rgb), 0.04);
    border: 0px solid rgba(var(--trvl-color-rgb), 0.5);
}

</style>

</x-layout>

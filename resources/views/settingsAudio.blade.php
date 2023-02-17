<x-layout
    :title="__('messages.sound_settings') . ' | ' . __('messages.app_name')"
    :hasUserMenu=true
    :overflow=true
    :headerBackground="'background-dash-up'"
    >
    @section('scripts')
        <x-settingsScripts
            :music="'music.feelin_good'"
            :volume=$musicVolume
        />
    @endsection

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
                <h1 id="currentPageLabel">{{ __('messages.sound_settings') }}</h1>
                <p>
                    <strong id="currentPageDescription">
                        Ένταση ήχου και προσωπικοί ήχοι για τον παίκτη <em> {{ $name }}</em>.
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


            <!-- music & sound volume -->
            <form
            method="post" {{-- should be post, get is for testing --}}
            action="{{ route('settings.audio', [ request()->player_id, request()->from, request()->game_id ]) }}"
            id="settingsAudio"
        >
            @csrf

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
                <div id="navGroup" class="form-actions d-flex align-items-end flex-column py-3 d-none">
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

            </form>
            <!-- / music & sound volume -->

            <x-settingsAudioFiles
                :player-audio-files=$playerAudioFiles
            />

        </div>
    </div>

</x-layout>

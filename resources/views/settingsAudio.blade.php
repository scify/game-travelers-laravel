<x-layout
    :title="__('messages.sound_settings') . ' | ' . __('messages.app_name')"
    :has-user-menu=true
    :overflow=true
    :header-background="'background-dash-up'"
    :has-vue=true
    :player-audio=$playerAudio
>

    @section('scripts')
        <x-settingsScripts />
        {{--Music playback is controlled via #musicVolumeSlider--}}
    @endsection


    <!-- section header -->
    <div class="gamesettings-header container-xxl px-4 mb-2 mb-lg-3 mt-3 pt-3 pb-3">
        {{--New / Existing diff: mb - 2 mb - lg - 3 mt - 3 pt - 3 pb - 3--}}
        <div class="row">
            <div class="col-1">
                <x-linkButtonBack
                    :label="'Επιστροφή στις ρυθμίσεις'"
                    :align="'left'"
                    :url="route('settings', [ request()->player_id, request()->from, request()->game_id ] )"
                />
            </div>
            <div class="col-10 text-center" id="currentPageHeader">
                <h1 id="currentPageLabel">{{ __("messages.sound_settings") }}</h1>
                <p>
                    <strong id="currentPageDescription">
                        Ένταση ήχου και προσωπικοί ήχοι για τον παίκτη <em> {{ $name }}</em>.
                    </strong>
                </p>
            </div>
            <div class="col-1">
                {{--Reserved for navigation buttons.--}}
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
                                    type="range"
                                    name="musicVolume"
                                    data-function="volume-slider" {{-- Used by JS --}}
                                    data-prevent-min-value="false" {{-- Used by JS --}}
                                    data-music="music.feelin_good" {{-- Used by JS --}}
                                    data-music-volume="{{ $playerAudio['playerMusicVolume'] }}" {{-- Used/Updated by JS --}}
                                value="{{ $playerAudio['playerMusicVolume'] }}" {{--Used / Updated by JS--}}
                                min="0" {{--Used by JS--}}
                                max="1" {{--Used by JS--}}
                                step="0.1" {{--Used by JS--}}
                                tabindex="1"
                                class="form-range form-volume-slider"
                                id="musicVolumeSlider"
                                />
                            </div>
                            <div class="position-relative volume-slider--progress" data-function="volume-progress"
                                 id="musicVolumeSliderProgress" aria-hidden="true">
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
                                    type="range"
                                    name="soundVolume"
                                    data-function="volume-slider"
                                    data-prevent-min-value="true"
                                    value="{{ $playerAudio['playerSoundVolume'] }}"
                                    min="0"
                                    max="1"
                                    step="0.1"
                                    tabindex="2"
                                    id="soundVolumeSlider"
                                    class="form-range form-volume-slider"
                                />
                            </div>
                            <div class="position-relative volume-slider--progress" data-function="volume-progress"
                                 id="soundVolumeSliderProgress" aria-hidden="true">
                            </div>
                        </div>
                    </div>
                </div>


                <div id="app">
                    <custom-audios-component
                        :player-id='{{ $player_id }}'
                        :player-audio-files='@json($playerAudio["playerAudioFiles"])'
                    >
                    </custom-audios-component>
                </div>
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

            </form>
        </div>
    </div>

</x-layout>

<!-- /resources/views/components/settingsAudioFiles.blade.php -->

<div class="border-bottom border-1 my-3">
    <h2>{{ __("messages.sounds_custom") }}</h2>
</div>

<!-- audio-files -->
<div id="audioFiles" class="audiofiles mb-5">

    @foreach ($playerAudioFiles as $key => $playerAudioFile)

    <!-- audio-files-category -->
    <div class="audiofiles-category pb-1 audiofiles-category_{{ $loop->iteration }}">
        <div class="audiofiles-category--header my-3 border-bottom border-1">
            <h3>{{ __("messages.$key") }}</h3>
        </div>
        <div class="audiofiles-category--body">

            @foreach ($playerAudioFile as $audioKey => $audioFile)

            <form
                method="post"
                action="{{ route('audio.upload') }}"
            >
                @csrf

                <div class="input-group input-group-sm mb-3 audiofiles-item">
                    <label class="input-group-text" for="soundInput_{{ $key }}_{{ $loop->iteration }}" id="soundLabel_{{ $key }}_{{ $loop->iteration }}">{{ __("messages.sound") }} {{ $loop->iteration }}</label>
                    <input type="file" @class(['form-control', 'd-none' => $audioFile]) id="soundInput_{{ $key }}_{{ $loop->iteration }}" accept="audio/mpeg,.mp3">
                    <span @class(['form-control', 'd-none' => ! $audioFile])></span>
                    <button type="button" id="soundSubmit_{{ $key }}_{{ $loop->iteration }}" @class(['btn', 'btn-primary', 'd-none' => $audioFile])>Upload</button>
                    <button type="button" id="soundPlay_{{ $key }}_{{ $loop->iteration }}" @class(['btn', 'btn-secondary', 'd-none' => ! $audioFile])>Αναπαραγωγή</button>
                    <button type="button" id="soundReset_{{ $key }}_{{ $loop->iteration }}" @class(['btn', 'btn-danger', 'd-none' => ! $audioFile])>Αφαίρεση</button>
                </div>
            </form>

            @endforeach


        </div>
    </div>

    @endforeach

</div>
<!-- / audioFiles -->


<!-- /resources/views/components/settingsAudioFilesAccordion.blade.php -->

<div class="accordion accordion-flush" id="customAudioAccordion">
    <div class="accordion-item">
        <h2 class="border-bottom border-1" id="customAudioAccordionHead">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#customAudioAccordionBody" aria-expanded="false" aria-controls="customAudioAccordionBody">
                Προσωπικοί ήχοι
            </button>
        </h2>
        <div class="accordion-collapse collapse hide" id="customAudioAccordionBody">
            <div class="accordion-body form-sound pt-3">

<!-- audioAccordion -->
<div class="accordion accordion-flush" id="audioAccordion">

    @foreach ($playerAudioFiles as $key => $playerAudioFile)

    <!-- audioAccordion item -->
    <div class="accordion-item acordion-item--{{ $loop->iteration }}">
        <h3 class="accordion-header" id="audioAccordionHead_{{ $loop->iteration }}">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#audioAccordion_{{ $loop->iteration }}" aria-expanded="false" aria-controls="audioAccordion_{{ $loop->iteration }}">
                {{ __("messages.$key") }}
            </button>
        </h3>
        <div id="audioAccordion_{{ $loop->iteration }}" class="accordion-collapse collapse hide" aria-labelledby="audioAccordionHead_{{ $loop->iteration }}" data-bs-parent="#audioAccordion">
            <div class="accordion-body form-sound pt-3">

                @foreach ($playerAudioFile as $audioKey => $audioFile)

                <form>
                    @csrf

                    <div class="input-group input-group-sm mb-3">
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
    </div>
    <!-- / audioAccordion item -->

    @endforeach

</div>
<!-- /audioAccordion -->


</div>
</div>
</div>
</div>

<x-layout :title="'Νέο προφίλ παίκτη: 1ο βήμα | Ταξιδιώτες'">
    @section('scripts')
    {{-- Optional: Custom JS scripts for profiles --}}
    @endsection

    <!-- step counter 1/3 -->
    <div class="stepper container-xxl">
        <div class="step1 row">
            <div class="step1-1 col col-1">
                <!-- empty -->
            </div>
            <div class="step1-2 col col-11">
                <button class="btn btn-round current" type="button">1</button>
            </div>
        </div>
    </div>

    <!-- profile step 1 content -->
    <div class="section profiles container-xxl px-4 px-sm-5 px-xl-6">

        <form>

            <div id="nameRow" class="field profiles-row row">
                <div class="col-md-3">
                    <label class="extended big" for="playerName">
                        Ονομα παίκτη
                    </label>
                </div>
                <div class="col-md-9">
                    <input
                        class="extended underlined big"
                        type="text"
                        name="name"
                        maxlength="50"
                        required="true"
                        autocomplete="nickname"
                        autocapitalize="on"
                        spellcheck="false"
                        tabindex="1"
                        id="playerName" />
                    <div class="alert" id="alertName">{{-- Message of alertName goes here --}}</div>
                </div>
            </div>

            <div id="avatarRow" class="field profiles-row row">
                <div class="col-md-3">
                    <label class="extended big" for="">
                        Διάλεξε φατσούλα
                    </label>
                </div>
                <div class="col-md-9">

                    <div class="avatars container-lg text-center">
                        <div class="row trvl-avatars--row">
                            <x-profileNewAvatar :avatar=$avatarData[0] />
                            <x-profileNewAvatar :avatar=$avatarData[1] />
                            <x-profileNewAvatar :avatar=$avatarData[2] />
                            <x-profileNewAvatar :avatar=$avatarData[3] />
                            <x-profileNewAvatar :avatar=$avatarData[4] />
                            <x-profileNewAvatar :avatar=$avatarData[5]/>
                        </div>
                    </div>

                </div>
            </div>

            <div id="nextRow" class="profiles-row row">
                <div class="col-md-3">
                </div>
                <div class="col-md-9 text-center-end">
                    <strong>
                        Διάλεξε ένα όνομα και ένα άβαταρ για να συνεχίσεις!
                    </strong>
                </div>
            </div>

        </form>

    </div>
    <!-- / profile step 1 content -->

</x-layout>

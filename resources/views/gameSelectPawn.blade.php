<x-layout
    :title="__('messages.select_pawn') . ' | ' . __('messages.new_game') . ' | ' . __('messages.app_name')"
    :hasUserMenu=true
    :background="'background-dash-up'"
>
    {{-- This page was designed responsively in order to support any amount of
         pawns, therefore you can simply use the x-selectPawnButton component as
         many times as needed. You can't disable panws with comingsoon=true.

         Pawns are linked to boards: The characters are the same, but they
         have different apperances (e.g. swiming suit on island, versus a
         footer on mountain. Therefore, x-selectPawnButton excpects a board id
         --}}
    @section('scripts')
        <x-switcher :switcher=$switcher :audio="'sounds.game_start.pawn_onload'" />
    @endsection

    <form method="post"
        action="{{ route('select.pawn', [ request()->player_id, request()->from, request()->game_id ]) }}"
    >
        @csrf

        <!-- section header -->
        <div class="gameselect-header container-lg px-4 mb-2 mb-lg-1">
            <div class="row">
                <div class="col-1">
                    {{-- Reserved for header navigation buttons.  --}}
                </div>
                <div class="col-10 text-center" id="currentPageHeader">
                    <h1 id="currentPageLabel">{{ __("messages.select_pawn") }}</h1>
                    <p>
                        <strong class="fs-5" id="currentPageDescription">
                            {{--Use `&nbsp;` if no description.--}}
                            &nbsp;
                        </strong>
                    </p>
                </div>
                <div class="col-1">
                    {{--  Reserved for header navigation buttons. --}}
                </div>
            </div>
        </div>
        <!-- / section header -->

        <div class="section gameselect container-xxl pt-3 px-4 px-lg-6">
            <div class="row text-center justify-content-center gy-4 gy-xxl-2">
                @foreach ($pawns as $pawn)
                    @php
                    $tabindex = $tabindex ?? $loop->index; $tabindex++;
                    @endphp
                    <x-selectPawnButton
                        :pawn_id='$pawn["id"]'
                        :name='$pawn["name"]'
                        :asset='$pawn["asset"]'
                        :alt='$pawn["alt"]'
                        :tabindex=$tabindex
                        :board=$board
                    />
                @endforeach
            </div>
            <div class="row gx-0 pt-6 pt-sm-0 fix-pawn-margin">
                <div class="col-12">
                    <div class="d-flex flex-auto mt-4 mt-sm-0">
                        <a
                            class="btn btn-primary btn-circle ms-auto responsive-expand"
                            href="{{ route('select.mode', [ request()->player_id, 'mode', request()->game_id ])}}"
                            id="backButton"
                            data-tabindex="1000"
                            tabindex="1000"
                        >
                            <span>πίσω</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </form>

</x-layout>

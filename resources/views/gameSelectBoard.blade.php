<x-layout
    :title="__('messages.select_board') . ' | ' . __('messages.new_game') . ' | ' . __('messages.app_name')"
    :hasUserMenu=true
    :background="'background-dash-up'"
>
    {{--This page was designed responsively in order to support any amount of
        boards, therefore you can simply use the x-selectBoardButton component
        as many times as needed. If one of the boards is not available for any
        reason, it can be disabled by setting :comingsoon = true (instead of the
        default null). --}}
    @section('scripts')
        <x-switcher :switcher=$switcher :audio="'sounds.game_start.welcome_[1-3]'" />
        <script>window.setTimeout(function() {window.music("music.feelin_good");}, 500);</script>
    @endsection

    <form method="post"
          action="{{ route('select.board', [ request()->player_id, request()->from, request()->game_id ]) }}"
    >
        @csrf

        <!-- section header -->
        <div class="gameselect-header container-lg px-4 mb-2 mb-lg-1">
            <div class="row">
                <div class="col-1">
                    {{--Reserved for header navigation buttons.--}}
                </div>
                <div class="col-10 text-center" id="currentPageHeader">
                    <h1 id="currentPageLabel">{{ __('messages.select_board') }}</h1>
                    <p>
                        <strong class="fs-5" id="currentPageDescription">
                            {{--Use `&nbsp;` if no description.--}}
                            Νησί, βουνό ή πόλη; Που θα ήθελες να ταξιδέψεις;
                        </strong>
                    </p>
                </div>
                <div class="col-1">
                    {{--Reserved for header navigation buttons.--}}
                </div>
            </div>
        </div>
        <!-- / section header -->

        <div class="section gameselect container-xxl pt-5 px-4 px-lg-6">
            <div class="row text-center gx-2 gy-5">
                @foreach ($boards as $board)
                    @php
                        $tabindex = $tabindex ?? $loop->index; $tabindex++;
                    @endphp
                    <x-selectBoardButton
                        :board_id='$board["id"]'
                        :asset='$board["preview"]["asset"]'
                        :alt='$board["preview"]["alt"]'
                        :audio-focus='$board["audio"]["focus"]'
                        :audio-select='$board["audio"]["select"]'
                        :comingsoon='$board["comingsoon"]'
                        :name='$board["name"]'
                        :tabindex=$tabindex
                    />
                @endforeach
            </div>
            <div class="row gx-0 pt-6 pt-sm-0 pt-md-0 pt-lg-0 pt-xl-6 pt-xxl-6">
                <div class="col-12">
                    <div class="d-flex flex-auto">
                        <a
                            class="btn btn-primary btn-circle ms-auto responsive-expand"
                            href="{{ route("select.player", [0,"user", 0]) }}"
                            tabindex="100"
                            data-tabindex="100"
                            type="submit"
                            id="backButton"
                        >
                            <span>πίσω</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </form>

</x-layout>

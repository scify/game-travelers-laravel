<!-- /resources/views/components/modalSettings.blade.php -->
<div class="modal fade" id="modalSettings{{ $help ?? '' }}" tabindex="-1" aria-labelledby="modalSettings{{ $help ?? '' }}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
        <div class="modal-header row">
            <div class="col-11">
                <h5 class="modal-title" id="modal{{ $help ?? '' }}Label">
                    {{ $title ?? '' }}
                </h5>
            </div>
            <div class="col-1">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Κλείσιμο"></button>
            </div>
            <div class="w-100"></div>
            <div class="modal-subheader col-12">
                {{ $subtitle ?? '' }}
            </div>
        </div>
        <div class="modal-body">
            {{ $slot }}
        </div>
        <div class="modal-footer">
            <div class="d-grid gap-3 col-12">
                <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Έξοδος</button> -->
            </div>
        </div>
    </div>
    </div>
</div>

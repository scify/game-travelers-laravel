<!-- /resources/views/components/modalPlayerDelete.blade.php -->
<div class="modal fade" id="modalPlayerDelete" tabindex="-1" aria-labelledby="modalPlayerDeleteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="modalPlayerDeleteLabel">Διαγραφή παίκτη</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Ακύρωση"></button>
        </div>
        <div class="modal-body">
            Θέλετε πραγματικά να διαγράψετε τον παίκτη «{{ $playerName ?? 'Παίκτης'}}»;
        </div>
        <div class="modal-footer">
            {{-- Form notes:
                - As usual a player belogns to user validation would
                 be nice in order to validate the request to delete a player.
                - After deletion, user can be forwarded to the list at
                 /select/player from which the management of players is
                 possible. Deleted player won't be there anymore! --}}
            <form method="post" action="{{ url('/select/player') }}">
                @csrf
                {{-- as usual a player belongs to user validation would be nice --}}
                <input type="hidden" name="player" value="{{ $playerId ?? 0 }}" />
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Ακύρωση</button>
                <button type="button" class="btn btn-danger" name="submit" value="deletePlayer">Διαγραφή παίκτη</button>
            </form>
        </div>
    </div>
    </div>
</div>

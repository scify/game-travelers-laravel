<!-- /resources/views/components/modalPlayerDelete.blade.php -->
{{-- Form notes:
    - As usual a player belogns to user validation would
        be nice in order to validate the request to delete a player.
    - After deletion, user can be forwarded to the list at
        /select/player from which the management of players is
        possible. Deleted player won't be there anymore! --}}
<form method="post" action="{{ route('settings', ['player_id' => $playerId, 'from' => $from, 'game_id' =>$gameId]) }}">
    @csrf
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
                <div class="d-grid gap-3 col-12">
                    <button type="submit" class="btn btn-danger" name="submit" value="deletePlayer">Διαγραφή παίκτη</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Ακύρωση</button>
                </div>
            </div>
        </div>
        </div>
    </div>

</form>

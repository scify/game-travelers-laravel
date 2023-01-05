<!-- /resources/views/components/modalLogout.blade.php -->
<form method="post" action="{{ route('logout') }}">
    @csrf

    <div class="modal fade" id="modalLogout" tabindex="-1" aria-labelledby="modalLogoutLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modalLogoutLabel">Έξοδος από το παιχνίδι</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Ακύρωση"></button>
            </div>
            <div class="modal-body">
                Θέλετε να αποσυνδεθείτε από τους «Ταξιδιώτες»;
            </div>
            <div class="modal-footer">
                <div class="d-grid gap-3 col-12">
                    <button type="submit" class="btn btn-primary" name="submit" value="logout">Έξοδος</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ακύρωση</button>
                </div>
            </div>
        </div>
        </div>
    </div>

</form>

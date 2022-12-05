<div class="offcanvas offcanvas-bottom is-invalid" tabindex="-1" id="offcanvasMessage" aria-labelledby="offcanvasMessageLabel">
    <div class="offcanvas-header">
        <div class="offcanvas-title mx-auto fs-4 text-center" id="offcanvasMessageLabel"><!-- ERROR MESSAGE GOES HERE --></div>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Κλείσιμο"></button>
    </div>
</div>

<script defer>
    /** Show off-canvas message via Bootstrap
    *  @param {string} msg - the message to be shown
    */
    function showOffcanvas(msg) {
        if (msg) {
            // Pass the message and display the element:
            const el = document.getElementById("offcanvasMessage");
            const label = document.getElementById("offcanvasMessageLabel");
            label.textContent = msg.trim();
            const bsOffcanvas = bootstrap.Offcanvas.getOrCreateInstance(el);
            bsOffcanvas.show();
            return true;
        }
    }
    window.addEventListener("load", function(event) {
        // Π.χ. "Το email ή το συνθηματικό που εισάγατε είναι λάθος!"
        showOffcanvas("{{ $message ?? 'Παρουσιάστηκε απροσδιόριστο σφάλμα!' }}");
    });
</script>

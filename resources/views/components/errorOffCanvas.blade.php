<div class="offcanvas offcanvas-bottom d-grid is-invalid" tabindex="-1" id="offcanvasMessage" aria-labelledby="offcanvasMessageLabel">
    <div class="offcanvas-header">
        <div class="offcanvas-title mx-auto fs-4 text-center" id="offcanvasMessageLabel">
            {{ $slot }}
        </div>
        <button
            type="button"
            class="btn-close text-reset"
            data-bs-dismiss="offcanvas"
            aria-label="{{ __("messages.close") }}"
        ></button>
    </div>
</div>

<script defer>
    window.addEventListener("load", function(event) {
        const el = document.getElementById("offcanvasMessage");
        const bsOffcanvas = bootstrap.Offcanvas.getOrCreateInstance(el);
        bsOffcanvas.show();
    });
</script>

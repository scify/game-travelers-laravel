<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Σύνδεση | Ταξιδιώτες</title>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <!-- Scripts -->
    <script src="{{ mix('js/main.js') }}" defer></script>
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
  </head>
  <body>

    <x-header/>

    <!-- main-content -->
    <div class="container-xxl ps-4 pe-4 trvl-main-content trvl-flower trvl-flower-12">
      <div class="row">

        <div class="col-md-3 order-md-2">
          <div class="ps-4 ps-md-0 pt-4">
            Νέος χρήστης;<br />
            <a href="/register">Δημιουργία λογαριασμού</a>
          </div>
        </div>

        <div class="col-md-9 order-md-1">
          <div class="trvl-form">
            <div class="p-4">
              <h1>Καλώς ήρθες!</h1>
            </div>
            <form>
              <div class="p-4">
                <label class="extended" for="email">Email</label>
                <input class="extended" type="email" name="email" id="email" />
              </div>
              <div class="p-4">
                <label class="extended" for="password1">Συνθηματικό</label>
                <input class="extended" type="password" name="password1" id="password1" />
              </div>
              <div class="px-4 py-2 container-fluid">
                <div class="row">
                  <div class="col-sm-6 text-start text-nowrap">
                    <label class="form-check-label" for="cookie">Μείνετε συνδεδεμένοι</label>
                    <input class="form-check-input" type="checkbox" value="" id="cookie">
                  </div>
                  <div class="col-sm-6 text-start-end">
                    <a href="#">Ξέχασες το συνθηματικό;</a>
                  </div>
                </div>
              </div>
              <div class="actions p-4 text-center expand">
                <button class="btn btn-primary text-nowrap" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMessage" aria-controls="offcanvasMessage">Σύνδεση</button>
              </div>
            </form>
          </div>
        </div>

      </div>

      <!-- OFF-CANVAS-ERROR-MESSAGE GOES HERE -->
      <div class="offcanvas offcanvas-bottom trvl-offcanvas" tabindex="-1" id="offcanvasMessage" aria-labelledby="offcanvasMessageLabel">
        <div class="offcanvas-header">
          <div class="offcanvas-title h5 mx-auto" id="offcanvasMessageLabel"><!-- ERROR MESSAGE GOES HERE --></div>
          <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Κλείσιμο"></button>
        </div>
      </div>
      <!-- OFF-CANVAS-ERROR-MESSAGE ENDS HERE -->
      <!-- Show error via JS examplestarts here -->
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
        document.addEventListener("DOMContentLoaded", function(event) {
          showOffcanvas("Το email ή το συνθηματικό είναι λάθος!");
        });
      </script>
      <!-- Control error via JS example ends here -->

    </div>
    <!-- end of main content -->

    <x-footer/>

  </body>
</html>

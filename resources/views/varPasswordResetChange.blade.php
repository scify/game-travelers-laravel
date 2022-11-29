<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Αλλαγή κωδικού | Ταξιδιώτες</title>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <!-- Scripts -->
    <script src="{{ mix('js/main.js') }}" defer></script>
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
  </head>
  <body>

    <!-- absolute middle relative containers -->
    <div class="trvl-middleflex--container">
      <div class="trvl-middleflex--contents">
        <!-- absolute middle relative containers -->

        <x-header/>

        <!-- main-content -->
        <div class="container-xxl ps-4 pe-4 trvl-main-content trvl-bg trvl-bg--flower-12 responsive-hide">
          <div class="row">

            <div class="col-md-3 order-md-2"><!-- empty --></div>

            <div class="col-md-9 order-md-1">
              <div class="trvl-form">
                <div class="p-4 mb-4">
                  <h1>Αλλαγή κωδικού</h1>
                  <p class="my-4">
                    Είναι απαραίτητο να επιλέξεις έναν νέο κωδικού.
                  </p>
                </div>
                <form>
                  <div class="p-4">
                    <label class="extended" for="password1">Νέο συνθηματικό</label>
                    <input class="extended" type="password" name="password1" tabindex="1" id="password1" />
                  </div>
                  <div class="p-4">
                    <label class="extended" for="password2">Επανάληψη νέου συνθηματικού</label>
                    <input class="extended" type="password" name="password2" tabindex="2" id="password2" />
                  </div>

                  <div class="actions p-4 text-center expand">
                    <button class="btn btn-lg btn-primary text-nowrap" tabindex="3" type="submit">Αλλαγή συνθηματικού</button>
                  </div>
                </form>
              </div>
            </div>

          </div>

          <!-- OFF-CANVAS-ERROR-MESSAGE GOES HERE -->

        </div>
        <!-- end of main content -->

        <x-footer/>

        <!-- absolute middle relative containers -->
      </div>
    </div>
    <!-- absolute middle relative containers -->

  </body>
</html>

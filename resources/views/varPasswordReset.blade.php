<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ανάκτηση κωδικού | Ταξιδιώτες</title>
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
                <h1>Ανάκτηση κωδικού</h1>
                <p class="my-4">
                    Αν δεν θυμάσαι τον κωδικό σου δεν έχεις παρά να
                    συμπληρώσεις το email σου και εμείς θα σου στείλουμε οδηγίες
                    για το πώς θα μπορέσεις να το αλλάξεις.
                </p>
                </div>
                <form>
                <div class="p-4">
                    <label class="extended" for="email">Email</label>
                    <input class="extended" type="email" name="email" tabindex="1" id="email" />
                </div>

                <div class="actions p-4 text-center expand">
                    <button class="btn btn-lg btn-primary text-nowrap" tabindex="2" type="submit">Ανάκτηση κωδικού</button>
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

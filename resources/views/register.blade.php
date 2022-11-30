<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Νέος χρήστης | Ταξιδιώτες</title>
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
        <div class="container-xxl ps-4 pe-4 trvl-main-content trvl-bg trvl-bg--group-1">
          <div class="row">

            <div class="col-md-3 order-md-2">
              <div class="ps-4 ps-md-0 pt-4">
                Είστε ήδη χρήστης; <a href="{{ url('/login') }}">Συνδεθείτε</a>
              </div>
            </div>

            <div class="col-md-9 order-md-1">
              <div class="trvl-form">
                <div class="p-4">
                  <h1>Νέος χρήστης</h1>
                </div>
                <form>
                  <div class="p-4">
                    <label class="extended" for="email">Email</label>
                    <input class="extended" type="email" name="email" tabindex="1" id="email" />
                  </div>
                  <div class="p-4">
                    <label class="extended" for="password1">Κωδικός</label>
                    <input class="extended" type="password" name="password1" tabindex="2" id="password1" />
                  </div>
                  <div class="p-4">
                    <label class="extended" for="password2">Επιβεβαίωση κωδικού</label>
                    <input class="extended" type="password" name="password2" tabindex="3" id="password2" />
                  </div>
                  <div class="actions p-4 text-center responsive-expand">
                    <button class="btn btn-lg btn-primary text-nowrap" type="submit" tabindex="4" id="doregister">Εγγραφή</button>
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

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <title>Login</title>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <!-- Scripts -->
    <script src="{{ mix('js/main.js') }}" defer></script>
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="{{ mix('css/fixedwh.css') }}" rel="stylesheet">
  </head>
  <body>
    <div class="trvl-container fixedwh">
      <div class="trvl-content">

        <header>
          <a href="{{ url('/') }}">
            <img src="{{ asset('images/logo.svg') }}" width="145" height="79" alt="Ταξιδιώτες" />
          </a>
          <small>fixed width & height edition</small>
        </header>

        <div class="trvl-main">
          <div class="trvl-center">
            <div class="trvl-form">
              <form>
                <div>
                  <label class="extended" for="email">Email</label>
                  <input class="extended" type="email" id="email" />
                </div>
                <div>
                  <label class="extended" for="password1">Συνθηματικό</label>
                  <input class="extended" type="password" name="password1" id="password1" />
                </div>
                <div>
                  <label class="extended" for="password2">Επανάληψη συνθηματικού</label>
                  <input class="extended" type="password" name="password2" id="password2" />
                </div>
                <div class="actions">
                  <button class="btn btn-primary text-nowrap">Εγγραφή</button>
                </div>
              </form>
            </div>
            <footer class="pt-5">
              <a href="#">
                <img src="{{ asset('images/scify.png') }}" width="105" height="53" alt="Created by SciFY" />
              </a>
            </footer>
          </div>
          <div class="trvl-side side-bg--12">
            <div class="p-2 pt-4">
              Είστε ήδη χρήστης; <a href="/login">Συνδεθείτε</a>
              <div class="flowers--14" role="decorative"></div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </body>
</html>

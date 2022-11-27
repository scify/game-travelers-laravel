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
    <!-- header -->
    <header class="container-xxl clearfix trvl-header p-4">
      <div class="logo float-start">
        <a href="{{ url('/') }}">
          <img src="{{ asset('images/logo.svg') }}" width="145" height="79" alt="Ταξιδιώτες" />
        </a>
      </div>
      <div class="user float-end">
        <!--[[-->User<!--]]-->
      </div>
    </header>
    <!-- end of header -->
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
                    <a href="#">Ξεχάσατε το συνθηματικό;</a>
                  </div>
                </div>
              </div>
              <div class="actions p-4 text-center expand">
                <button class="btn btn-primary text-nowrap" type="submit">Σύνδεση</button>
              </div>
            </form>
          </div>
        </div>

      </div>
      <!-- footer -->
      <div class="row">
        <footer class="container-xxl p-4 trvl-footer">
          <div class="scify float-start">
            <a href="http://www.scify.org/" target="_blank">
              <img src="{{ asset('images/scify.png') }}" width="105" height="53" alt="Created by SciFY" />
            </a>
          </div>
        </footer>
      </div>
      <!-- end of footer -->

    </div>
    <!-- end of main content -->
  </body>
</html>

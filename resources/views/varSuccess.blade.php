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
  <body class="trvl-middle">
<style type="text/css">
</style>


    <x-header/>

    <!-- main-content -->
    <div class="container-fluid ps-4 pe-4 trvl-main-content">
      <div class="col-md-12 order-md-1">
          <div class="trvl-middle">
          <div class="p-4 trvl-middle--content">
              <h1>Το νέο συνθηματικό αποθηκεύτηκε επιτυχώς!</h1>
              <img src="{{ asset('images/icon-checkmark.svg') }}" width="129" height="96" alt="check-mark" />
          </div>
          </div>
      </div>
    </div>
    <!-- end of main content -->

    <x-footer/>

  </body>
</html>

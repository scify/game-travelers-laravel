<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <title>Login</title>
    <!-- Scripts -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <script src="{{ mix('js/main.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
  </head>
  <body>
    <header class="m-5">
      <img src="{{ asset('images/logo.svg') }}" />
    </header>
    <div class="container-xxl">
      <h1>Καλώς ήλθατε!</h1>
      <h2>Κοπιάστε να εισέλθετε!</h2>
      <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium, adipisci, nemo voluptates ullam reprehenderit eum alias tempora iste numquam vitae, necessitatibus quis nisi! Sit ipsum assumenda commodi. Ut, dolores animi!
      </p>
    </div>
  </body>
</html>

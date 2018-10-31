<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom fonts for this template -->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
        <link href="vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

        <!-- Custom styles for this template -->
        <link href="css/landing-page.min.css" rel="stylesheet">


        <title>{{ config('app.name') }}</title>
    </head>
    <body class="bg-grey-lighter border-t-8 border-blue-light font-sans">
        <div id="app" class="container mx-auto">
            <h1 class="text-5xl my-8 font-bold">
                {{ config('app.name') }}
            </h1>
            <header class="masthead text-white text-center">
              <div class="overlay"></div>
              <div class="container">
                <div class="row">
                    @yield('content')
                </div>
              </div>
            </header>


        </div>

        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>

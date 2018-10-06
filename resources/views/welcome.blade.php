<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <title>{{ config('app.name') }}</title>
    </head>
    <body class="bg-grey-lighter border-t-8 border-blue-light font-sans">
        <div id="app" class="container mx-auto">
            <h1 class="text-5xl my-8 font-bold">
                {{ config('app.name') }}
            </h1>

            <form action="{{ route('url.store') }}" method="post">
                <input
                    type="text"
                    name="url"
                    class="input"
                    placeholder="http://your-url-here.com"
                >

                <button type="submit" class="btn btn-primary my-3">
                    Shorten URL
                </button>
            </form>
        </div>

        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>

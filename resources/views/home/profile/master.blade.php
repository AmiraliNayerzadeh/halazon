
    <!doctype html>
    <html lang="fa" dir="rtl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        {!! SEO::generate() !!}

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="/assets/home/plugins/fontawesome/all.css">
    </head>
    <body class="h-screen">

    @include('.home.layouts.just-header.header')

    <div class="container mx-auto">
        <div class="grid grid-cols-12">
            <div class="col-span-3">
                @include('.home.profile.sidebar')
            </div>

            <div class="col-span-12 sm:col-span-9 py-4">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="/assets/home/plugins/fontawesome/solid.min.js"></script>
    @include('sweetalert::alert')

    </body>
    </html>

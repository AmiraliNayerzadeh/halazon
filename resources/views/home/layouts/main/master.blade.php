<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="icon" type="image/png" href="/favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/favicon/favicon.svg" />
    <link rel="shortcut icon" href="/favicon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png" />
    <meta name="apple-mobile-web-app-title" content="Halazoon" />
    <link rel="manifest" href="/favicon/site.webmanifest" />



    {!! SEO::generate() !!}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="/assets/home/plugins/fontawesome/pro/v5-font-face.css">

    @yield('style')


</head>




<body class="bg-zinc-50 ">

    @include('.home.layouts.main.header')
        <section class="container sm:max-w-7xl mx-auto ">
            @yield('content')
        </section>

    @include('home.layouts.main.footer')

        <script>
            var toggleOpen = document.getElementById('toggleOpen');
            var toggleClose = document.getElementById('toggleClose');
            var collapseMenu = document.getElementById('collapseMenu');

            function handleClick() {
                if (collapseMenu.style.display === 'block') {
                    collapseMenu.style.display = 'none';
                } else {
                    collapseMenu.style.display = 'block';
                }
            }

            toggleOpen.addEventListener('click', handleClick);
            toggleClose.addEventListener('click', handleClick);
        </script>

    <script src="/assets/home/plugins/fontawesome/pro/all.js"></script>


    @yield('script')
    @include('sweetalert::alert')
</body>
</html>

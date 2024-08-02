<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {!! SEO::generate() !!}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="/assets/home/plugins/fontawesome/all.css">
</head>
<body class="bg-zinc-50 ">

@include('.home.layouts.main.header')
<section class="mx-auto">
    @yield('content')
</section>

<script src="/assets/home/plugins/fontawesome/solid.min.js"></script>
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
@include('sweetalert::alert')

</body>
</html>
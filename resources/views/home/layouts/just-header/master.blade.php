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

    @yield('content')



    <script>
        document.querySelectorAll('.num').forEach(input => {
            input.addEventListener('input', (e) => {
                e.target.value = e.target.value.replace(/[^0-9]/g, '');
            });
        });
    </script>

<script src="/assets/home/plugins/fontawesome/solid.min.js"></script>
    @include('sweetalert::alert')

    <script type="text/javascript">
        (function(c,l,a,r,i,t,y){
            c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
            t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
            y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
        })(window, document, "clarity", "script", "p4sxwefrf6");
    </script>

    <script>
        document.addEventListener("submit", function (event) {
            const submitButton = event.target.querySelector('button[type="submit"]');
            if (submitButton) {
                // تغییر متن دکمه
                submitButton.textContent = "صبر کنید...";
                // غیرفعال کردن دکمه برای جلوگیری از کلیک دوباره
                submitButton.disabled = true;
            }
        });
    </script>

</body>
</html>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="/assets/admin/img/apple-icon.png">
    <link rel="icon" type="image/png" href="/assets/admin/img/favicon.png">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    {!! SEO::generate() !!}


    <link href="/assets/admin/css/nucleo-icons.css" rel="stylesheet"/>
    <link href="/assets/admin/css/nucleo-svg.css" rel="stylesheet"/>

    {{--    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>--}}


    <link href="/assets/admin/css/nucleo-svg.css" rel="stylesheet"/>


    <link href="/assets/admin/css/nucleo-svg.css" rel="stylesheet"/>

    <link id="pagestyle" href="/assets/admin/css/soft-ui-dashboard.css" rel="stylesheet"/>

    <!-- CSS Files -->
    <link id="pagestyle" href="/assets/admin/plugin/JalaliDatePicker-main/dist/jalalidatepicker.min.css"
          rel="stylesheet"/>

    <link href="/assets/admin/plugin/select2/select2.css" rel="stylesheet"/>
    <link href="/assets/admin/plugin/select2/select2-bootstrap-5-theme.rtl.min.css" rel="stylesheet"/>


    <style>

        @font-face {
            font-family: iranyekan;
            font-style: normal;
            font-weight: bold;
            src: url('/assets/admin/fonts/iranYekan/eot/iranyekanwebboldfanum.eot');
            src: url('/assets/admin/fonts/iranYekan/eot/iranyekanwebboldfanum.eot?#iefix') format('embedded-opentype'), /* IE6-8 */ url('/assets/admin/fonts/iranYekan/woff/iranyekanwebboldfanum.woff') format('woff'), /* FF3.6+, IE9, Chrome6+, Saf5.1+*/ url('/assets/admin/fonts/iranYekan/ttf/iranyekanwebboldfanum.ttf') format('truetype');
        }


        @font-face {
            font-family: iranyekan;
            font-style: normal;
            font-weight: normal;
            src: url('/assets/admin/fonts/iranYekan/eot/iranyekanwebregularfanum.eot');
            src: url('/assets/admin/fonts/iranYekan/eot/iranyekanwebregularfanum.eot?#iefix') format('embedded-opentype'), /* IE6-8 */ url('/assets/admin/fonts/iranYekan/woff/iranyekanwebregularfanum.woff') format('woff'), /* FF3.6+, IE9, Chrome6+, Saf5.1+*/ url('/assets/admin/fonts/iranYekan/ttf/iranyekanwebregularfanum.ttf') format('truetype');
        }

        @font-face {
            font-family: iranyekan;
            font-style: normal;
            font-weight: 500;
            src: url('/assets/admin/fonts/iranYekan/eot/iranyekanwebmediumfanum.eot');
            src: url('/assets/admin/fonts/iranYekan/eot/iranyekanwebmediumfanum.eot?#iefix') format('embedded-opentype'), /* IE6-8 */ url('/assets/admin/fonts/iranYekan/woff/iranyekanwebmediumfanum.woff') format('woff'), /* FF3.6+, IE9, Chrome6+, Saf5.1+*/ url('/assets/admin/fonts/iranYekan/ttf/iranyekanwebmediumfanum.ttf') format('truetype');
        }

        body {
            font-family: 'iranyekan';
        }


    </style>


    <link rel="stylesheet" href="/assets/ckeditor/style.css">
    <link rel="stylesheet" href="/assets/ckeditor/ckeditor5/ckeditor5.css">


</head>
<body class="g-sidenav-show  rtl bg-gray-100">


@include('admin.layout.sidebar')


<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

    @include('admin.layout.header')


    <div class="container-fluid">
        <div class="row">
            @yield('content')
        </div>
        @include('admin.layout.footer')
    </div>


</main>

{{--<script src="/assets/admin/js/core/popper.min.js"></script>--}}
<script src="/assets/admin/js/core/bootstrap.min.js"></script>
<script src="/assets/admin/js/plugins/perfect-scrollbar.min.js"></script>
<script src="/assets/admin/js/plugins/smooth-scrollbar.min.js"></script>

<script src="/assets/admin/js/plugins/jkanban/jkanban.js"></script>
<script src="/assets/admin/js/plugins/chartjs.min.js"></script>
<script src="/assets/admin/js/plugins/threejs.js"></script>
<script src="/assets/admin/js/plugins/orbit-controls.js"></script>


<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>


<script src="/assets/home/plugins/fontawesome/pro/all.js"></script>


<script src="/assets/admin/js/plugins/fullcalendar.min.js"></script>


<script src="/assets/admin/js/jquery.js"></script>


{{--<script async defer src="https://buttons.github.io/buttons.js"></script>--}}

<script src="/assets/admin/js/soft-ui-dashboard.min.js?v=1.1.0"></script>


<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>


{{--<script src="/assets/admin/js/plugins/dropzone.min.js"></script>--}}

{{--<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>--}}
{{--<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css"/>--}}


<script src="/assets/admin/plugin/JalaliDatePicker-main/dist/jalalidatepicker.min.js"></script>
<script src="/assets/admin/plugin/select2/select2.min.js"></script>


@yield('script')


@include('sweetalert::alert')



@yield('script')


<script type="importmap">
    {
        "imports": {
            "ckeditor5": "/assets/ckeditor/ckeditor5/ckeditor5.js",
            "ckeditor5/": "/assets/ckeditor/ckeditor5/"
        }
    }
</script>

<script type="module" src="/assets/ckeditor/main.js"></script>


</body>
</html>
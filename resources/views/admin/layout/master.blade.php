<!--
=========================================================
* Soft UI Dashboard - v1.0.7
=========================================================

* Product Page: https://www.creative-tim.com/product/soft-ui-dashboard
* Copyright 2023 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="/assets/admin/img/apple-icon.png">
    <link rel="icon" type="image/png" href="/assets/admin/img/favicon.png">




    {!! SEO::generate() !!}

    <!-- Font Awesome Icons -->

    <link href="/assets/admin/plugin/FontAwesome/font-awesome.css" rel="stylesheet" />


    <!-- CSS Files -->
{{--    <link id="pagestyle" href="/assets/admin/css/soft-ui-dashboard.css?v=1.0.7" rel="stylesheet" />--}}
    <link id="pagestyle" href="/assets/admin/css/soft-ui-dashboard.min.css?v=1.1.0" rel="stylesheet"/>


    <!-- CSS Files -->
    <link id="pagestyle" href="/assets/admin/plugin/JalaliDatePicker-main/dist/jalalidatepicker.min.css" rel="stylesheet" />

    <link  href="/assets/admin/plugin/select2/select2.css" rel="stylesheet" />
    <link  href="/assets/admin/plugin/select2/select2-bootstrap-5-theme.rtl.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/42.0.2/ckeditor5.css" />



    <style>

        @font-face {
            font-family: iranyekan;
            font-style: normal;
            font-weight: bold;
            src: url('/assets/admin/fonts/iranYekan/eot/iranyekanwebboldfanum.eot');
            src: url('/assets/admin/fonts/iranYekan/eot/iranyekanwebboldfanum.eot?#iefix') format('embedded-opentype'),  /* IE6-8 */
            url('/assets/admin/fonts/iranYekan/woff/iranyekanwebboldfanum.woff') format('woff'),  /* FF3.6+, IE9, Chrome6+, Saf5.1+*/
            url('/assets/admin/fonts/iranYekan/ttf/iranyekanwebboldfanum.ttf') format('truetype');
        }



        @font-face {
            font-family: iranyekan;
            font-style: normal;
            font-weight: normal;
            src: url('/assets/admin/fonts/iranYekan/eot/iranyekanwebregularfanum.eot');
            src: url('/assets/admin/fonts/iranYekan/eot/iranyekanwebregularfanum.eot?#iefix') format('embedded-opentype'),  /* IE6-8 */
            url('/assets/admin/fonts/iranYekan/woff/iranyekanwebregularfanum.woff') format('woff'),  /* FF3.6+, IE9, Chrome6+, Saf5.1+*/
            url('/assets/admin/fonts/iranYekan/ttf/iranyekanwebregularfanum.ttf') format('truetype');
        }

        @font-face {
            font-family: iranyekan;
            font-style: normal;
            font-weight: 500;
            src: url('/assets/admin/fonts/iranYekan/eot/iranyekanwebmediumfanum.eot');
            src: url('/assets/admin/fonts/iranYekan/eot/iranyekanwebmediumfanum.eot?#iefix') format('embedded-opentype'),  /* IE6-8 */
            url('/assets/admin/fonts/iranYekan/woff/iranyekanwebmediumfanum.woff') format('woff'),  /* FF3.6+, IE9, Chrome6+, Saf5.1+*/
            url('/assets/admin/fonts/iranYekan/ttf/iranyekanwebmediumfanum.ttf') format('truetype');
        }

        body {
            font-family: 'iranyekan';
        }


    </style>



</head>

<body class="g-sidenav-show rtl bg-gray-100">

    @include('admin.layout.sidebar')
<main class="main-content  h-100 border-radius-lg overflow-x-hidden">

    <!-- Navbar -->
    @include('admin.layout.header')
    <!-- End Navbar -->


    <div class="container-fluid py-4">
        <div class="row">
            @yield('content')
        </div>
        @include('admin.layout.footer')
    </div>

</main>


<!--   Core JS Files   -->
{{--<script src="/assets/admin/js/core/popper.min.js"></script>--}}
<script src="/assets/admin/js/core/bootstrap.min.js"></script>


<script src="/assets/admin/js/plugins/fullcalendar.min.js"></script>


<script src="/assets/admin/js/jquery.js"></script>



<script src="/assets/admin/js/soft-ui-dashboard.min.js?v=1.0.7"></script>


{{--<script src="/assets/admin/js/plugins/dropzone.min.js"></script>--}}

    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />




<script src="/assets/admin/plugin/JalaliDatePicker-main/dist/jalalidatepicker.min.js"></script>
<script src="/assets/admin/plugin/select2/select2.min.js"></script>


<script src="/assets/admin/plugin/ckeditor/main.js"></script>

<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>


@yield('script')


@include('sweetalert::alert')

    <script type="importmap">
        {
            "imports": {
                "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/42.0.2/ckeditor5.js",
                "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/42.0.2/"
            }
        }
    </script>
    <script type="module">
        import {
            ClassicEditor,
            Essentials,
            Bold,
            Italic,
            Font,
            Paragraph,
            Alignment,
            Heading,
            Table ,
            TableToolbar ,
            Link ,
            AutoLink ,
            PasteFromOffice,
            List ,

        } from 'ckeditor5';

        ClassicEditor
            .create( document.querySelector( '#editor' ), {
                language: {
                    // The UI will be Arabic.
                    ui: 'fa',

                    // And the content will be edited in Arabic.
                    content: 'fa'
                },
                plugins: [ Essentials, Bold, Italic ,Link,AutoLink, Font, Paragraph , Alignment , Heading , Table , TableToolbar , PasteFromOffice , List ],
                fontFamily: {
                    options: [
                        'default',
                        'iranYekan, sans-serif',
                    ]
                },
                alignment: {
                    options: [ 'left', 'right' ]
                },
                toolbar: {
                    items: [
                        'undo', 'redo' ,'|', 'heading' , 'bulletedList' ,'numberedList' ,'|', 'bold', 'italic', 'link' ,'|' ,
                        'fontColor', 'fontBackgroundColor' , 'alignment' ,
                        'insertTable'
                    ]
                },
                table: {
                    contentToolbar: [
                        'toggleTableCaption'
                    ]
                },
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' } ,
                        { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' } ,
                        { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' } ,
                        { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' } ,
                    ]
                }
            } )
            .then( /* ... */ )
            .catch( /* ... */ );
    </script>





</body>

</html>
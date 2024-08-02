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


    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="/assets/admin/css/nucleo-icons.css" rel="stylesheet" />
    <link href="/assets/admin/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->

    <link href="/assets/admin/plugin/FontAwesome/font-awesome.css" rel="stylesheet" />



    <link href="/assets/admin/css/nucleo-svg.css" rel="stylesheet" />

    <!-- CSS Files -->
    <link id="pagestyle" href="/assets/admin/css/soft-ui-dashboard.css?v=1.0.7" rel="stylesheet" />

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
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg overflow-x-hidden">

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
<script src="/assets/admin/js/core/popper.min.js"></script>
<script src="/assets/admin/js/core/bootstrap.min.js"></script>

{{--<script src="/assets/admin/js/plugins/perfect-scrollbar.min.js"></script>--}}

{{--<script src="/assets/admin/js/plugins/smooth-scrollbar.min.js"></script>--}}

<script src="/assets/admin/js/plugins/fullcalendar.min.js"></script>
<script>
    var ctx = document.getElementById("chart-bars").getContext("2d");

    new Chart(ctx, {
        type: "bar",
        data: {
            labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: "Sales",
                tension: 0.4,
                borderWidth: 0,
                borderRadius: 4,
                borderSkipped: false,
                backgroundColor: "#fff",
                data: [450, 200, 100, 220, 500, 100, 400, 230, 500],
                maxBarThickness: 6
            }, ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                }
            },
            interaction: {
                intersect: false,
                mode: 'index',
            },
            scales: {
                y: {
                    grid: {
                        drawBorder: false,
                        display: false,
                        drawOnChartArea: false,
                        drawTicks: false,
                    },
                    ticks: {
                        suggestedMin: 0,
                        suggestedMax: 500,
                        beginAtZero: true,
                        padding: 15,
                        font: {
                            size: 14,
                            family: "Open Sans",
                            style: 'normal',
                            lineHeight: 2
                        },
                        color: "#fff"
                    },
                },
                x: {
                    grid: {
                        drawBorder: false,
                        display: false,
                        drawOnChartArea: false,
                        drawTicks: false
                    },
                    ticks: {
                        display: false
                    },
                },
            },
        },
    });


    var ctx2 = document.getElementById("chart-line").getContext("2d");

    var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

    var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

    gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
    gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

    new Chart(ctx2, {
        type: "line",
        data: {
            labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: "Mobile apps",
                tension: 0.4,
                borderWidth: 0,
                pointRadius: 0,
                borderColor: "#cb0c9f",
                borderWidth: 3,
                backgroundColor: gradientStroke1,
                fill: true,
                data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                maxBarThickness: 6

            },
                {
                    label: "Websites",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#3A416F",
                    borderWidth: 3,
                    backgroundColor: gradientStroke2,
                    fill: true,
                    data: [30, 90, 40, 140, 290, 290, 340, 230, 400],
                    maxBarThickness: 6
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                }
            },
            interaction: {
                intersect: false,
                mode: 'index',
            },
            scales: {
                y: {
                    grid: {
                        drawBorder: false,
                        display: true,
                        drawOnChartArea: true,
                        drawTicks: false,
                        borderDash: [5, 5]
                    },
                    ticks: {
                        display: true,
                        padding: 10,
                        color: '#b2b9bf',
                        font: {
                            size: 11,
                            family: "Open Sans",
                            style: 'normal',
                            lineHeight: 2
                        },
                    }
                },
                x: {
                    grid: {
                        drawBorder: false,
                        display: false,
                        drawOnChartArea: false,
                        drawTicks: false,
                        borderDash: [5, 5]
                    },
                    ticks: {
                        display: true,
                        color: '#b2b9bf',
                        padding: 20,
                        font: {
                            size: 11,
                            family: "Open Sans",
                            style: 'normal',
                            lineHeight: 2
                        },
                    }
                },
            },
        },
    });
</script>
<script src="/assets/admin/js/plugins/choices.min.js"></script>
<script src="/assets/admin/js/plugins/chartjs.min.js"></script>

<script src="/assets/admin/js/jquery.js"></script>


    <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>

<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>

<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="/assets/admin/js/soft-ui-dashboard.min.js?v=1.0.7"></script>




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
            Heading
        } from 'ckeditor5';

        ClassicEditor
            .create( document.querySelector( '#editor' ), {
                language: {
                    // The UI will be Arabic.
                    ui: 'fa',

                    // And the content will be edited in Arabic.
                    content: 'fa'
                },
                plugins: [ Essentials, Bold, Italic, Font, Paragraph , Alignment , Heading],
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
                        'undo', 'redo','|', 'heading' ,'|', 'bold', 'italic', '|',
                        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor' , 'alignment' ,
                    ]
                },
            } )
            .then( /* ... */ )
            .catch( /* ... */ );
    </script>


</body>

</html>
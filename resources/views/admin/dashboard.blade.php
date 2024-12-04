@component('.admin.layout.master')
    @section('content')
        <div class="row">
            <div class="col-lg-7 position-relative z-index-2">
                <div class="card card-plain mb-4">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="d-flex flex-column h-100">
                                    <h2 class="font-weight-bolder mb-0">داشبورد ادمین</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-5 col-sm-6">
                        <div class="card  mb-4">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm mb-0 text-capitalize font-weight-bold">تعداد همه کاربران</p>
                                            <h5 class="font-weight-bolder mb-0">
                                                {{count(\App\Models\User::all())}} نفر
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="col-4 ">
                                        <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md d-flex justify-content-center align-items-center">
                                            <i class="fa fa-users text-white text-lg opacity-10" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card ">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm mb-0 text-capitalize font-weight-bold">تعداد معلمین</p>
                                            <h5 class="font-weight-bolder mb-0">
                                                {{count(\App\Models\User::where('is_teacher',1)->get())}} نفر

                                            </h5>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md d-flex justify-content-center align-items-center">
                                            <i class="fa fa-house-chimney-user text-white text-lg opacity-10" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-sm-6 mt-sm-0 mt-4">
                        <div class="card  mb-4">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm mb-0 text-capitalize font-weight-bold">تعداد دوره ها</p>
                                            <h5 class="font-weight-bolder mb-0">
                                                {{count(\App\Models\Course::where('status' , 'منتشر شده')->get())}}

                                            </h5>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md d-flex justify-content-center align-items-center">
                                            <i class="fa fa-book text-white text-lg opacity-10" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card ">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm mb-0 text-capitalize font-weight-bold">تعداد درخواست ها</p>
                                            <h5 class="font-weight-bolder mb-0">
                                                {{count(\App\Models\Support::where('parent_id' , null)->get())}}
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                            <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12 col-lg-10">
                        <div class="card ">
                            <div class="card-header pb-0 p-3">
                                <div class="d-flex justify-content-between">
                                    <h6 class="mb-2">لیست آخرین درخواست ها (تیکت ها)</h6>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table align-items-center ">
                                    <tbody>
                                    @foreach(\App\Models\Support::latest()->where('parent_id' , null)->get() as $lastTicket)
                                    <tr>
                                        <td class="w-30">
                                            <div class="d-flex px-2 py-1 align-items-center">
                                                <div class="ms-4">
                                                    <h6 class="text-sm mb-0">
                                                        <a href="{{route('admin.users.show' , $lastTicket->user)}}">{{$lastTicket->user->name}} {{$lastTicket->user->family}}</a>
                                                    </h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="">
                                                <h6 class="text-sm mb-0">{{$lastTicket->title}}</h6>
                                            </div>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <div class="text-center">
                                                <h6 class="text-sm mb-0">{{$lastTicket->status_translated}}</h6>
                                            </div>
                                        </td>

                                        <td class="">
                                            <a class="btn btn-sm btn-outline-info" href="{{route('admin.supports.show' , $lastTicket)}}">مشاهده</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-5 mb-lg-0 mb-4">
                <div class="card z-index-2">
                    <div class="card-body p-3">
                        <div class="bg-gradient-dark border-radius-lg py-3 pe-1 mb-3">
                            @php
                            $lastBlog = \App\Models\Blog::latest()->first() ;
                            @endphp

                            <div class="row">
                                <h5 class="text-white m-4">آخرین مقاله</h5>
                                <div class="col-lg-4"><img class="img-fluid rounded" src="{{$lastBlog->image}}" alt="تصویر لود نشده است."></div>
                                <div class="col-lg-8">
                                    <div>
                                        <h6 class="text-white">{{$lastBlog->title}}</h6>
                                        <div>
                                            <span>نویسنده:</span>
                                            <span class="text-primary">{{$lastBlog->user->name}} {{$lastBlog->user->family}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h6 class="ms-2 mt-4 mb-0"> خلاصه گزارش ها </h6>
                        <div class="container border-radius-lg">
                            <div class="row">
                                <div class="col-3 py-3 ps-0">
                                    <div class="d-flex mb-2">
                                        <div class="icon icon-shape icon-xxs shadow border-radius-sm bg-gradient-primary text-center me-2 d-flex align-items-center justify-content-center">
                                            <i class="fa fa-book-reader text-white "></i>
                                        </div>
                                        <p class="text-xs mt-1 mb-0 font-weight-bold">مقاله ها</p>
                                    </div>
                                    <h4 class="font-weight-bolder">{{count(\App\Models\Blog::all())}} عدد</h4>

                                </div>
                                <div class="col-3 py-3 ps-0">
                                    <div class="d-flex mb-2">
                                        <div class="icon icon-shape icon-xxs shadow border-radius-sm bg-gradient-info text-center me-2 d-flex align-items-center justify-content-center">
                                            <i class="fa fa-chart-bar text-white"></i>
                                        </div>
                                        <p class="text-xs mt-1 mb-0 font-weight-bold">دیدگاه</p>
                                    </div>
                                    <h4 class="font-weight-bolder">{{count(\App\Models\Comment::all())}} نظر</h4>
                                </div>
                                <div class="col-3 py-3 ps-0">
                                    <div class="d-flex mb-2">
                                        <div class="icon icon-shape icon-xxs shadow border-radius-sm bg-gradient-warning text-center me-2 d-flex align-items-center justify-content-center">
                                            <i class="fa fa-basket-shopping text-white"></i>

                                        </div>
                                        <p class="text-xs mt-1 mb-0 font-weight-bold">سفارشات تکمیل</p>
                                    </div>
                                    <h4 class="font-weight-bolder">{{count(\App\Models\Order::where('status' , 'پرداخت شده')->get())}} سفارش </h4>
                                </div>
                                <div class="col-3 py-3 ps-0">
                                    <div class="d-flex mb-2">
                                        <div class="icon icon-shape icon-xxs shadow border-radius-sm bg-gradient-danger text-center me-2 d-flex align-items-center justify-content-center">
                                            <i class="fa fa-shopping-bag text-white"></i>
                                        </div>
                                        <p class="text-xs mt-1 mb-0 font-weight-bold">سبد های موجود</p>
                                    </div>
                                    <h4 class="font-weight-bolder">{{count(\App\Models\Cart::all())}} سبد کاربران</h4>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="card z-index-2">
                    <div class="card-header pb-0 p-3">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-2">آخرین پرداخت ها</h6>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center ">
                            <tbody>
                            @foreach(\App\Models\Payment::take(6)->get() as $lastPay)
{{--                                @dd($lastBlog)--}}
                                <tr>
                                    <td>
                                        <div class="">
                                            <small>شماره سفارش:</small>
                                            <h6 class="text-sm mb-0">#{{$lastPay->order_id}}</h6>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="">
                                            <small>مبلغ کلّ:</small>
                                            <h6 class="text-sm mb-0">{{number_format($lastPay->order->total)}} <small>تومان</small></h6>
                                        </div>
                                    </td>


                                    <td class="">
                                        <div class="d-flex px-2 py-1 align-items-center">
                                            <div class="ms-4">
                                                <small>کاربر:</small>
                                                <h6 class="text-sm mb-0">
                                                    <a href="{{route('admin.users.show' , $lastTicket->user)}}">{{$lastPay->user->name}} {{$lastPay->user->family}}</a>
                                                </h6>
                                            </div>
                                        </div>
                                    </td>


                                    <td>
                                        <div class="">
                                            <small>وضعیت:</small>
                                            <h6 class="text-sm mb-0">{{$lastPay->order->status}}</h6>
                                        </div>
                                    </td>




                                    <td class="">
                                        <a class="btn btn-sm btn-outline-info" href="{{route('admin.orders.show' , $lastPay)}}">مشاهده سفارش</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div id="globe" class="position-absolute start-0 top-10 mt-sm-3 mt-7 me-lg-7">
                    <canvas width="700" height="600"
                            class="w-lg-100 h-lg-100 w-75 h-75 me-lg-0 me-n10 mt-lg-5"></canvas>
                </div>
            </div>
        </div>

            @section('script')
                <script>
                    (function () {
                        const container = document.getElementById("globe");
                        const canvas = container.getElementsByTagName("canvas")[0];

                        const globeRadius = 100;
                        const globeWidth = 4098 / 2;
                        const globeHeight = 1968 / 2;

                        function convertFlatCoordsToSphereCoords(x, y) {
                            let latitude = ((x - globeWidth) / globeWidth) * -180;
                            let longitude = ((y - globeHeight) / globeHeight) * -90;
                            latitude = (latitude * Math.PI) / 180;
                            longitude = (longitude * Math.PI) / 180;
                            const radius = Math.cos(longitude) * globeRadius;

                            return {
                                x: Math.cos(latitude) * radius,
                                y: Math.sin(longitude) * globeRadius,
                                z: Math.sin(latitude) * radius
                            };
                        }

                        function makeMagic(points) {
                            const {
                                width,
                                height
                            } = container.getBoundingClientRect();

                            // 1. Setup scene
                            const scene = new THREE.Scene();
                            // 2. Setup camera
                            const camera = new THREE.PerspectiveCamera(45, width / height);
                            // 3. Setup renderer
                            const renderer = new THREE.WebGLRenderer({
                                canvas,
                                antialias: true
                            });
                            renderer.setSize(width, height);
                            // 4. Add points to canvas
                            // - Single geometry to contain all points.
                            const mergedGeometry = new THREE.Geometry();
                            // - Material that the dots will be made of.
                            const pointGeometry = new THREE.SphereGeometry(0.5, 1, 1);
                            const pointMaterial = new THREE.MeshBasicMaterial({
                                color: "#989db5",
                            });

                            for (let point of points) {
                                const {
                                    x,
                                    y,
                                    z
                                } = convertFlatCoordsToSphereCoords(
                                    point.x,
                                    point.y,
                                    width,
                                    height
                                );

                                if (x && y && z) {
                                    pointGeometry.translate(x, y, z);
                                    mergedGeometry.merge(pointGeometry);
                                    pointGeometry.translate(-x, -y, -z);
                                }
                            }

                            const globeShape = new THREE.Mesh(mergedGeometry, pointMaterial);
                            scene.add(globeShape);

                            container.classList.add("peekaboo");

                            // Setup orbital controls
                            camera.orbitControls = new THREE.OrbitControls(camera, canvas);
                            camera.orbitControls.enableKeys = false;
                            camera.orbitControls.enablePan = false;
                            camera.orbitControls.enableZoom = false;
                            camera.orbitControls.enableDamping = false;
                            camera.orbitControls.enableRotate = true;
                            camera.orbitControls.autoRotate = true;
                            camera.position.z = -265;

                            function animate() {
                                // orbitControls.autoRotate is enabled so orbitControls.update
                                // must be called inside animation loop.
                                camera.orbitControls.update();
                                requestAnimationFrame(animate);
                                renderer.render(scene, camera);
                            }

                            animate();
                        }

                        function hasWebGL() {
                            const gl =
                                canvas.getContext("webgl") || canvas.getContext("experimental-webgl");
                            if (gl && gl instanceof WebGLRenderingContext) {
                                return true;
                            } else {
                                return false;
                            }
                        }

                        function init() {
                            if (hasWebGL()) {
                                window
                                window.fetch("https://raw.githubusercontent.com/creativetimofficial/public-assets/master/soft-ui-dashboard-pro/assets/js/points.json")
                                    .then(response => response.json())
                                    .then(data => {
                                        makeMagic(data.points);
                                    });
                            }
                        }

                        init();
                    })();

                </script>
            @endsection

    @endsection
@endcomponent
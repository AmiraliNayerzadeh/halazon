@extends('home.layouts.main.master')

@section('content')


    <div class="container mx-auto my-8">
        <h1 class="text-3xl font-extrabold text-gray-800 ">
            <li class="fa fa-cart-shopping mx-1"></li>
            سبد خرید
        </h1>
    </div>


    <div class=" container bg-[#e9e5ef] mx-auto shadow  p-4 rounded-3xl my-3">
        <div class="grid md:grid-cols-3 gap-8 mt-16">
            <div class="md:col-span-2 space-y-4">
                <div class="grid grid-cols-3 items-start gap-4">
                    <div class="col-span-2 flex items-start gap-4">
                        <div class="w-28 h-28 max-sm:w-24 max-sm:h-24 shrink-0 bg-gray-100 p-2 rounded-md">
                            <img src='https://readymadeui.com/images/product14.webp' class="w-full h-full object-contain" />
                        </div>

                        <div class="flex flex-col">
                            <h3 class="text-base font-extrabold text-gray-800">Velvet Sneaker</h3>
                            <p class="text-xs font-semibold text-gray-500 mt-0.5">Size: MD</p>

                            <button type="button" class="mt-6 font-semibold text-red-500 text-xs flex items-center gap-1 shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 fill-current inline" viewBox="0 0 24 24">
                                    <path d="M19 7a1 1 0 0 0-1 1v11.191A1.92 1.92 0 0 1 15.99 21H8.01A1.92 1.92 0 0 1 6 19.191V8a1 1 0 0 0-2 0v11.191A3.918 3.918 0 0 0 8.01 23h7.98A3.918 3.918 0 0 0 20 19.191V8a1 1 0 0 0-1-1Zm1-3h-4V2a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v2H4a1 1 0 0 0 0 2h16a1 1 0 0 0 0-2ZM10 4V3h4v1Z" data-original="#000000"></path>
                                    <path d="M11 17v-7a1 1 0 0 0-2 0v7a1 1 0 0 0 2 0Zm4 0v-7a1 1 0 0 0-2 0v7a1 1 0 0 0 2 0Z" data-original="#000000"></path>
                                </svg>
                                REMOVE
                            </button>
                        </div>
                    </div>

                    <div class="ml-auto">
                        <h4 class="text-lg max-sm:text-base font-extrabold text-gray-800">$20.00</h4>

                        <button type="button"
                                class="mt-6 flex items-center px-3 py-1.5 border border-gray-300 text-gray-800 text-xs outline-none bg-transparent rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-2.5 fill-current" viewBox="0 0 124 124">
                                <path d="M112 50H12C5.4 50 0 55.4 0 62s5.4 12 12 12h100c6.6 0 12-5.4 12-12s-5.4-12-12-12z" data-original="#000000"></path>
                            </svg>

                            <span class="mx-3 font-extrabold">2</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-2.5 fill-current" viewBox="0 0 42 42">
                                <path d="M37.059 16H26V4.941C26 2.224 23.718 0 21 0s-5 2.224-5 4.941V16H4.941C2.224 16 0 18.282 0 21s2.224 5 4.941 5H16v11.059C16 39.776 18.282 42 21 42s5-2.224 5-4.941V26h11.059C39.776 26 42 23.718 42 21s-2.224-5-4.941-5z" data-original="#000000"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <hr class="border-gray-300" />

                <div class="grid grid-cols-3 items-start gap-4">
                    <div class="col-span-2 flex items-start gap-4">
                        <div class="w-28 h-28 max-sm:w-24 max-sm:h-24 shrink-0 bg-gray-100 p-2 rounded-md">
                            <img src='https://readymadeui.com/images/watch5.webp' class="w-full h-full object-contain" />
                        </div>

                        <div class="flex flex-col">
                            <h3 class="text-base font-extrabold text-gray-800">Smart Watch Timex</h3>
                            <p class="text-xs font-semibold text-gray-500 mt-0.5">Size: SM</p>

                            <button type="button" class="mt-6 font-semibold text-red-500 text-xs flex items-center gap-1 shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 fill-current inline" viewBox="0 0 24 24">
                                    <path d="M19 7a1 1 0 0 0-1 1v11.191A1.92 1.92 0 0 1 15.99 21H8.01A1.92 1.92 0 0 1 6 19.191V8a1 1 0 0 0-2 0v11.191A3.918 3.918 0 0 0 8.01 23h7.98A3.918 3.918 0 0 0 20 19.191V8a1 1 0 0 0-1-1Zm1-3h-4V2a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v2H4a1 1 0 0 0 0 2h16a1 1 0 0 0 0-2ZM10 4V3h4v1Z" data-original="#000000"></path>
                                    <path d="M11 17v-7a1 1 0 0 0-2 0v7a1 1 0 0 0 2 0Zm4 0v-7a1 1 0 0 0-2 0v7a1 1 0 0 0 2 0Z" data-original="#000000"></path>
                                </svg>
                                REMOVE
                            </button>
                        </div>
                    </div>

                    <div class="ml-auto">
                        <h4 class="text-lg max-sm:text-base font-extrabold text-gray-800">$60.00</h4>

                        <button type="button"
                                class="mt-6 flex items-center px-3 py-1.5 border border-gray-300 text-gray-800 text-xs outline-none bg-transparent rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-2.5 fill-current" viewBox="0 0 124 124">
                                <path d="M112 50H12C5.4 50 0 55.4 0 62s5.4 12 12 12h100c6.6 0 12-5.4 12-12s-5.4-12-12-12z" data-original="#000000"></path>
                            </svg>

                            <span class="mx-3 font-extrabold">1</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-2.5 fill-current" viewBox="0 0 42 42">
                                <path d="M37.059 16H26V4.941C26 2.224 23.718 0 21 0s-5 2.224-5 4.941V16H4.941C2.224 16 0 18.282 0 21s2.224 5 4.941 5H16v11.059C16 39.776 18.282 42 21 42s5-2.224 5-4.941V26h11.059C39.776 26 42 23.718 42 21s-2.224-5-4.941-5z" data-original="#000000"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <hr class="border-gray-300" />

                <div class="grid grid-cols-3 items-start gap-4">
                    <div class="col-span-2 flex items-start gap-4">
                        <div class="w-28 h-28 max-sm:w-24 max-sm:h-24 shrink-0 bg-gray-100 p-2 rounded-md">
                            <img src='https://readymadeui.com/images/watch4.webp' class="w-full h-full object-contain" />
                        </div>

                        <div class="flex flex-col">
                            <h3 class="text-base font-extrabold text-gray-800">French Connection</h3>
                            <p class="text-xs font-semibold text-gray-500 mt-0.5">Size: LG</p>

                            <button type="button" class="mt-6 font-semibold text-red-500 text-xs flex items-center gap-1 shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 fill-current inline" viewBox="0 0 24 24">
                                    <path d="M19 7a1 1 0 0 0-1 1v11.191A1.92 1.92 0 0 1 15.99 21H8.01A1.92 1.92 0 0 1 6 19.191V8a1 1 0 0 0-2 0v11.191A3.918 3.918 0 0 0 8.01 23h7.98A3.918 3.918 0 0 0 20 19.191V8a1 1 0 0 0-1-1Zm1-3h-4V2a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v2H4a1 1 0 0 0 0 2h16a1 1 0 0 0 0-2ZM10 4V3h4v1Z" data-original="#000000"></path>
                                    <path d="M11 17v-7a1 1 0 0 0-2 0v7a1 1 0 0 0 2 0Zm4 0v-7a1 1 0 0 0-2 0v7a1 1 0 0 0 2 0Z" data-original="#000000"></path>
                                </svg>
                                REMOVE
                            </button>
                        </div>
                    </div>

                    <div class="ml-auto">
                        <h4 class="text-lg max-sm:text-base font-extrabold text-gray-800">$40.00</h4>

                        <button type="button"
                                class="mt-6 flex items-center px-3 py-1.5 border border-gray-300 text-gray-800 text-xs outline-none bg-transparent rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-2.5 fill-current" viewBox="0 0 124 124">
                                <path d="M112 50H12C5.4 50 0 55.4 0 62s5.4 12 12 12h100c6.6 0 12-5.4 12-12s-5.4-12-12-12z" data-original="#000000"></path>
                            </svg>

                            <span class="mx-3 font-extrabold">1</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-2.5 fill-current" viewBox="0 0 42 42">
                                <path d="M37.059 16H26V4.941C26 2.224 23.718 0 21 0s-5 2.224-5 4.941V16H4.941C2.224 16 0 18.282 0 21s2.224 5 4.941 5H16v11.059C16 39.776 18.282 42 21 42s5-2.224 5-4.941V26h11.059C39.776 26 42 23.718 42 21s-2.224-5-4.941-5z" data-original="#000000"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <hr class="border-gray-300" />

                <div class="grid grid-cols-3 items-start gap-4">
                    <div class="col-span-2 flex items-start gap-4">
                        <div class="w-28 h-28 max-sm:w-24 max-sm:h-24 shrink-0 bg-gray-100 p-2 rounded-md">
                            <img src='https://readymadeui.com/images/watch7.webp' class="w-full h-full object-contain" />
                        </div>

                        <div class="flex flex-col">
                            <h3 class="text-base font-extrabold text-gray-800">Smart Watch</h3>
                            <p class="text-xs font-semibold text-gray-500 mt-0.5">Size: LG</p>

                            <button type="button" class="mt-6 font-semibold text-red-500 text-xs flex items-center gap-1 shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 fill-current inline" viewBox="0 0 24 24">
                                    <path d="M19 7a1 1 0 0 0-1 1v11.191A1.92 1.92 0 0 1 15.99 21H8.01A1.92 1.92 0 0 1 6 19.191V8a1 1 0 0 0-2 0v11.191A3.918 3.918 0 0 0 8.01 23h7.98A3.918 3.918 0 0 0 20 19.191V8a1 1 0 0 0-1-1Zm1-3h-4V2a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v2H4a1 1 0 0 0 0 2h16a1 1 0 0 0 0-2ZM10 4V3h4v1Z" data-original="#000000"></path>
                                    <path d="M11 17v-7a1 1 0 0 0-2 0v7a1 1 0 0 0 2 0Zm4 0v-7a1 1 0 0 0-2 0v7a1 1 0 0 0 2 0Z" data-original="#000000"></path>
                                </svg>
                                REMOVE
                            </button>
                        </div>
                    </div>

                    <div class="ml-auto">
                        <h4 class="text-lg max-sm:text-base font-extrabold text-gray-800">$60.00</h4>

                        <button type="button"
                                class="mt-6 flex items-center px-3 py-1.5 border border-gray-300 text-gray-800 text-xs outline-none bg-transparent rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-2.5 fill-current" viewBox="0 0 124 124">
                                <path d="M112 50H12C5.4 50 0 55.4 0 62s5.4 12 12 12h100c6.6 0 12-5.4 12-12s-5.4-12-12-12z" data-original="#000000"></path>
                            </svg>

                            <span class="mx-3 font-extrabold">1</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-2.5 fill-current" viewBox="0 0 42 42">
                                <path d="M37.059 16H26V4.941C26 2.224 23.718 0 21 0s-5 2.224-5 4.941V16H4.941C2.224 16 0 18.282 0 21s2.224 5 4.941 5H16v11.059C16 39.776 18.282 42 21 42s5-2.224 5-4.941V26h11.059C39.776 26 42 23.718 42 21s-2.224-5-4.941-5z" data-original="#000000"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>


            <div class="bg-white rounded-2xl shadow p-4 h-max">
                <h3 class="text-lg max-sm:text-base font-extrabold text-gray-800 border-b border-gray-300 pb-2">خلاصه سفارش</h3>

                <form class="mt-6">
                    <div>
                        <h3 class="text-base text-gray-800  font-semibold ">اطلاعات کاربری:</h3>
                        <h4 class="my-2 text-red-500 text-sm">جهت تکمیل سفارش باید اطلاعات کاربری خود را ثبت کنید.</h4>

                        <div class="grid grid-cols-6 ">

                            <div class="col-span-3 mb-2 ml-1 ">
                                    <input name="name" value="{{old('name')}}" type="text" placeholder="نام" class=" text-gray-800 rounded-md w-full " />
                            </div>

                            <div class="col-span-3 mb-2 mr-1 ">
                                <input name="family" value="{{old('family')}}" type="text" placeholder="نام خانوداگی" class=" text-gray-800 rounded-md w-full " />
                            </div>

                            <div class="col-span-3 mb-2 ml-1">
                                <select name="gender" id="gender" class="text-gray-800 rounded-md w-full">
                                    <option>جنسیت</option>
                                    <option value="male">آقا</option>
                                    <option value="female">خانم</option>
                                </select>
                            </div>

                            <div class="col-span-3 mb-2 mr-1 ">
                                <input autocomplete="off" data-jdp class="text-gray-800 rounded-md w-full" type="text" name="birthday"
                                       value="{{old('birthday')}}"
                                       placeholder="تاریخ تولد را انتخاب کنید">
                            </div>






                        </div>

                    </div>
                </form>

                <ul class="text-gray-800 mt-6 space-y-3">
                    <li class="flex flex-wrap gap-4 text-sm">هزینه دوره ها: <span class="ml-auto font-extrabold">$200.00</span></li>
                    <li class="flex flex-wrap gap-4 text-sm">مجموع تخفیف ها:<span class="ml-auto font-extrabold">$2.00</span></li>
                    <hr class="border-gray-300" />
                    <li class="flex flex-wrap gap-4 text-sm font-extrabold">جمع کلّ: <span class="ml-auto">$206.00</span></li>
                </ul>

                <div class="mt-6 space-y-3">
                    <button type="button" class="text-sm px-4 py-4 w-full bg-main font-extrabold text-white rounded-2xl">پرداخت و شروع دوره ها</button>
                    <button type="button" class="text-sm px-4 py-2 w-full  bg-transparent text-gray-800 border border-gray-300 rounded-2xl">ادامه خرید</button>

                    <p class="text-center">
                        پرداخت و ثبت سفارش، به منزله مطالعه و پذیرفتن
                        <a class="text-main underline font-extrabold" href="{{route('terms')}}">قوانین و مقررات</a>
                        استفاده از خدمات حلزون است.
                    </p>

                </div>
            </div>
        </div>
    </div>


    @section('script')
        <link id="pagestyle" href="/assets/admin/plugin/JalaliDatePicker-main/dist/jalalidatepicker.min.css"
              rel="stylesheet"/>
        <script src="/assets/admin/plugin/JalaliDatePicker-main/dist/jalalidatepicker.min.js"></script>

        <script>
            jalaliDatepicker.startWatch();
        </script>
    @endsection


@endsection
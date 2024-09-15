@extends('home.layouts.main.master')

@section('content')

    <div class="container mx-auto my-8">
        <h1 class="text-3xl font-extrabold text-gray-800 ">
            <li class="fa fa-cart-shopping mx-1"></li>
            سبد خرید
        </h1>
    </div>


    <div class=" container bg-[#e9e5ef] mx-auto shadow  p-4 rounded-3xl my-3">
        @if($cart)
            <div class="grid md:grid-cols-3 gap-8 ">
                <div class="md:col-span-2 space-y-4 bg-white p-3 rounded-3xl">

                    <h5 class="text-lg text-main font-extrabold my-3">
                        تعداد آیتم ها
                        ({{count($cart->items)}})
                    </h5>

                    @foreach($cart->items as $item)
                        <div class="grid grid-cols-3 gap-4">
                            <div class="col-span-2 flex  gap-4 items-center">

                                <div class=" h-28 max-sm:w-24 max-sm:h-24 shrink-0 bg-gray-100 p-2 rounded-md">
                                    <img src='{{$item->course->image}}' alt="{{$item->course->title}}"
                                         class="w-full h-full object-contain"/>
                                </div>

                                <div class=" flex flex-col items-center">
                                    <a href="{{route('course.show',$item->course )}}">
                                        <h3 class="text-base font-extrabold text-gray-800 hover:text-main50 duration-500">{{$item->course->title}}</h3>
                                    </a>
                                    @if($item->part)
                                        <p class="text-xs font-semibold text-gray-500 mt-0.5">
                                            ({{$item->part->title}})
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <div class="col-span-1 flex items-center gap-4 items-center">
                                <div class="ml-auto">
                                    <div class="flex flex-col items-center h-full">
                                            @if($item->course->discount_price == 0 || is_null($item->course->discount_price))
                                            <b class="text-lg">{{number_format($item->course->price )}} تومان </b>
                                            @else
                                                    <small class="line-through decoration-red-600 "> {{number_format($item->course->price)}}تومان </small>
                                                    <b class="text-lg">{{number_format($item->course->price - $item->course->discount_price )}} تومان </b>
                                            @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="border-gray-300"/>

                    @endforeach

                </div>


                <div class="bg-white rounded-2xl shadow p-4 h-max">
                    <h3 class="text-lg max-sm:text-base font-extrabold text-gray-800 border-b border-gray-300 pb-2">
                        خلاصه
                        سفارش</h3>

                    <form class="mt-6">
                        <div>
                            <h3 class="text-base text-gray-800  font-semibold ">اطلاعات کاربری:</h3>
                            <h4 class="my-2 text-red-500 text-sm">جهت تکمیل سفارش باید اطلاعات کاربری خود را ثبت
                                کنید.</h4>

                            <div class="grid grid-cols-6 ">

                                <div class="col-span-3 mb-2 ml-1 ">
                                    <input name="name" value="{{old('name')}}" type="text" placeholder="نام"
                                           class=" text-gray-800 rounded-md w-full "/>
                                </div>

                                <div class="col-span-3 mb-2 mr-1 ">
                                    <input name="family" value="{{old('family')}}" type="text"
                                           placeholder="نام خانوداگی"
                                           class=" text-gray-800 rounded-md w-full "/>
                                </div>

                                <div class="col-span-3 mb-2 ml-1">
                                    <select name="gender" id="gender" class="text-gray-800 rounded-md w-full">
                                        <option>جنسیت</option>
                                        <option value="male">آقا</option>
                                        <option value="female">خانم</option>
                                    </select>
                                </div>

                                <div class="col-span-3 mb-2 mr-1 ">
                                    <input autocomplete="off" data-jdp class="text-gray-800 rounded-md w-full"
                                           type="text"
                                           name="birthday"
                                           value="{{old('birthday')}}"
                                           placeholder="تاریخ تولد را انتخاب کنید">
                                </div>


                            </div>

                        </div>
                    </form>

                    <ul class="text-gray-800 mt-6 space-y-3">
                        <li class="flex flex-wrap gap-4">هزینه دوره ها: <span class="ml-auto font-extrabold">{{number_format($pureTotalPrice)}} تومان </span></li>
                        <li class="flex flex-wrap gap-4 ">مجموع تخفیف ها:<span class="ml-auto font-extrabold">{{number_format($pureTotalDiscount)}} تومان </span></li>
                        <hr class="border-gray-300"/>

                        <li class="flex flex-wrap gap-4 text-lg text-primary font-extrabold">جمع کلّ: <span class="ml-auto">{{number_format($totalPrice)}} تومان </span></li>
                    </ul>

                    <div class="mt-6 space-y-3">
                        <button type="button"
                                class="text-sm px-4 py-4 w-full bg-main font-extrabold text-white rounded-2xl">پرداخت و
                            شروع
                            دوره ها
                        </button>
                        <button type="button"
                                class="text-sm px-4 py-2 w-full  bg-transparent text-gray-800 border border-gray-300 rounded-2xl">
                            ادامه خرید
                        </button>

                        <p class="text-center">
                            پرداخت و ثبت سفارش، به منزله مطالعه و پذیرفتن
                            <a class="text-main underline font-extrabold" href="{{route('terms')}}">قوانین و مقررات</a>
                            استفاده از خدمات حلزون است.
                        </p>

                    </div>
                </div>
            </div>

        @else
            <h3 class="text-center text-2xl">هنوز دوره ای را به سبد خرید خود اضافه نکرده اید... .</h3>
        @endif
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
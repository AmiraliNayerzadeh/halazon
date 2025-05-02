@extends('home.layouts.main.master')

@section('content')

    <div class="container mx-auto my-4 sm:my-8 px-2">
        <h1 class="text-xl sm:text-3xl font-extrabold text-gray-800">
            <li class="fa fa-cart-shopping mx-1"></li>
            سبد خرید
        </h1>
    </div>

    <div class="container bg-[#e9e5ef] mx-auto shadow p-2 sm:p-4 rounded-2xl sm:rounded-3xl my-3">
        @if($cart)
            <div class="grid md:grid-cols-3 gap-4 sm:gap-8">
                <div class="md:col-span-2 space-y-4 bg-white p-2 sm:p-3 rounded-2xl sm:rounded-3xl">

                    <h5 class="text-base sm:text-lg text-main font-extrabold my-2 sm:my-3">
                        تعداد آیتم ها
                        ({{count($cart->items)}})
                    </h5>

                    @foreach($cart->items as $item)
                        <div class="grid grid-cols-3 gap-2 sm:gap-4">
                            <div class="col-span-2 flex gap-2 sm:gap-4 items-center">

                                <form action="{{route('cart.destroy' , $item)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="course" value="{{$item->course->id}}">
                                    <button class="text-red-600 text-sm sm:text-base" type="submit" title="حذف از سبد خرید">
                                        <i class="fa fa-close"></i>
                                    </button>
                                </form>

                                <div class="h-10 sm:h-20 w-10 sm:w-20 shrink-0 bg-gray-100 p-1 sm:p-2 rounded-md">
                                    <img src='{{$item->course->image}}' alt="{{$item->course->title}}"
                                         class="w-full h-full object-contain"/>
                                </div>

                                <div class="flex flex-col items-start sm:items-center">
                                    <a href="{{route('course.show',$item->course )}}">
                                        <h3 class="text-xs sm:text-base text-gray-800 hover:text-main50 duration-500 line-clamp-2">
                                            {{$item->course->title}}
                                        </h3>
                                    </a>
                                    @if($item->part)
                                        <p class="text-xs font-semibold text-gray-500 mt-0.5">
                                            ({{$item->part->title}})
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <div class="col-span-1 flex items-center justify-end">
                                <div class="flex flex-col items-end sm:items-center">
                                    @if($item->course->discount_price == 0 || is_null($item->course->discount_price))
                                        <b class="text-xs sm:text-lg">{{number_format($item->course->price )}}
                                            تومان </b>
                                    @else
                                        <small class="line-through decoration-red-600 text-xs sm:text-sm">
                                            {{number_format($item->course->price)}}
                                            تومان
                                        </small>
                                        <b class="text-xs sm:text-lg">{{number_format($item->course->price - $item->course->discount_price )}}
                                            تومان </b>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <hr class="border-gray-300 my-2 sm:my-3"/>

                    @endforeach

                </div>

                <div class="bg-white rounded-xl sm:rounded-2xl shadow p-3 sm:p-4 h-max">
                    <h3 class="text-base sm:text-lg font-extrabold text-gray-800 border-b border-gray-300 pb-2">
                        خلاصه سفارش
                    </h3>
                    <form action="{{route('order.store' , $cart)}}" method="post" class="mt-4 sm:mt-6">
                        @method('POST')
                        @csrf
                        @if(is_null(auth()->user()->name) || is_null(auth()->user()->family))
                            <div>
                                <h3 class="text-sm sm:text-base text-gray-800 font-semibold">اطلاعات کاربری:</h3>
                                <h4 class="my-1 sm:my-2 text-red-500 text-xs sm:text-sm">جهت تکمیل سفارش باید اطلاعات کاربری خود را ثبت کنید.</h4>

                                <div class="grid grid-cols-6 gap-1 sm:gap-2">

                                    <div class="col-span-3 mb-1 sm:mb-2 ml-1">
                                        <input required name="name"
                                               value="{{!is_null(auth()->user()->name) ? auth()->user()->name : old('name')}}"
                                               type="text" placeholder="نام"
                                               class="text-sm sm:text-base text-gray-800 rounded-md w-full p-1 sm:p-2 border"/>
                                    </div>

                                    <div class="col-span-3 mb-1 sm:mb-2 mr-1">
                                        <input required name="family"
                                               value="{{!is_null(auth()->user()->family) ? auth()->user()->family : old('family')}}"
                                               type="text"
                                               placeholder="نام خانوادگی"
                                               class="text-sm sm:text-base text-gray-800 rounded-md w-full p-1 sm:p-2 border"/>
                                    </div>

                                    <div class="col-span-3 mb-1 sm:mb-2 ml-1">
                                        <select required="required" name="gender" id="gender"
                                                class="text-sm sm:text-base text-gray-800 rounded-md w-full p-1 sm:p-2 border">
                                            <option>جنسیت</option>
                                            <option {{auth()->user()->gender == "male" ? 'selected' : ''}} value="male">
                                                آقا
                                            </option>
                                            <option {{auth()->user()->gender == "female" ? 'selected' : ''}} value="female">
                                                خانم
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col-span-3 mb-1 sm:mb-2 mr-1">
                                        <input required autocomplete="off" data-jdp
                                               class="text-sm sm:text-base text-gray-800 rounded-md w-full p-1 sm:p-2 border"
                                               type="text" name="birthday"
                                               value="{{!is_null(auth()->user()->birthday) ? str_replace('-', '/', jdate(auth()->user()->birthday)->toDateString()) : old('birthday')}}"
                                               placeholder="تاریخ تولد">
                                    </div>
                                </div>
                            </div>
                        @endif

                        <ul class="text-gray-800 mt-4 sm:mt-6 space-y-2 sm:space-y-3">
                            <li class="flex flex-wrap gap-4 text-sm sm:text-base">
                                هزینه دوره ها:
                                <span class="ml-auto font-extrabold">{{number_format($pureTotalPrice)}} تومان</span>
                            </li>
                            <li class="flex flex-wrap gap-4 text-sm sm:text-base">
                                مجموع تخفیف ها:
                                <span class="ml-auto font-extrabold">{{number_format($pureTotalDiscount)}} تومان</span>
                            </li>
                            <hr class="border-gray-300"/>

                            <li class="flex flex-wrap gap-4 text-base sm:text-lg text-primary font-extrabold">
                                جمع کلّ:
                                <span class="ml-auto">{{number_format($totalPrice)}} تومان</span>
                            </li>
                        </ul>

                        <div class="mt-4 sm:mt-6 space-y-2 sm:space-y-3">
                            <button type="submit"
                                    class="text-xs sm:text-sm px-3 py-3 sm:px-4 sm:py-4 w-full bg-main font-extrabold text-white rounded-xl sm:rounded-2xl">
                                پرداخت و شروع دوره ها
                            </button>

                            <div>
                                <a href="{{route('course.index')}}"
                                   class="grid text-center text-xs sm:text-sm px-3 py-2 w-full text-gray-800 border border-gray-300 rounded-xl sm:rounded-2xl">
                                    ادامه خرید
                                </a>
                            </div>

                            <p class="text-center text-xs sm:text-sm">
                                پرداخت و ثبت سفارش، به منزله مطالعه و پذیرفتن
                                <a class="text-main underline font-extrabold" href="{{route('terms')}}">قوانین و مقررات</a>
                                استفاده از خدمات حلزون است.
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        @else
            <h3 class="text-center text-lg sm:text-2xl py-4">هنوز دوره ای را به سبد خرید خود اضافه نکرده اید...</h3>
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

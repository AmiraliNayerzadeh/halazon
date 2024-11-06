@extends('home.layouts.main.master')

@section('content')

    <div class="container mx-auto  ">

        <div class="bg-white shadow-lg rounded-md p-3  my-4">
            <h2 class="text-lg sm:text-2xl font-extrabold mb-5 bg-main25 py-4 px-3 rounded">وضعیت سفارش
                #{{$order->id}}</h2>


            <div class="flex items-center justify-center mb-5">

                @if($order->status == 'پرداخت شده')
                    <div class="text-green-600 text-center">
                        <i class="fas fa-check-circle fa-3x"></i>
                        <p class="text-lg font-semibold mt-2">پرداخت شده</p>
                        <br>
                        <p>پرداخت شما با موفقیت ایجاد شد و از حالا می توانید به آیتم های خریداری شده خود دسترسی پیدا کنید.</p>
                    </div>
                @elseif($order->status == 'انصراف از پرداخت')
                    <!-- انصراف از پرداخت -->
                    <div class="text-red-600 text-center">
                        <i class="fas fa-times-circle fa-3x"></i>
                        <p class="text-lg font-semibold mt-2">انصراف از پرداخت</p>
                        <br>
                        <p>اگر مبلغی از حساب شما کسر شده باشد، اما تراکنش ناموفق بوده است، وجه به صورت خودکار توسط بانک در اسرع وقت به حساب شما بازگردانده خواهد شد. لطفاً تا ۷۲ ساعت صبر کنید و در صورت عدم بازگشت وجه، با پشتیبانی بانک خود تماس بگیرید.</p>

                    </div>
                @elseif($order->status == 'نیاز به بررسی')
                    <!-- نیاز به بررسی -->
                    <div class="text-yellow-600 text-center">
                        <i class="fas fa-exclamation-circle fa-3x"></i>
                        <p class="text-lg font-semibold mt-2">نیاز به بررسی</p>
                        <br>
                        <p>
                            وضعیت تراکنش شما نامشخص است. لطفاً جهت پیگیری و رفع مشکل با پشتیبانی تماس بگیرید.
                        </p>
                    </div>
                @elseif($order->status == 'منتظر پرداخت')
                    <div class="text-blue-600 text-center">
                        <i class="fas fa-hourglass-half fa-4x"></i>
                        <p class="text-lg font-semibold mt-2">منتظر پرداخت</p>
                        <br>
                        <p>
                            در صورت عدم تکمیل پرداخت، سفارش شما به طور خودکار پس از ۲۴ ساعت حذف خواهد شد. لطفاً در اسرع وقت جهت نهایی کردن سفارش اقدام نمایید.
                        </p>
                    </div>
                @endif
            </div>

        </div>


        <div class="bg-white shadow-lg rounded-md p-3  my-4">
            <h2 class="text-lg sm:text-2xl font-extrabold mb-5 bg-main25 py-4 px-3 rounded">آیتم های سفارش</h2>


            <table class="min-w-full bg-white border rounded-md shadow">
                <thead class="bg-gray-200">
                <tr>
                    <th class="p-4 text-center text-gray-700 font-semibold">تصویر</th>
                    <th class="p-4 text-center text-gray-700 font-semibold">عنوان دوره</th>
                    <th class="p-4 text-center text-gray-700 font-semibold">قیمت</th>
                </tr>
                </thead>
                <tbody>
                @foreach($order->courseOrders as $item)
                    <tr class="border-b">

                        <td class="p-4 text-center">
                            <img src="{{ $item->course->image }}" alt="Course Image"
                                 class="w-24 h-24 object-cover mx-auto">
                        </td>


                        <td class="p-4 text-center">
                            <a href="{{ route('course.show', $item->course->slug) }}"
                               class="text-primary100 hover:underline text-lg font-medium">
                                {{ $item->course->title }}
                            </a>
                        </td>

                        <!-- قیمت دوره -->
                        <td class="p-4 text-center text-gray-700">
                            {{ number_format($item->total) }} تومان
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>


        </div>


        <div class="flex justify-end">
            <a class="text-white bg-main rounded py-2 px-3 hover:bg-main25 duration-500"
               href="{{route('profile.index')}}">
                <i class="fa fa-user"></i>
                ورود به پروفایل کاربری</a>
        </div>


    </div>

@endsection
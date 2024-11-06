@extends('.home.profile.master')

@section('content')

    <div>

        <h1 class="text-2xl font-extrabold text-main my-4"><i class="fa fa-money-bill mx-1"></i>لیست تراکنش ها</h1>

        @foreach($orders as $order)

            <div class="w-full mt-7">
                <div class="accordion">
                    <div class="accordion-item shadow-md mb-4 border border-main rounded-2xl">
                        <button class="accordion-header w-full text-right flex justify-between items-center p-2 py-4 h-full"
                                onclick="toggleAccordion(event)">
                            <div class="overflow-x-auto">
                                <table class="whitespace-nowrap">

                                    <td class="p-1 sm:p-4 text-center text-xs sm:text-base">
                                        <b class="text-gray-500">شماره سفارش:</b>
                                        {{ $order->id }}#
                                    </td>


                                    <td class="p-1 sm:p-4 text-center text-xs sm:text-base">
                                        <b class="text-gray-500">وضعیت:</b>
                                        {{ $order->status }}
                                    </td>


                                    <td class="p-1 sm:p-4 text-center text-xs sm:text-base">
                                        <b class="text-gray-500">تعداد آیتم:</b>
                                        {{$order->qty}}
                                    </td>


                                    <td class="p-1 sm:p-4 text-center text-xs sm:text-base text-gray-700">
                                        <b class="text-gray-500">مبلغ سفارش:</b>

                                        {{ number_format($order->total) }} تومان
                                    </td>

                                    <td class="p-1 sm:p-4 text-center text-xs sm:text-base text-gray-700 ">
                                        <b class="text-gray-500">تاریخ:</b>
                                        {{jdate($order->created_at)->toDateString()}}
                                    </td>


                                </table>
                            </div>
                            <i class="fas fa-chevron-down text-main"></i>
                        </button>
                        <div class="accordion-content bg-main25 rounded-b-2xl p-1 sm:p-4 hidden">
                            <div class="w-full bg-white shadow-md p-2 my-2 rounded-md">
                                <ul>
                                    @if(isset($order->patments))
                                        @php
                                            $pay = $order->payments()->latest()->first() ;
                                        @endphp
                                    @endif
                                    <li class="my-2">
                                        <b class="text-gray-500 text-xs sm:text-base">روش پرداخت:</b>
                                        @if($order->method == 'ZarinPal')
                                            <span class="text-xs sm:text-base">درگاه پرداخت زرین پال</span>
                                        @else
                                            {{$order->method}}
                                        @endif
                                    </li>
                                        @if(isset($order->patments))

                                        <li class="my-2">
                                            <b class="text-gray-500 text-xs sm:text-base">شماره پیگیری:</b>
                                            <span class="text-xs sm:text-base">
                                             {{!is_null($pay->traceNumber) ? $pay->traceNumber : 'وجود ندارد.'}}
                                        </span>

                                        </li>
                                    @endif

                                </ul>
                            </div>

                            <table class="w-full">
                                <thead class="bg-gray-200">
                                <tr>
                                    <th class="p-1 sm:p-4 text-center text-xs sm:text-base text-gray-700 font-semibold">
                                        تصویر
                                    </th>
                                    <th class="p-1 sm:p-4 text-center text-xs sm:text-base text-gray-700 font-semibold">
                                        عنوان دوره
                                    </th>
                                    <th class="p-1 sm:p-4 text-center text-xs sm:text-base text-gray-700 font-semibold">
                                        قیمت
                                    </th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($order->courseOrders as $item)

                                    <tr class="border-b bg-white">

                                        <td class="p-1 sm:p-4 text-center text-xs sm:text-base">
                                            <img src="{{ $item->course->image }}" alt="Course Image"
                                                 class="w-16 h-16 object-cover mx-auto rounded-lg">
                                        </td>


                                        <td class="p-1 sm:p-4 text-center text-xs sm:text-base">
                                            <a href="{{ route('course.show', $item->course->slug) }}"
                                               class="text-primary100 hover:underline  font-medium">
                                                {{ $item->course->title }}
                                            </a>
                                        </td>

                                        <!-- قیمت دوره -->
                                        <td class="p-1 sm:p-4 text-center text-xs sm:text-base text-gray-700">
                                            {{ number_format($item->total) }} تومان
                                        </td>
                                    </tr>

                                @endforeach
                                </tbody>

                            </table>

                        </div>
                    </div>
                </div>
            </div>

        @endforeach

    </div>

    @section('script')
        <script>
            function toggleAccordion(event) {
                const header = event.currentTarget;
                const content = header.nextElementSibling;
                const icon = header.querySelector('.fas');

                // Toggle the hidden class to show/hide the content
                content.classList.toggle('hidden');

                // Toggle the icon
                if (content.classList.contains('hidden')) {
                    icon.classList.remove('fa-chevron-up');
                    icon.classList.add('fa-chevron-down');
                } else {
                    icon.classList.remove('fa-chevron-down');
                    icon.classList.add('fa-chevron-up');
                }
            }
        </script>
    @endsection

@endsection
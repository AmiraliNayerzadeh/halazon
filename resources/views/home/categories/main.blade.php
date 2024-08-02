@extends('home.layouts.main.master')

@section('content')
    <div class="bg-[#e9e5ef]">
        <div class="container mx-auto  ">
            <div class="grid grid-cols-12 ">
                <div class="col-span-12  sm:col-span-6 mr-4 my-4">
                    <div class="flex justify-center ">
                        <div>
                            <nav aria-label="breadcrumb" class="w-max ">
                                <ol class="flex flex-wrap items-center w-full py-2">
                                    <li class="flex items-center  text-sm  text-main50 hover:text-main">
                                        <a href="{{route('home')}}">صفحه اصلی</a>
                                    </li>
                                    <span class="text-sm mx-2 "><li class="fa fa-angle-left"></li></span>

                                    <li class="flex items-center  text-sm  text-main50 hover:text-main font-extrabold">
                                        <a href="#">{{$category->title}}</a>
                                    </li>
                                </ol>
                            </nav>

                            <h1 class="text-main100 font-extrabold text-4xl">{{$category->title}}</h1>

                            <div class="mt-6 mr-6">
                                <ul class="text-bold space-y-3">
                                    <li>کلاس‌های گفتگوی زنده ویدیویی جذاب</li>
                                    <li>معلمان مجرب و پرشور</li>
                                    <li> توسعه خلاقیت </li>
                                </ul>
                            </div>

                            <div class="mt-6 mr-6">
                                <div class="flex space-x-2">
                                    <b>رتبه: </b>
                                    <svg class="w-6 fill-[#facc15]" viewBox="0 0 14 13" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                                d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                    </svg>
                                    <svg class="w-6 fill-[#facc15]" viewBox="0 0 14 13" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                                d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                    </svg>
                                    <svg class="w-6 fill-[#facc15]" viewBox="0 0 14 13" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                                d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                    </svg>
                                    <svg class="w-6 fill-[#CED5D8]" viewBox="0 0 14 13" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                                d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                    </svg>
                                    <svg class="w-6 fill-[#CED5D8]" viewBox="0 0 14 13" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                                d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-span-12 border sm:col-span-6  my-10">
                    <div class="flex align-items-center justify-center items-center">
                        <img class="rounded-3xl w-96" src="{{$category->image}}" alt="{{$category->title}}">
                    </div>
                </div>
            </div>

        </div>
    </div>
    <img class="w-full" src="/assets/hr-down.svg" alt="halazon hr">
@endsection
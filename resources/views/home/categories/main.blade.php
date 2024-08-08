@extends('home.layouts.main.master')

@section('content')
    <div class="bg-[#e9e5ef]">
        <div class="container mx-auto  ">
            <div class="grid grid-cols-12 ">
                <div class="col-span-12  sm:col-span-6 mr-4 my-4">
                    <div class="flex h-full  items-center ">
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
                                    <li> توسعه خلاقیت</li>
                                </ul>
                            </div>

                            <div class="mt-6 mr-6">
                                <div class="flex space-x-2">
                                    <b>رتبه: </b>
                                    <svg class="w-6 fill-[#facc15]" viewBox="0 0 14 13" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                                d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z"/>
                                    </svg>
                                    <svg class="w-6 fill-[#facc15]" viewBox="0 0 14 13" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                                d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z"/>
                                    </svg>
                                    <svg class="w-6 fill-[#facc15]" viewBox="0 0 14 13" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                                d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z"/>
                                    </svg>
                                    <svg class="w-6 fill-[#CED5D8]" viewBox="0 0 14 13" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                                d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z"/>
                                    </svg>
                                    <svg class="w-6 fill-[#CED5D8]" viewBox="0 0 14 13" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                                d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z"/>
                                    </svg>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>

                <div class="col-span-12 border sm:col-span-6  my-10">
                    <div class="flex align-items-center justify-center items-center">
                        <img class="rounded-3xl w-auto max-h-72 " src="{{!is_null($category->image) ? $category->image : '/assets/default-image.jpg'}}" alt="{{$category->title}}">
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="relative  -z-10 mb-5">
        <img class="w-full" src="/assets/home/wavestop.svg" alt="halazon hr">
    </div>

    <div class="container mx-auto">
        <div class="grid grid-cols-12">
            @foreach($courses as $course)
                <div class="col-span-12 sm:col-span-4 rounded-2xl p-2 border shadow my-3 mx-4">
                    <div class="p-1">
                        <div><a href="{{route('course.show' , $course)}}"><img class="rounded-2xl" src="{{$course->image}}" alt="{{$course->title}}"></a>
                        </div>

                        <h3 class="mt-4 font-extrabold text-2xl hover:text-main duration-500"><a
                                    href="{{route('course.show' , $course)}}">{{$course->title}}</a></h3>

                        {{--Score--}}
                        <div class="mt-3">
                            <li class="fa fa-star text-yellow-400"></li>
                            <span>5</span>
                            <small>(14 نفر)</small>
                        </div>
                        {{--End Score--}}

                        {{--Teacher--}}
                        <div class="flex items-center mt-3 ">
                            <a href="#"><img class="rounded-full h-14 w-14 border border-2 border-main " src="{{$course->teacher->avatar}}" alt=""></a>
                            <h4 class="mr-2 text-main50">استاد: <a href="#">{{$course->teacher->name}} {{$course->teacher->family}}</a></h4>
                        </div>
                        {{--End Teacher--}}

                        {{--Info--}}
                        <div class="grid grid-cols-6  mt-5">
                            <div class="col-span-3 sm:col-span-2 mx-2 bg-main25 shadow rounded-2xl">
                                <div class="flex h-full items-center justify-center py-6 text-center">
                                    <div>
                                        {{$course->age_from}}
                                        الی
                                        {{$course->age_to}}
                                        سال
                                    </div>
                                </div>
                            </div>



                            <div class="col-span-3 sm:col-span-2 mx-2 bg-main25 shadow rounded-2xl">
                                <div class="flex h-full items-center justify-center py-6 text-center">
                                    {{$course->minutes}}
                                    دقیقه
                                </div>
                            </div>




                            <div class="col-span-6 sm:col-span-2 mt-2 sm:mt-0 mx-2 bg-main25 shadow rounded-2xl">
                                <div class="flex h-full items-center justify-center py-6 text-center">
                                    {{number_format(($course->price - $course->discount_price) / $course->class_duration )}}
                                    تومان هر جلسه
                                </div>
                            </div>
                        </div>
                        {{--End Info--}}


                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
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
                        <img class="rounded-3xl w-auto max-h-72 "
                             src="{{!is_null($category->image) ? $category->image : '/assets/default-image.jpg'}}"
                             alt="{{$category->title}}">
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
                <div class="col-span-6 sm:col-span-3 rounded-2xl m-1 sm:m-3 sm:p-2 border shadow ">
                    <div class="p-1 ">
                        <div>
                            <a href="{{route('course.show' , $course)}}">
                                <img class="rounded-2xl h-28 sm:h-52 w-full object-cover" src="{{$course->image}}"
                                     alt="{{$course->title}}">
                            </a>
                        </div>

                        <h3 class="mt-4 font-extrabold text-sm sm:text-lg hover:text-main duration-500 truncate"><a
                                    href="{{route('course.show' , $course)}}">{{$course->title}}</a>

                        </h3>

                        <div class="mt-2 text-gray-500 text-xs sm:text-sm">
                            <p>نوع کلاس:
                                <span>{{$course->type_translated}}</span>
                            </p>
                        </div>


                        {{--Teacher--}}
                        <div class="flex items-center mt-3 ">
                            <a href="{{route('teacher.show' , $course->teacher)}}"><img
                                        class="rounded-full h-8 w-8 sm:h-14 sm:w-14 border border-2 border-main "
                                        src="{{$course->teacher->avatar}}" alt=""></a>
                            <h4 class="mr-2 text-main50 text-xs sm:text-base truncate">استاد: <a
                                        href="{{route('teacher.show' , $course->teacher)}}">{{$course->teacher->name}} {{$course->teacher->family}}</a>
                            </h4>

                        </div>


                        {{--  End Teacher--}}

                        {{-- Info--}}
                        <div class="grid grid-cols-6 mt-2 sm:mt-4">

                            <div class="col-span-6 sm:col-span-3 mx-2 bg-main25 shadow rounded-2xl my-1 sm:my-2">
                                <div class="flex h-full items-center justify-center py-1 sm:py-3 text-center text-xs sm:text-base">
                                    @if($course->age_from == $course->age_to )
                                        <div>
                                            {{$course->age_from}}
                                            الی
                                            {{$course->age_to}}
                                            سال
                                        </div>
                                    @else
                                        <div>
                                            مختص 6 سال
                                        </div>
                                    @endif

                                </div>
                            </div>


                            <div class="col-span-6 sm:col-span-3 mx-2 bg-main25 shadow rounded-2xl my-1 sm:my-2">
                                <div class="flex h-full items-center justify-center py-1 sm:py-3 text-center text-xs sm:text-base">
                                    {{$course->minutes}}
                                    دقیقه
                                </div>
                            </div>


                            <div class="col-span-6 sm:col-span-6  mx-2 bg-main25 shadow rounded-2xl my-1 sm:my-2">
                                <div class="flex h-full items-center justify-center py-1 sm:py-3 text-center text-xs sm:text-base">
                                    @if($course->price != 0 )
                                        @if($course->type == 'online')
                                            {{number_format(($course->price - $course->discount_price) / $course->class_duration )}}
                                            تومان هر جلسه
                                        @elseif($course->type == 'offline')
                                            {{number_format(($course->price - $course->discount_price))}}
                                            تومان
                                        @endif
                                    @else
                                        رایگان😍
                                    @endif
                                </div>
                            </div>
                        </div>
                        {{--End Info--}}
                    </div>
                </div>
            @endforeach
        </div>
    </div>


    <div class=" rounded-3xl container mx-auto mt-16 bg-gray-100 p-3">
        <div class="flex items-center justify-between mb-3">
            <h3 class="font-extrabold text-sm sm:text-2xl  text-center  ">
                آخرین مقالات دسته بندی {{$category->title}}
            </h3>
            <a class="text-main" href="{{route('blog.category' , $category)}}">مشاهده همه
                <i class="fa fa-angle-left"></i>
            </a>
        </div>

        <div class="swiper" id="main">
            <div class="swiper-wrapper">
                @foreach($blogs as $blog)
                    <div class="swiper-slide">
                        <div class="rounded-2xl sm:p-2 border shadow my-3">
                            <div class="p-1">
                                <div>
                                    <a href="{{route('blog.show' , ['category' => $blog->categories[0]->slug, 'blog' => $blog->slug])}}"><img
                                                class="rounded-2xl" src="{{$blog->image}}" alt="{{$blog->title}}"></a>
                                </div>

                                <h3 class="mt-4 font-extrabold text-sm sm:text-lg hover:text-main duration-500 truncate">
                                    <a
                                            href="{{route('blog.show' , ['category' => $blog->categories[0]->slug, 'blog' => $blog->slug])}}">{{$blog->title}}</a>
                                </h3>


                                {{--Teacher--}}
                                <div class="flex items-center mt-3 ">
                                    <a href="{{route('teacher.show' , $blog->user)}}"><img
                                                class="rounded-full h-8 w-8 sm:h-14 sm:w-14 border border-2 border-main "
                                                src="{{$blog->user->avatar}}" alt=""></a>
                                    <h4 class="mr-2 text-main50 text-xs sm:text-base truncate">استاد: <a
                                                href="{{route('teacher.show' , $blog->user)}}">{{$blog->user->name}} {{$blog->user->family}}</a>
                                    </h4>

                                </div>

                                {{--End Teacher--}}


                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="relative mt-10">
                <div class="swiper-pagination"></div>
            </div>
        </div>


    </div>


    @section('script')

        <link rel="stylesheet" type="text/css" href="/assets/home/plugins/swiper/swiper-bundle.min.css"/>
        <script type="text/javascript" src="/assets/home/plugins/swiper/swiper-bundle.min.js"></script>


        <script>
            var swiper = new Swiper("#main", {
                slidesPerView: 2,
                spaceBetween: 10,
                loop: true,
                autoplay: {
                    delay: 4500,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },

                breakpoints: {
                    640: {
                        slidesPerView: 2,
                        spaceBetween: 10,
                    },
                    900: {
                        slidesPerView: 3,
                        spaceBetween: 10,
                    },
                    1200: {
                        slidesPerView: 4,
                        spaceBetween: 10,
                    },
                },
            });
        </script>

    @endsection

@endsection
@extends('.home.layouts.main.master')

@section('content')
    <div class="mt-5 grid grid-cols-12 rounded-3xl container mx-auto"
         style="background: linear-gradient(90deg, rgba(81, 46, 136, 0.22) 27%, rgba(251, 137, 49, 0.22) 72.5%)">
        <div class="col-span-12 sm:col-span-6 p-6 sm:p-20">
            <div class="flex flex-wrap h-full items-center">
                <div class="space-y-3 sm:space-y-5">
                    <h1 class="text-main font-extrabold text-lg sm:text-3xl ">پلتفرم آموزشی حلزون</h1>
                    <p class="mt-3 text-lg sm:text-lg">آهسته و پیوسته پیشرفت می‌کنیم.</p>
                    <div>
                        <li class="fa-solid fa-graduation-cap text-base text-primary ml-4"></li>
                        <span class="text-main underline font-extrabold dec">+{{$countCourse}}</span>
                        <span>کلاس فعال</span>
                    </div>
                    <div>
                        <li class="fa-solid fa-chalkboard-user text-base text-primary ml-4"></li>
                        <span class="text-main underline font-extrabold dec">+{{$countTeacher}}</span>
                        <span>دبیر فعال</span>
                    </div>

                    <div class="mt-24 flex">
                        <a class="bg-primary hover:bg-primary100 duration-500 p-3 font-extrabold text-sm rounded-3xl text-white "
                           href="{{route('login')}}"><i class="fa-solid fa-plus ml-3"></i>به ما بپیوندید</a>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-6">
            <div class="flex w-full h-full items-center justify-center">
                <img class="h-72 sm:h-[25rem]" src="/assets/home/image/Mainhalazoon.webp" alt="وب سایت آموزشی حلزون">
            </div>
        </div>
    </div>




    {{--Section 2--}}
    <div class="grid grid-cols-12 my-10 container mx-auto ">

        <div class="col-span-12  sm:col-span-3 my-3">
            <div class="flex items-center justify-center">
                <img class="ml-2" src="/assets/home/image/global.svg" alt="آموزش برای تمام فارسی زبانان">
                <span class="font-bold">آموزش برای تمام فارسی زبانان</span>
            </div>
        </div>

        <div class="col-span-12  sm:col-span-3 my-3">
            <div class="flex items-center justify-center">
                <img class="ml-2" src="/assets/home/image/age.svg" alt="آموزش برای ۳ الی ۱۸ سال">
                <span class="font-bold">آموزش برای ۳ الی ۱۸ سال</span>
            </div>
        </div>

        <div class="col-span-12  sm:col-span-3 my-3">
            <div class="flex items-center justify-center">
                <img class="ml-2" src="/assets/home/image/felex.svg" alt="آموزش منعطف">
                <span class="font-bold">آموزش منعطف</span>
            </div>
        </div>

        <div class="col-span-12  sm:col-span-3 my-3">
            <div class="flex items-center justify-center">
                <img class="ml-2" src="/assets/home/image/review.svg" alt="نظارت بر آموزش">
                <span class="font-bold">نظارت بر آموزش</span>
            </div>
        </div>

    </div>
    {{--End Section 2--}}



    {{--Section 3--}}
    <div class="my-12 container mx-auto">
        <div class="text-center mb-6 ">
            <h3 class="font-extrabold text-2xl sm:text-2xl mb-4">کلاس ها و معلمان برای هر مقطعی</h3>
            <a class="text-main " href="{{route('degrees.index')}}">مشاهده همه مقطع ها</a>
        </div>

        <div class="grid grid-cols-12 mx-auto">
            @foreach($degrees as $degree)
                <div class="col-span-6 sm:col-span-3 my-1">
                    <div class="flex justify-center">
                        <div class="sm:w-2/3 p-4">
                            <a href="{{route('degrees.show' , $degree)}}"><img class="w-full rounded-t-3xl "
                                                                               src="{{$degree->image}}"
                                                                               alt="{{$degree->title}}"></a>
                            <div class="w-full bg-white shadow rounded-b-3xl py-5 text-center">
                                <a href="{{route('degrees.show' , $degree)}}"
                                   class="font-extrabold text-lg hover:text-main duration-500">{{$degree->title}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
    {{--End Section 3--}}

    {{--Section 4--}}
    <div class="bg-main25 rounded-3xl container mx-auto">
        <h3 class="font-extrabold text-2xl sm:text-2xl text-center my-6 py-5">موضوعات و محورهای آموزشی منتخب</h3>

        <div class="swiper" id="main">
            <div class="swiper-wrapper">
                @foreach($mainCategory as $category)
                    <div class="swiper-slide">
                        <div class="flex h-full w-full items-center justify-center">
                            <div>
                                <div class="flex justify-center">
                                    <a class="my-2" href="{{route('category' , $category)}}"><img
                                                class="h-28 w-28 rounded-full object-cover" src="{{$category->image}}"
                                                alt="{{$category->title}}"></a>
                                </div>
                                <h3 class="text-center mt-2 "><a href="{{route('category' , $category)}}">{{$category->title}}</a></h3>
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
    {{--End Section 4--}}




    {{--Section 5--}}
    <div class=" rounded-3xl container mx-auto mt-10">
        <div class="flex items-center justify-between mb-3 ">
            <h3 class="font-extrabold text-base sm:text-2xl  text-center  ">
                <b class="text-primary">جدیدترین</b>
                کلاس ها
            </h3>
            <a class="text-main" href="{{route('course.index')}}">مشاهده همه
                <i class="fa fa-angle-left"></i>
            </a>
        </div>

        <div class="swiper" id="main">
            <div class="swiper-wrapper">
                @foreach($courses as $course)
                    <div class="swiper-slide rounded-2xl p-2 border shadow ">
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

            <div class="relative mt-10">
                <div class="swiper-pagination"></div>
            </div>
        </div>


    </div>
    {{--End Section 5--}}



    {{--Section 6--}}
    <div class=" rounded-3xl container mx-auto mt-10">

        <div class="bg-gray-200 p-5 mt-10 rounded-3xl">
            <div class=" rounded-3xl container mx-auto ">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="font-extrabold text-base sm:text-2xl  text-center  ">
                        <b class="text-primary">{{$countTeacher}}+</b>
                        معلم با تجربه
                    </h3>
                    <a class="text-main" href="{{route('teacher.index')}}">مشاهده همه
                        <i class="fa fa-angle-left"></i>
                    </a>
                </div>

                <div class="swiper" id="teacher">
                    <div class="swiper-wrapper">
                        @foreach($teachers as $teacher)
                            <div class="swiper-slide">
                                <div class="bg-white  shadow rounded-3xl ">
                                    <div class="grid grid-cols-12">
                                        <div class="col-span-4">
                                            <div class="flex h-full items-center p-2">
                                                <a href="{{route('teacher.show', $teacher)}}">
                                                    <img class="rounded-3xl h-20 w-20 object-cover" src="{{$teacher->avatar}}"
                                                         alt="{{$teacher->name}} {{$teacher->family}}">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-span-8 p-3">
                                            <h3 class="text-main font-extrabold text-lg truncate"><a
                                                        href="{{route('teacher.show' , $teacher)}}">{{$teacher->name}} {{$teacher->family}}</a>
                                            </h3>
                                            <ul class="mt-2">
                                                <li>
                                                    <span><i class="fa fa-book"></i><b class="mr-2 ">{{count($teacher->courses)}} دوره </b></span>
                                                </li>
                                                <li>
                                    <span class="truncate"><i class="fa fa-calendar"></i><b
                                                class="mr-2 ">فعالیت از  {{jdate($teacher->created_at)->ago()}}</b></span>
                                                </li>
                                            </ul>
                                            <div class="flex justify-end">
                                                <a class="bg-primary  hover:bg-primary100 py-2 px-3 rounded-full text-white duration-500 text-sm mt-3"
                                                   href="{{route('teacher.show', $teacher)}}">مشاهده</a>
                                            </div>
                                        </div>
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
        </div>

    </div>

    <div class="bg-gray-100 rounded-3xl shadow-md flex flex-col md:flex-row items-center p-6 md:p-8 my-8 mx-4 md:mx-0">
        <div class="w-full md:w-1/4 mb-4 md:mb-0">
            <img src="/assets/home/image/teacher.png" alt="Become a teacher on Halazon" class="rounded-lg object-cover w-60 ">
        </div>
        <div class="w-full md:w-3/4 flex flex-col items-start pl-4">
            <h2 class="text-2xl font-semibold text-gray-800 mb-2">شما هم می‌توانید مدرس حلزون باشید!</h2>
            <p class="text-gray-700 mb-4">اگر تخصصی دارید و می‌خواهید دانش خود را با دیگران به اشتراک بگذارید، در حلزون ثبت‌نام کنید. دوره‌های خود را به فروش بگذارید و به جامعه بزرگ ما بپیوندید.</p>
            <a href="{{ route('teacher.landing') }}" class="px-6 py-3 bg-main text-white rounded-full font-semibold text-center transition duration-300 ease-in-out hover:bg-main100">
                همکاری با حلزون
            </a>
        </div>
    </div>
    {{--End Section 6--}}



    {{--Section 7--}}
    <div class=" rounded-3xl container mx-auto mt-10">
        <div class="flex items-center justify-between mb-3">
            <h3 class="font-extrabold text-base sm:text-2xl  text-center  ">
                <b class="text-primary">آخرین</b>
                مقالات
            </h3>
            <a class="text-main" href="{{route('blog.index')}}">مشاهده همه
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

                                <h3 class="mt-4 font-extrabold text-sm sm:text-lg hover:text-main duration-500 truncate"><a
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
    {{--End Section 7--}}

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


        <script>
            var swiper = new Swiper("#teacher", {
                slidesPerView: 1,
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
                        slidesPerView: 1,
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

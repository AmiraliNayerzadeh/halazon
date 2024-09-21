@extends('.home.layouts.main.master')

@section('content')
    <div class="mt-5 grid grid-cols-12 rounded-3xl container mx-auto"
         style="background: linear-gradient(90deg, rgba(81, 46, 136, 0.22) 27%, rgba(251, 137, 49, 0.22) 72.5%)">
        <div class="col-span-12 sm:col-span-6 p-6 sm:p-20">
            <div class="flex flex-wrap h-full items-center">
                <div class="space-y-3 sm:space-y-5">
                    <h1 class="text-main font-extrabold text-3xl sm:text-6xl ">پلتفرم آموزشی حلزون</h1>
                    <p class="mt-3 text-lg sm:text-2xl">آهسته و پیوسته پیشرفت می‌کنیم.</p>
                    <div>
                        <li class="fa-solid fa-graduation-cap text-3xl text-primary ml-4"></li>
                        <span class="text-main underline font-extrabold dec">+22</span>
                        <span>کلاس فعال</span>
                    </div>
                    <div>
                        <li class="fa-solid fa-chalkboard-user text-3xl text-primary ml-4"></li>
                        <span class="text-main underline font-extrabold dec">+{{$countTeacher}}</span>
                        <span>دبیر فعال</span>
                    </div>
                    <div>
                        <li class="fa-regular fa-star text-3xl text-primary ml-4"></li>
                        <span class="text-main underline font-extrabold dec">+69</span>
                        <span>کلاس برگزار شده</span>
                    </div>
                    <div class="mt-24 flex">
                        <a class="bg-primary hover:bg-primary100 duration-500 py-4 px-5 font-extrabold rounded-3xl text-white "
                           href="{{route('login')}}"><i class="fa-solid fa-plus ml-3"></i>به ما بپیوندید</a>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-6">
            <div class="flex w-full h-full justify-center">
                <img class="" src="/assets/home/image/Mainhalazoon.webp" alt="وب سایت آموزشی حلزون">
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
        <h3 class="font-extrabold text-2xl sm:text-4xl text-center mb-6">کلاس ها و معلمان برای هر مقطعی</h3>
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
        <h3 class="font-extrabold text-2xl sm:text-4xl text-center my-6 py-5">موضوعات و محورهای آموزشی منتخب</h3>
        <div class="grid grid-cols-12">
            @foreach($mainCategory as $category)
                <div class="col-span-6 sm:col-span-2 my-6">
                    <div class="flex justify-center items-center text-center">
                        <div class="">
                            <a href="{{route('category' , $category)}}">
                                <img class="h-32"
                                     src="{{!is_null($category->image) ? $category->image : '/assets/default-image.jpg'}}"
                                     alt="{{$category->title}}">
                                <span class="font-bold text-lg hover:text-main duration-500">{{$category->title}}</span>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    {{--End Section 4--}}


    {{--Section 5--}}
    <div class=" rounded-3xl container mx-auto mt-10">
        <div class="flex items-center justify-between mb-3 ">
            <h3 class="font-extrabold text-base sm:text-2xl  text-center  ">
                <b class="text-primary">جدیدترین</b>
                کلاس های آنلاین
            </h3>
            <a class="text-main" href="">مشاهده همه
                <i class="fa fa-angle-left"></i>
            </a>
        </div>

        <div class="swiper">
            <div class="swiper-wrapper">
                @foreach($courses as $course)
                    <div class="swiper-slide rounded-2xl p-2 border shadow ">
                        <div class="p-1 ">
                            <div>
                                <a href="{{route('course.show' , $course)}}">
                                    <img class="rounded-2xl h-60 w-full" src="{{$course->image}}"
                                         alt="{{$course->title}}">
                                </a>
                            </div>

                            <h3 class="mt-4 font-extrabold text-2xl hover:text-main duration-500 truncate"><a
                                        href="{{route('course.show' , $course)}}">{{$course->title}}</a></h3>

                            {{--                            Score--}}
                            <div class="mt-3">
                                <li class="fa fa-star text-yellow-400"></li>
                                <span>5</span>
                                <small>(14 نفر)</small>
                            </div>
                            {{--                            End Score--}}

                            {{--                            Teacher--}}
                            <div class="flex items-center mt-3 ">
                                <a href="#"><img class="rounded-full h-14 w-14 border border-2 border-main "
                                                 src="{{$course->teacher->avatar}}" alt=""></a>
                                <h4 class="mr-2 text-main50">استاد: <a
                                            href="#">{{$course->teacher->name}} {{$course->teacher->family}}</a></h4>
                            </div>
                            {{--                            End Teacher--}}

                            {{--                            Info--}}
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
            <div class="swiper-pagination p-5"></div>

        </div>


    </div>
    {{--End Section 5--}}



    {{--Section 6--}}
    <div class="bg-gray-200 p-5 mt-10">
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

            <div class="swiper">
                <div class="swiper-wrapper">
                    @foreach($teachers as $teacher)
                        <div class=" bg-white   shadow rounded-3xl swiper-slide">
                            <div class="grid grid-cols-12">
                                <div class="col-span-4">
                                    <div class="flex h-full items-center">
                                        <a href="{{route('teacher.show', $teacher)}}">
                                            <img class="rounded-3xl" src="{{$teacher->avatar}}"
                                                 alt="{{$teacher->name}} {{$teacher->family}}">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-span-8 p-3">
                                    <h3 class="text-main font-extrabold text-lg "><a
                                                href="{{route('teacher.show' , $teacher)}}">{{$teacher->name}} {{$teacher->family}}</a>
                                    </h3>
                                    <ul class="mt-2">
                                        <li>
                                            <span><i class="fa fa-book"></i><b class="mr-2 ">{{count($teacher->courses)}} دوره </b></span>
                                        </li>
                                        <li>
                                    <span><i class="fa fa-calendar"></i><b
                                                class="mr-2 ">فعالیت از  {{jdate($teacher->created_at)->ago()}}</b></span>
                                        </li>
                                    </ul>
                                    <div class="flex justify-end">
                                        <a class="bg-primary  hover:bg-primary100 py-2 px-3 rounded text-white duration-500 text-sm mt-3"
                                           href="{{route('teacher.show', $teacher)}}">مشاهده</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination p-5"></div>

            </div>


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

        <div class="swiper">
            <div class="swiper-wrapper">
                @foreach($blogs as $blog)
                    <div class="rounded-2xl p-2 border shadow my-3 mx-4 swiper-slide">
                        <div class="p-1">
                            <div>
                                <a href="{{route('blog.show' , ['category' => $blog->categories[0]->slug, 'blog' => $blog->slug])}}"><img
                                            class="rounded-2xl" src="{{$blog->image}}" alt="{{$blog->title}}"></a></div>

                            <h3 class="mt-4 font-extrabold text-lg hover:text-main duration-500 truncate"><a
                                        href="{{route('blog.show' , ['category' => $blog->categories[0]->slug, 'blog' => $blog->slug])}}">{{$blog->title}}</a>
                            </h3>

                            {{--Category--}}
                            <div class="flex items-center my-3 border-t pt-4">
                                <h5 class="font-extrabold ">
                                    <i class="fa fa-file"></i>
                                    دسته بندی:</h5>
                                @foreach($blog->categories as $category)
                                    <span class="mx-1">
                                <a class="text-sm bg-main25 p-1 rounded"
                                   href="{{route('blog.category' , $category)}}">{{$category->title}}</a>
                            </span>
                                @endforeach
                            </div>
                            {{--End Category--}}

                            {{--Teacher--}}
                            <div class="flex items-center mt-3 ">
                                <a href="{{route('teacher.show' , $blog->user)}}"><img
                                            class="rounded-full h-14 w-14 border border-2 border-main "
                                            src="{{$blog->user->avatar}}" alt=""></a>
                                <h4 class="mr-2 text-main50">نویسنده: <a
                                            href="{{route('teacher.show' , $blog->user)}}">{{$blog->user->name}} {{$blog->user->family}}</a>
                                </h4>
                            </div>
                            {{--End Teacher--}}


                        </div>
                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination p-5"></div>

        </div>


    </div>
    {{--End Section 7--}}

    @section('script')

        <link rel="stylesheet" type="text/css" href="/assets/home/plugins/swiper/swiper-bundle.min.css"/>
        <script type="text/javascript" src="/assets/home/plugins/swiper/swiper-bundle.min.js"></script>



        <script>
            var swiper = new Swiper(".swiper", {
                slidesPerView: 1,
                spaceBetween: 10,
                loop: true,
                autoplay: {
                    delay: 2500,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },

                breakpoints: {
                    640: {
                        slidesPerView: 2,
                        spaceBetween: 20,
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
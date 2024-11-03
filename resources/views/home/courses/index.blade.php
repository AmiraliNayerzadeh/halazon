@extends('home.layouts.main.master')
@section('content')
    <div class="bg-[#e9e5ef]">
        <div class="container mx-auto  ">
            <div class="grid grid-cols-12 ">
                <div class="col-span-12   mr-4 my-4">
                        <div>
                            <nav aria-label="breadcrumb" class="w-max  ">
                                <ol class="flex flex-wrap items-center w-full py-2">
                                    <li class="flex items-center  text-sm  text-main50 hover:text-main">
                                        <a href="{{route('home')}}">صفحه اصلی</a>
                                    </li>
                                    <span class="text-sm mx-2 "><li class="fa fa-angle-left"></li></span>

                                    <li class="flex items-center  text-sm  text-main50 hover:text-main font-extrabold">
                                        <a href="#">تمام دوره ها</a>
                                    </li>
                                </ol>
                            </nav>

                            <h1 class="text-main100 font-extrabold text-2xl sm:text-4xl ">
                                دوره‌های آموزشی آنلاین و آفلاین برای کودکان، نوجوانان و جوانان
                            </h1>

                            <!-- Introduction Section -->
                            <section class="container mx-auto px-4 py-8">
                                <div class=" mx-auto">
                                    <p class="text-lg text-gray-700 mb-6">
                                        در سایت آموزشی حلزون، ما دوره‌هایی را طراحی کرده‌ایم که برای کودکان، نوجوانان و جوانان تجربه‌ای هیجان‌انگیز و به‌یادماندنی از یادگیری فراهم می‌کند. این دوره‌ها به شما امکان می‌دهند مهارت‌های جدید را با سرعت خود بیاموزید و استعدادهایتان را پرورش دهید.
                                    </p>
                                    <p class="text-lg text-gray-700 mb-4">
                                        <strong>انواع دوره‌های آموزشی:</strong> دوره‌های هنری شامل نقاشی و عکاسی، دوره‌های علمی شامل علوم پایه و ریاضیات، مهارت‌های اجتماعی و رشد فردی، آموزش زبان انگلیسی و دوره‌های ورزشی.
                                    </p>
                                    <p class="text-lg text-gray-700 mb-4">
                                        <strong>چرا دوره‌های حلزون؟</strong> اساتید حرفه‌ای، دسترسی آسان و یادگیری انعطاف‌پذیر، محتوای آموزشی باکیفیت و مناسب سنین مختلف.
                                    </p>
                                    <p class="text-lg text-gray-700">
                                        برای آشنایی بیشتر با دوره‌ها و شروع یادگیری در فضای شاد و خلاق، به بخش دوره‌های آموزشی حلزون سر بزنید و همین امروز مسیر یادگیری خود را آغاز کنید!
                                    </p>
                                </div>
                            </section>


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
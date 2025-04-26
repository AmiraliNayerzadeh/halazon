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
                                    در سایت آموزشی حلزون، ما دوره‌هایی را طراحی کرده‌ایم که برای کودکان، نوجوانان و
                                    جوانان تجربه‌ای هیجان‌انگیز و به‌یادماندنی از یادگیری فراهم می‌کند. این دوره‌ها به
                                    شما امکان می‌دهند مهارت‌های جدید را با سرعت خود بیاموزید و استعدادهایتان را پرورش
                                    دهید.
                                </p>
                                <p class="text-lg text-gray-700 mb-4">
                                    <strong>انواع دوره‌های آموزشی:</strong> دوره‌های هنری شامل نقاشی و عکاسی، دوره‌های
                                    علمی شامل علوم پایه و ریاضیات، مهارت‌های اجتماعی و رشد فردی، آموزش زبان انگلیسی و
                                    دوره‌های ورزشی.
                                </p>
                                <p class="text-lg text-gray-700 mb-4">
                                    <strong>چرا دوره‌های حلزون؟</strong> اساتید حرفه‌ای، دسترسی آسان و یادگیری
                                    انعطاف‌پذیر، محتوای آموزشی باکیفیت و مناسب سنین مختلف.
                                </p>
                                <p class="text-lg text-gray-700">
                                    برای آشنایی بیشتر با دوره‌ها و شروع یادگیری در فضای شاد و خلاق، به بخش دوره‌های
                                    آموزشی حلزون سر بزنید و همین امروز مسیر یادگیری خود را آغاز کنید!
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
                <div class="col-span-6 sm:col-span-3 rounded-2xl m-1 sm:m-3 sm:p-2 border shadow ">
                    @include('.home.courses.components.courseBox' , ['course' => $course])
                </div>
            @endforeach
        </div>
    </div>

@endsection

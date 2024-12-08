@extends('home.layouts.main.master')
@section('content')
    <div class="container mx-auto my-7">

        <div class="flex items-center justify-between mb-4">
            <h1 class="text-2xl font-extrabold text-main ">معلمین</h1>

            <nav aria-label="breadcrumb" class="w-max ">
                <ol class="flex flex-wrap items-center w-full py-2">
                    <li class="flex items-center  text-sm  text-main50 hover:text-main">
                        <a href="{{route('home')}}">صفحه اصلی</a>
                    </li>
                    <span class="text-sm mx-2 "><li class="fa fa-angle-left"></li></span>

                    <li class="flex items-center  text-sm  text-main50 hover:text-main font-extrabold">
                        <a href="#">معلمین</a>
                    </li>
                </ol>
            </nav>
        </div>

        <div class="grid grid-cols-12">
            @foreach($teachers as $teacher)
                <div class="col-span-12  sm:col-span-4 bg-white p-5 m-2 shadow rounded-3xl">
                    <div class="grid grid-cols-12">
                        <div class="col-span-4">
                            <div class="flex h-full items-center">
                                <a href="{{route('teacher.show', $teacher)}}">
                                    <img class="rounded-3xl h-24 w-24 object-cover" src="{{$teacher->avatar}}"
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
                                <a class="bg-primary  hover:bg-primary100 py-2 px-3 rounded text-white duration-500 text-sm mt-3" href="{{route('teacher.show', $teacher)}}">مشاهده</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{$teachers->links()}}
        </div>

        <div class="bg-gray-100 rounded-lg shadow-md flex flex-col md:flex-row items-center p-6 md:p-8 my-8 mx-4 md:mx-0">
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



    </div>
@endsection

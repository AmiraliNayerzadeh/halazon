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
    </div>
@endsection

@extends('home.layouts.main.master')

@section('content')
    <div class="bg-[#e9e5ef]">
        <div class="container mx-auto  ">


            <div class="flex justify-center">
                <div class="my-4">
                    <nav aria-label="breadcrumb">
                        <ol class="flex flex-wrap items-center justify-center text-center w-full py-2">
                            <li class="flex items-center  text-sm  text-main50 hover:text-main">
                                <a href="{{route('home')}}">صفحه اصلی</a>
                            </li>
                            <span class="text-sm mx-2 "><li class="fa fa-angle-left"></li></span>

                            <li class="flex items-center  text-sm  text-main50 hover:text-main">
                                <a href="{{route('degrees.index')}}">مقطع ها</a>
                            </li>

                            <span class="text-sm mx-2 "><li class="fa fa-angle-left"></li></span>
                            <li class="flex items-center  text-sm  text-main50 hover:text-main font-extrabold">
                                <a href="#">{{$degree->title}}</a>
                            </li>
                        </ol>
                    </nav>

                    <div><h1 class="text-main100 font-extrabold text-center text-4xl my-5">{{$degree->title}}</h1></div>

                    <img class="rounded-3xl w-auto max-h-72 " src="{{$degree->image}}" alt="{{$degree->title}}">

                </div>
            </div>



        </div>
    </div>
    <div class="relative  -z-10 mb-5">
        <img class="w-full" src="/assets/home/wavestop.svg" alt="halazon hr">
    </div>

    <div class="container mx-auto">
        @if(count($courses) > 0)

        <div class="grid grid-cols-12">
                @foreach($courses as $course)
                    <div class="col-span-12 sm:col-span-4 rounded-2xl p-2 border shadow my-3 mx-4">
                        <div class="p-1">
                            <div><a href="{{route('course.show' , $course)}}"><img class="rounded-2xl"
                                                                                   src="{{$course->image}}"
                                                                                   alt="{{$course->title}}"></a>
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
                                <a href="#"><img class="rounded-full h-14 w-14 border border-2 border-main "
                                                 src="{{$course->teacher->avatar}}" alt=""></a>
                                <h4 class="mr-2 text-main50">استاد: <a
                                            href="#">{{$course->teacher->name}} {{$course->teacher->family}}</a></h4>
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
        @else
            <p class="text-center text-lg">این مقطع دوره و کلاس فعالی ندارد.</p>
        @endif
    </div>

@endsection
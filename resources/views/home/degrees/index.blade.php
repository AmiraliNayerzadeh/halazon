@extends('home.layouts.main.master')
@section('content')
    <div class="container mx-auto my-7">

        <div class="flex items-center justify-between mb-4">
            <h1 class="text-2xl font-extrabold text-main ">مقاطع</h1>

            <nav aria-label="breadcrumb" class="w-max ">
                <ol class="flex flex-wrap items-center w-full py-2">
                    <li class="flex items-center  text-sm  text-main50 hover:text-main">
                        <a href="{{route('home')}}">صفحه اصلی</a>
                    </li>
                    <span class="text-sm mx-2 "><li class="fa fa-angle-left"></li></span>

                    <li class="flex items-center  text-sm  text-main50 hover:text-main font-extrabold">
                        <a href="#">مقاطع</a>
                    </li>
                </ol>
            </nav>
        </div>

        <div class="grid grid-cols-12">
            @foreach($degrees as $degree)
                <div class="col-span-6  sm:col-span-3 bg-white p-5 m-2 shadow rounded-3xl">
                    <div class="grid grid-cols-12">
                        <div class="col-span-12 sm:col-span-4">
                            <div class="flex h-full items-center">
                                <a href="{{route('degrees.show', $degree)}}">
                                    <img class="rounded-3xl" src="{{$degree->image}}"
                                         alt="{{$degree->title}}">
                                </a>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-8 p-3">
                            <h3 class="text-main font-extrabold text-lg "><a
                                        href="{{route('degrees.show' , $degree)}}">{{$degree->title}}</a>
                            </h3>
                            <ul class="mt-2">
                                <li>
                                    <span><i class="fa fa-book"></i><b class="mr-2 ">{{count($degree->courses)}} دوره </b></span>
                                </li>
                            </ul>
                            <div class="flex justify-end">
                                <a class="bg-primary  hover:bg-primary100 py-2 px-3 rounded text-white duration-500 text-sm mt-3" href="{{route('degrees.show', $degree)}}">مشاهده</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
@endsection
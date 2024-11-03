@extends('home.layouts.main.master')
@section('content')
    <div class="container mx-auto ">
        <div class="bg-white shadow-lg p-4 mt-4 rounded-lg">
            <a href="{{route('course.show' , $course)}}" class="text-gray-400 text-xs">
                <i class="fa fa-angle-right"></i>
                برگشت به صفحه دوره ی {{$course->title}}
            </a>
            <h1 class="font-extrabold text-2xl mt-3 text-main">{{$headline->title}}</h1>
        </div>
    </div>


    <div class="container mx-auto mt-3 ">
        <div class="bg-white shadow-lg p-4 mt-4 rounded-lg">


            <div class="grid grid-cols-12">
                <div class="col-span-12 sm:col-span-9 ">
                    @auth
                        <video class="rounded-lg" width="100%" controls poster="{{$course->image}}">
                            <source src="{{ $headline->video }}" type="video/mp4">
                            مرورگر شما از تگ ویدیو پشتیبانی نمی‌کند.
                        </video>
                    @endauth

                    @guest
                        <div class="w-full flex items-center justify-center  h-full p-3 rounded-lg">
                                <img class="h-16 sm:h-44 mx-3 " src="/assets/home/image/login.webp"
                                     alt="ورود / ثبت نام در پلتفرم آموزشی حلزون">
                                <div>
                                    برای دسترسی به دوره، ابتدا
                                    <a class="text-primary100 font-bold underline" href="{{route('login')}}"> ورود/ثبت نام </a>کنید.
                                </div>
                        </div>
                    @endguest
                </div>


                <div class="col-span-12 sm:col-span-3 mr-3 border rounded-lg h-full p-3 shadow">
                    <h3 class="bg-main25 rounded p-3 font-bold">
                        <i class="fa fa-book"></i> دیگر سرفصل ها </h3>
                    <ul>

                        @foreach($course->headlines as $part)
                            <li class="border-2 rounded p-3 my-2 {{url()->current() == route('headline.show' , [$course , $part]) ? 'bg-gray-200' : ''}}">
                                <div class="grid grid-cols-12">
                                    <div class="col-span-10">
                                        <a href="{{route('headline.show' , [$course,$part])}}">
                                            {{$part->title}}
                                        </a>
                                    </div>
                                    <div class="col-span-2">
                                        @if($part->is_free == 1)
                                            <div class="bg-green-700 p-1 h-8 w-8 rounded-full text-white text-center  ">
                                                <i class="fa fa-lock-open"></i>
                                            </div>
                                        @else
                                            <div class="bg-red-500 p-1 h-8 w-8 rounded-full text-white text-center ">
                                                <i class="fa fa-lock"></i>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </li>

                        @endforeach
                    </ul>

                </div>


            </div>


        </div>
    </div>

@endsection

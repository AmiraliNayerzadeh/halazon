@extends('home.layouts.main.master')

@section('content')
    <div class="bg-[#e9e5ef]">
        <div class="container mx-auto  ">
            <div class="flex h-full w-full justify-center items-center py-7 ">
                <div>
                    <nav aria-label="breadcrumb" class="w-full flex justify-center items-center">
                        <ol class="flex flex-wrap items-center justify-center w-full py-2">
                            <li class="flex items-center  text-sm  text-main50 hover:text-main">
                                <a href="{{route('home')}}">صفحه اصلی</a>
                            </li>
                            <span class="text-sm mx-2 "><li class="fa fa-angle-left"></li></span>

                            <li class="flex items-center  text-sm  text-main50 hover:text-main font-extrabold">
                                <a href="{{route('blog.index')}}">مجله</a>
                            </li>
                            <span class="text-sm mx-2"><li class="fa fa-angle-left"></li></span>

                            <li class="flex items-center  text-sm  text-main50 hover:text-main font-extrabold">
                                <a href="#">{{$category->title}}</a>
                            </li>
                        </ol>
                    </nav>

                    <h1 class="text-main100 font-extrabold text-4xl text-center">{{$category->title}}</h1>

                    @if(!is_null($category->meta_description))
                    <p class="text-center mt-4">{{$category->meta_description}}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="relative  -z-10 mb-5">
        <img class="w-full" src="/assets/home/triangle-up.svg" alt="halazon hr">
    </div>

    <div class="container mx-auto">
        <div class="grid grid-cols-12">
            @foreach($blogs as $blog)
                <div class="col-span-12 sm:col-span-3 rounded-2xl p-2 border shadow my-3 mx-4">
                    <div class="p-1">
                        <div>
                            <a href="{{route('blog.show' , ['category' => $blog->categories[0]->slug, 'blog' => $blog->slug])}}"><img
                                        class="rounded-2xl" src="{{$blog->image}}" alt="{{$blog->title}}"></a></div>

                        <h3 class="mt-4 font-extrabold text-lg hover:text-main duration-500"><a
                                    href="{{route('blog.show' , ['category' => $blog->categories[0]->slug, 'blog' => $blog->slug])}}">{{$blog->title}}</a>
                        </h3>

                        {{--Category--}}
                        <div class="flex items-center my-3 border-t pt-4">
                            <h5 class="font-extrabold ">
                                <i class="fa fa-file"></i>
                                دسته بندی:</h5>
                            <span class="mx-1">
                                <a class="text-sm bg-main25 p-1 rounded truncate" href="{{route('blog.category' , $blog->categories[0])}}">{{$blog->categories[0]->title}}</a>
                            </span>
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
    </div>

@endsection
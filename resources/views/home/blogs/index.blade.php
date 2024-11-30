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
                                <a href="#">مجله</a>
                            </li>
                        </ol>
                    </nav>

                    <h1 class="text-main100 font-extrabold text-4xl">مجله حلزون</h1>

                </div>
            </div>
        </div>
    </div>
    <div class="relative  -z-10 mb-5">
        <img class="w-full" src="/assets/home/triangle-up.svg" alt="halazon hr">
    </div>

    <div class="container mx-auto my-4 ">
        <h3 class="text-lg my-5 text-center font-bold text-main">دسته بندی مقاله ها:</h3>
        <div class="swiper" id="main">
            <div class="swiper-wrapper">
                @foreach(\App\Models\Category::where('parent_id' , null)->get() as $category)
                    <div class="swiper-slide">
                        <div class="flex h-full w-full items-center justify-center">
                            <div>
                                <div class="flex justify-center">
                                    <a class="my-2" href="{{route('blog.category' , $category)}}"><img
                                                class="h-24 w-24 rounded-full object-cover" src="{{$category->image}}"
                                                alt="{{$category->title}}"></a>
                                </div>
                                <h3 class="text-center mt-2 text-primary"><a
                                            href="{{route('blog.category' , $category)}}">{{$category->title}}</a></h3>
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
                                <a class="text-sm bg-main25 p-1 rounded truncate"
                                   href="{{route('blog.category' , $blog->categories[0])}}">{{$blog->categories[0]->title}}</a>
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
                        slidesPerView: 4,
                        spaceBetween: 10,
                    },
                    1200: {
                        slidesPerView: 5,
                        spaceBetween: 10,
                    },
                },
            });
        </script>

    @endsection
@endsection
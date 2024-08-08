@extends('home.layouts.main.master')
@section('content')
    <div class="bg-main25">
        <div class="container mx-auto">
            <div class="grid grid-cols-12 py-5">
                <div class="col-span-12 sm:col-span-6">
                    <div class="grid grid-cols-6 bg-white shadow rounded-3xl p-3">


                        <div class="col-span-6 sm:col-span-3">
                            <div class="flex items-center justify-center">
                                <img class="rounded-3xl h-40 border border-2 border-main" src="{{$user->avatar}}"
                                     alt="{{$user->name}} {{$user->family}}">
                            </div>
                            <h1 class="text-main100 font-extrabold text-2xl text-center my-3">{{$user->name}} {{$user->family}}</h1>
                            <div class="flex items-center justify-center text-lg"><i
                                        class="fa fa-star text-yellow-400 ml-2"></i><b>4.9</b><small>(134)</small></div>
                            @if(count($user->categories))
                                <div class="mt-2 flex items-center justify-center ">
                                    @foreach($user->categories as $category)
                                        <a class="bg-main25 mx-1 rounded-3xl px-2 py-1 text-sm"
                                           href="{{route('category' , $category)}}">
                                            <bdi>{{$category->title}}</bdi>
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <div class="flex h-full w-full items-center justify-center">
                                @if( !is_null(auth()->user()) && Auth::user()->following->contains($user->id))
                                    <form class="w-full flex justify-center mt-3 " method="post"
                                          action="{{ route('teacher.unfollow', $user) }}">
                                        @csrf
                                        @method('POST')
                                        <button type="submit"
                                                class="border w-3/4 text-center py-3 border-main rounded-3xl hover:bg-main25 duration-500 ">
                                            <i class="fa fa-user-minus ml-2"></i>لغو دنبال کردن
                                        </button>
                                    </form>
                                @else
                                    <form class="w-full flex justify-center mt-3" method="post"
                                          action="{{route('teacher.fallow' , $user)}}">
                                        @csrf
                                        @method('POST')
                                        <button type="submit"
                                                class="border w-3/4 text-center py-3 border-main rounded-3xl hover:bg-main25 duration-500 ">
                                            <i class="fa fa-user-plus"></i>دنبال کردن
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-span-12 sm:col-span-6">
                    <div class="flex items-center justify-end">
                        <video class="h-80 rounded-3xl" controls>
                            <source src="{{$user->video}}" type="video/mp4">
                            <source src="{{$user->video}}" type="video/ogg">
                            مروگر شما از ویدیو پیشتیبانی نمی کند... .
                        </video>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{--description--}}
    <div class="container mx-auto mt-8">
        <div class="grid grid-cols-12">
            <div class="col-span-12 sm:col-span-8">
                <h2 class="font-extrabold text-2xl">درباره ی {{$user->name}} {{$user->family}}</h2>
                <article class="prose max-w-none my-3 ">
                    {!! $user->description !!}
                </article>
                <ul>
                    <li class="my-4">
                        <i class="fa fa-book"></i>
                        <span class="text-primary font-extrabold text-lg">{{count($user->courses)}}</span>
                        کلاس اجرا شده
                    </li>
                    <li class="my-4">
                        <i class="fa fa-calendar"></i>
                        ملحق شده از:
                        <span class="text-primary font-extrabold text-lg">{{jdate($user->created_at)->ago()}}</span>
                    </li>
                </ul>
            </div>

            <div class="col-span-12 sm:col-span-4">
                <div class="rounded-3xl shadow p-4">
                    <h3 class="text-main100 font-extrabold border-b border-main pb-4">کلاس
                        های {{$user->name}} {{$user->family}}</h3>

                    @if(count($user->courses))
                        <ul>
                            @foreach($user->courses->take(3) as $course)
                                <li class="my-4">
                                    <div class="grid grid-cols-6">
                                        <div class="col-span-2">
                                            <a href="{{route('course.show' , $course)}}">
                                                <img class="rounded-3xl h-20" src="{{$course->image}}"
                                                     alt="{{$course->title}}">
                                            </a>
                                        </div>
                                        <div class="col-span-4">
                                            <a class="font-extrabold hover:text-main100 duration-500"
                                               href="{{route('course.show' , $course)}}">{{$course->title}}</a>
                                            <p class="text-sm text-gray-600 mt-2">
                                                <i class="fa fa-user-group ml-1"></i>رده سنی:
                                                <span>{{$course->age_from}} الی {{$course->age_to}} سال </span>
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-red-600 mt-4">متاسفانه هنوز کلاسی برای {{$user->name}} {{$user->family}} وجود
                            ندارد.. .</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
    {{--End description--}}


    <div class="mt-7 bg-gray-100">
        <div class="container mx-auto py-4">
            <div class="flex justify-between items-center">
                <h4 class="font-extrabold text-2xl py-5">نظرات</h4>
                <a class="bg-main25 py-2 px-3 rounded-3xl border border-main text-main100" href="#">ایجاد نظر جدید</a>
            </div>

            <div class="grid grid-cols-12">


                <div class="col-span-12 sm:col-span-6 bg-main25 rounded-3xl p-4 m-4">
                    <div class="flex items-center justify-between py-3">
                        <div class="flex items-center">
                            <img class="h-16" src="/assets/user-avatar.png" alt="">
                            <div class="mr-3 pt-2">
                                <h5 class=" text-main100 font-extrabold">فرزین فرزاد</h5>
                                <span>امتیاز:</span>
                                <l class="fa fa-star text-yellow-400 "></l>
                                <l class="fa fa-star text-yellow-400 "></l>
                                <l class="fa fa-star text-yellow-400 "></l>
                                <l class="fa fa-star text-yellow-400 "></l>
                                <l class="fa fa-star text-yellow-400 "></l>
                            </div>

                        </div>
                        <div>
                            <span class="text-gray-500"><i class="fa fa-calendar-day"></i>  3/4/1403</span>
                        </div>
                    </div>
                    <div class="border-t border-main pt-4">
                        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد، در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها، و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.
                    </div>
                </div>

                <div class="col-span-12 sm:col-span-6 bg-main25 rounded-3xl p-4 m-4">
                    <div class="flex items-center justify-between py-3">
                        <div class="flex items-center">
                            <img class="h-16" src="/assets/user-avatar.png" alt="">
                            <div class="mr-3 pt-2">
                                <h5 class=" text-main100 font-extrabold">فرزین فرزاد</h5>
                                <span>امتیاز:</span>
                                <l class="fa fa-star text-yellow-400 "></l>
                                <l class="fa fa-star text-yellow-400 "></l>
                                <l class="fa fa-star text-yellow-400 "></l>
                                <l class="fa fa-star text-yellow-400 "></l>
                                <l class="fa fa-star text-yellow-400 "></l>
                            </div>

                        </div>
                        <div>
                            <span class="text-gray-500"><i class="fa fa-calendar-day"></i>  3/4/1403</span>
                        </div>
                    </div>
                    <div class="border-t border-main pt-4">
                        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد، در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها، و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.
                    </div>
                </div>



            </div>
        </div>
    </div>

@endsection
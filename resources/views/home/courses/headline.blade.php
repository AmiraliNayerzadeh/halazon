@extends('home.layouts.main.master')
@section('content')


    <div class="container mx-auto p-2">
        <div class="p-2 mt-4 bg-white rounded-lg shadow ">
            <a href="{{route('course.show' , $course)}}" class="text-gray-400 text-xs">
                <i class="fa fa-angle-right"></i>
                برگشت به صفحه دوره ی {{$course->title}}
            </a>
            <h1 class="font-extrabold text-2xl mt-3 text-main">{{$headline->title}}</h1>
        </div>
    </div>

    <div class="container mx-auto mt-1 ">
        <div class="p-2 rounded-lg">

            <div class="grid grid-cols-12">
                <div class="col-span-12 sm:col-span-9 bg-white shadow rounded-lg">
                    @auth

                        @if(auth()->user()->hasAccessToCourse($course->id) || $headline->is_free == 1)


                            @if(is_null($headline->arvan_video_player))
                                <video class="rounded-lg " width="100%" controls poster="{{$course->image}}">
                                    <source src="{{ $headline->video }}" type="video/mp4">
                                    مرورگر شما از ویدیو پشتیبانی نمی‌کند.
                                </video>
                            @else
                                @include('.iFrameArvan' ,  ['video' => $headline->arvan_video_player])
                            @endif



                            <div class="mx-1 my-2 p-4 border-t border-dashed">
                                <div class="grid grid-cols-12">
                                    <div class="col-span-6 sm:col-span-3">
                                        <a class="px-1 sm:px-3 py-2 rounded bg-blue-200 text-blue-600 text-sm sm:text-base"
                                           href="{{$headline->video}}">
                                            <i class="fa fa-download"></i> دانلود
                                        </a>
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <a class="px-1 sm:px-3 py-2 rounded bg-yellow-200 text-yellow-700  text-sm sm:text-base">
                                            <i class="fa fa-comment-alt"></i>
                                            {{count($headline->comments)}}
                                            پرسش/دیدگاه
                                        </a>
                                    </div>
                                </div>
                            </div>

                        @else

                            <div class="w-full flex items-center justify-center  h-full p-3 rounded-lg">
                                <div class="text-center">
                                    <i class=" text-gray-700 fa fa-user-lock fa-7x p-3 rounded-full "></i>
                                    <div>
                                        <p class="text-lg mt-4">
                                            برای دسترسی به محتوا، ابتدا باید این دوره را تهیه کنید.
                                        </p>

                                        <form class="w-full" action="{{route('cart.store')}}" method="post">
                                            @csrf
                                            @method('POST')
                                            <input type="hidden" name="course" value="{{ $course->id }}">
                                            <button class=" my-2 w-full  py-2 border border-green-400 shadow text-green-500 rounded-lg hover:bg-green-200 duration-500"
                                                    type="submit">
                                                <i class="fa fa-plus"></i>
                                                افزودن به سبد خرید.
                                            </button>
                                        </form>


                                    </div>
                                </div>
                            </div>

                        @endif

                    @endauth

                    @guest
                        <div class="w-full flex items-center justify-center  h-full p-3 rounded-lg">
                            <img class="h-16 sm:h-44 mx-3 " src="/assets/home/image/login.webp"
                                 alt="ورود / ثبت نام در پلتفرم آموزشی حلزون">
                            <div>
                                برای دسترسی به دوره، ابتدا
                                <a class="text-primary100 font-bold underline" href="{{route('login')}}"> ورود/ثبت
                                    نام </a>کنید.
                            </div>
                        </div>
                    @endguest
                </div>
                <div class="col-span-12 sm:col-span-3 sm:mr-3 border rounded-lg h-full p-3 shadow mt-3 sm:mt-0 bg-white">
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
                                        @if((auth()->check() && auth()->user()->hasAccessToCourse($course->id)) || $part->is_free == 1)
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



    <div class="container mx-auto  ">
        <div class="mt-2 rounded-lg">
            <div class="grid grid-cols-12">
                <div class="col-span-12 sm:col-span-9">
                    @if(!is_null($headline->description))
                        <div class=" bg-white shadow rounded-lg p-2">
                            <h3 class="text-2xl font-extrabold text-main mb-2">
                                <i class="fa fa-pencil-alt"></i>
                                توضیحات این قسمت</h3>
                            <p>{{$headline->description}}</p>
                        </div>
                    @endif
                    <div class=" bg-white shadow rounded-lg p-3 mt-3">
                        {{--Comment Section--}}
                        <div class="container mx-auto">
                            <div class="flex justify-between items-center">
                                <h4 class="font-extrabold text-2xl py-5 text-main">
                                    <i class="fa fa-comment-alt mx-1"></i>پرسش/دیدگاه</h4>

                                @if((auth()->check() && auth()->user()->hasAccessToCourse($course->id)) || $headline->is_free == 1)

                                    <button id="comment"
                                            class="bg-main50 text-white py-2 px-3 rounded-2xl border border-main hover:bg-main25 hover:text-main100 duration-700">
                                        <i class="fa fa-plus mx-1"></i>ایجاد نظر جدید
                                    </button>
                                @endif

                                <!--Comment Modal -->
                                <div id="myModal"
                                     class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center">
                                    <div class="bg-white p-6 rounded-lg shadow-lg max-w-2xl w-full">
                                        <h2 class="text-xl font-extrabold mb-4 text-main">
                                            <i class="fa fa-plus mx-1"></i>ایجاد نظر جدید</h2>

                                        <hr class="my-2">

                                        @auth
                                            <form action="{{route('comment.store')}}" method="POST">
                                                @csrf
                                                @method('POST')
                                                <input type="hidden" name="type" value="{{get_class($headline)}}">
                                                <input type="hidden" name="id" value="{{$headline->id}}">
                                                <div class="max-w-2xl mx-auto ">
                                                    <!-- Comment -->
                                                    <div class="mb-4">
                                                        <label for="comment"
                                                               class="block text-gray-700  font-extrabold mb-2">متن
                                                            نظر:</label>
                                                        <textarea id="comment" name="comment" rows="3"
                                                                  class="rounded w-full py-2 px-3 text-gray-700 "
                                                                  required></textarea>
                                                    </div>

                                                    <!-- Score -->
                                                    <div class="mb-2">
                                                        <label class="block text-gray-700 font-extrabold ">امتیاز:</label>

                                                        <!-- Rating -->
                                                        <div class="rating">
                                                            <input type="radio" id="star5" name="score" value="5"/>
                                                            <label class="star" for="star5" title="Awesome"
                                                                   aria-hidden="true"></label>
                                                            <input type="radio" id="star4" name="score" value="4"/>
                                                            <label class="star" for="star4" title="Great"
                                                                   aria-hidden="true"></label>
                                                            <input type="radio" id="star3" name="score" value="3"/>
                                                            <label class="star" for="star3" title="Very good"
                                                                   aria-hidden="true"></label>
                                                            <input type="radio" id="star2" name="score" value="2"/>
                                                            <label class="star" for="star2" title="Good"
                                                                   aria-hidden="true"></label>
                                                            <input type="radio" id="star1" name="score" value="1"/>
                                                            <label class="star" for="star1" title="Bad"
                                                                   aria-hidden="true"></label>
                                                        </div>
                                                        <!-- End Rating -->
                                                    </div>

                                                </div>

                                                <hr class="my-3">


                                                <div class="flex justify-end ">
                                                    <button id="closeModalButton"
                                                            class="px-4 mx-2 py-2 bg-red-500 text-white rounded-lg">بستن
                                                    </button>

                                                    <button type="submit"
                                                            class="bg-green-500 hover:bg-green-700 duration-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                                        ثبت نظر
                                                    </button>
                                                </div>

                                            </form>

                                        @endauth
                                        @guest
                                            <div class="mb-5">
                                                <p>برای درج نظر ابتدا باید وارد حساب کاربری خود شوید.</p>
                                            </div>
                                            <div class="flex justify-end">
                                                <button id="closeModalButton"
                                                        class="px-4 mx-2 py-2 bg-red-500 text-white rounded-lg">بستن
                                                </button>


                                                <a class="bg-green-400 border border-green-500 px-3 py-2 rounded-lg hover:bg-green-800 dark:hover:text-white duration-700 "
                                                   href="{{route('login')}}">
                                                    <i class="fa fa-user mx-1"></i>
                                                    ورود به حساب کاربری </a>

                                            </div>
                                        @endguest

                                    </div>
                                </div>

                            </div>
                            @if(count($headline->comments->where('status' , 1)->where('parent' , null))> 0)
                                <div class="grid grid-cols-12">

                                    @foreach($headline->comments->where('status' , 1)->where('parent' , null) as $comment)
                                        <div class="col-span-12 sm:col-span-12 bg-main25 rounded-3xl p-4 m-4">
                                            <div class="flex items-center justify-between py-3">
                                                <div class="flex items-center">
                                                    @if(is_null($comment->user->avatar))
                                                        <img class="h-16 rounded-2xl" src="/assets/user-avatar.png"
                                                             alt="{{$comment->user->name}} {{$comment->user->family}}">
                                                    @else
                                                        <img class="h-16 rounded-2xl" src="{{$comment->user->avatar}}"
                                                             alt="{{$comment->user->name}} {{$comment->user->family}}">
                                                    @endif
                                                    <div class="mr-3 pt-2">
                                                        <h5 class=" text-main100 font-extrabold mb-2">{{$comment->user->name}} {{$comment->user->family}}</h5>
                                                        @if($comment->score != null)
                                                            <span>امتیاز:</span>
                                                            <small>({{$comment->score}} / 5)</small>
                                                            <i class="fa fa-star {{$comment->score >= 1 ? 'text-yellow-500':'text-gray-400'}} "></i>
                                                            <i class="fa fa-star {{$comment->score >= 2 ? 'text-yellow-500':'text-gray-400'}} "></i>
                                                            <i class="fa fa-star {{$comment->score >= 3 ? 'text-yellow-500':'text-gray-400'}} "></i>
                                                            <i class="fa fa-star {{$comment->score >= 4 ? 'text-yellow-500':'text-gray-400'}} "></i>
                                                            <i class="fa fa-star {{$comment->score == 5 ? 'text-yellow-500':'text-gray-400'}} "></i>
                                                        @endif
                                                    </div>

                                                </div>
                                                <div>
                                                    <span class="text-gray-500"><i class="fa fa-calendar-day mx-1"></i>{{jdate($comment->created_at)->ago()}}</span>
                                                </div>
                                            </div>
                                            <div class="border-t border-main pt-4">
                                                {{$comment->comment}}
                                            </div>
                                            @if(count($comment->childs))
                                                @foreach($comment->childs as $child)

                                                    <div class="flex items-center">
                                                        <div>
                                                            <i class="fa fa-reply"></i>
                                                        </div>
                                                        <div class="bg-gray-200 w-full p-2 rounded-3xl mt-2 mr-2">
                                                            <div class="flex items-center justify-between py-3">
                                                                <div class="flex items-center">
                                                                    @if(is_null($child->user->avatar))
                                                                        <img class="h-16 rounded-2xl"
                                                                             src="/assets/user-avatar.png"
                                                                             alt="{{$child->user->name}} {{$child->user->family}}">
                                                                    @else
                                                                        <img class="h-16 rounded-2xl"
                                                                             src="{{$child->user->avatar}}"
                                                                             alt="{{$child->user->name}} {{$child->user->family}}">
                                                                    @endif
                                                                    <div class="mr-3 pt-2">
                                                                        <h5 class=" text-main100 font-extrabold mb-2">{{$child->user->name}} {{$child->user->family}}
                                                                            <small class="text-gray-400">
                                                                                در پاسخ
                                                                                به {{$comment->user->name}} {{$comment->user->family}}
                                                                            </small>
                                                                        </h5>
                                                                    </div>

                                                                </div>
                                                                <div>
                                                                    <span class="text-gray-500"><i
                                                                                class="fa fa-calendar-day mx-1"></i>{{jdate($child->created_at)->ago()}}</span>
                                                                </div>
                                                            </div>

                                                            <div class="border-t border-main pt-4">
                                                                {!! $child->comment !!}
                                                            </div>
                                                        </div>
                                                    </div>

                                                @endforeach
                                            @endif
                                        </div>
                                    @endforeach

                                </div>
                            @else
                                <div>
                                    <p class="text-gray-400 max-w-none">هنوز دیدگاهی ثبت نشده! اولین نفری باشید که
                                        دیدگاه ثبت میکند.</p>
                                </div>
                            @endif
                        </div>
                        {{--End comment--}}

                    </div>

                </div>

                <div class="col-span-12 sm:col-span-3 sm:mr-3 border rounded-lg h-full p-3 shadow mt-3 sm:mt-0 bg-white">
                    <div class="flex items-center justify-center">
                        <img class="rounded-full h-24 w-24" src="{{$course->teacher->avatar}}"
                             alt="{{$course->teacher->name}} {{$course->teacher->family}}">
                    </div>
                    <h4 class="text-center my-4"><span
                                class="text-primary font-semibold">مدرس دوره: </span>
                        <a href="{{route('teacher.show', $course->teacher)}}">
                            {{$course->teacher->name}} {{$course->teacher->family}}
                        </a>
                    </h4>

                    <hr class="border-dashed">

                    <ul class="my-3 space-y-2">

                        <li>
                            <span class="text-gray-400">تعداد جلسه:</span>
                            <span>{{count($course->headlines)}}</span>
                        </li>


                        <li>
                            <span class="text-gray-400">تعداد شرکت کننده:</span>
                            <span>{{count($course->userCourses)}} نفر</span>
                        </li>

                        <li>
                            <span class="text-gray-400">تاریخ انتشار دوره:</span>
                            <span>{{jdate($course->created_at)->toDateString()}}</span>
                        </li>

                        <li>
                            @foreach($course->categories as $category)
                            <a class="bg-main25 p-0.5 rounded" href="{{route('category' , $category)}}">{{$category->title}}</a>
                            @endforeach
                        </li>

                    </ul>

                </div>
            </div>

        </div>
    </div>


    @section('script')
        <script>
            const comment = document.getElementById('comment');
            const closeModalButton = document.getElementById('closeModalButton');
            const modal = document.getElementById('myModal');


            comment.addEventListener('click', () => {
                modal.classList.remove('hidden');
            });


            closeModalButton.addEventListener('click', () => {
                modal.classList.add('hidden');
            });


            window.addEventListener('click', (event) => {
                if (event.target === modal) {
                    modal.classList.add('hidden');
                }
            });

        </script>

        <style>
            .rating {
                border: none;
            }

            .rating > label {
                color: #90A0A3;
            }

            .rating > label:before {
                margin: 5px;
                font-size: 1.5em;
                font-family: "Font Awesome 5 Pro";
                content: "\f005";
                display: inline-block;
            }

            .rating > input {
                display: none;
            }

            .rating > input:checked ~ label,
            .rating:not(:checked) > label:hover,
            .rating:not(:checked) > label:hover ~ label {
                color: #F79426;
            }

            .rating > input:checked + label:hover,
            .rating > input:checked ~ label:hover,
            .rating > label:hover ~ input:checked ~ label,
            .rating > input:checked ~ label:hover ~ label {
                color: #FECE31;
            }
        </style>

    @endsection

@endsection

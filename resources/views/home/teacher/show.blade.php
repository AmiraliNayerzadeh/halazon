    @extends('home.layouts.main.master')
@section('content')

    @section('style')
        <!-- Persian Full Calendar -->
{{--        <link rel="stylesheet" href="/assets/home/plugins/persian-fullcalendar/css/font.css">--}}
        <link rel="stylesheet" href="/assets/home/plugins/persian-fullcalendar/css/fullcalendar.css">
        <link rel="stylesheet" href="/assets/home/plugins/persian-fullcalendar/css/fullcalendar.print.min.css"
              media='print'>
    @endsection


    <div class="bg-main25">
        <div class="container mx-auto">
            <div class="grid grid-cols-12 py-5">
                <div class="col-span-12 sm:col-span-6">
                    <div class="flex items-center h-full ">
                        <div class="grid grid-cols-6 bg-white shadow rounded-3xl p-3 w-full h-full">

                            <div class="col-span-6 sm:col-span-3">
                                <div class="flex items-center justify-center h-full ">
                                    <div>
                                        <div class="flex items-center justify-center">
                                            <img class="rounded-3xl h-40 border border-2 border-main" src="{{$user->avatar}}"
                                                 alt="{{$user->name}} {{$user->family}}">
                                        </div>
                                        <h1 class="text-main100 font-extrabold text-2xl text-center my-3">{{$user->name}} {{$user->family}}</h1>
                                        <div class="flex items-center justify-center text-lg"><i
                                                    class="fa fa-star text-yellow-400 ml-2"></i><b>4.9</b><small>(134)</small>
                                        </div>
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
                                </div>
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
                <div class="rounded-3xl shadow p-4 sticky top-0">
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


    {{--Comment Section--}}
    <div class="mt-7 bg-gray-100">
        <div class="container mx-auto py-4">
            <div class="flex justify-between items-center">
                <h4 class="font-extrabold text-2xl py-5">
                    <i class="fa fa-comment-alt mx-1"></i>نظرات</h4>
                <button id="comment" class="bg-main50 text-white py-2 px-3 rounded-2xl border border-main hover:bg-main25 hover:text-main100 duration-700"><i class="fa fa-plus mx-1"></i>ایجاد نظر جدید</button>

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
                                <input type="hidden" name="type" value="{{get_class($user)}}">
                                <input type="hidden" name="id" value="{{$user->id}}">
                                <div class="max-w-2xl mx-auto ">
                                    <!-- Comment -->
                                    <div class="mb-4">
                                        <label for="comment" class="block text-gray-700  font-extrabold mb-2">متن نظر:</label>
                                        <textarea id="comment" name="comment" rows="3" class="rounded w-full py-2 px-3 text-gray-700 " required></textarea>
                                    </div>

                                    <!-- Score -->
                                    <div class="mb-2">
                                        <label class="block text-gray-700 font-extrabold ">امتیاز:</label>

                                        <!-- Rating -->
                                        <div class="rating">
                                            <input type="radio" id="star5" name="score" value="5"/>
                                            <label class="star" for="star5" title="Awesome" aria-hidden="true"></label>
                                            <input type="radio" id="star4" name="score" value="4"/>
                                            <label class="star" for="star4" title="Great" aria-hidden="true"></label>
                                            <input type="radio" id="star3" name="score" value="3"/>
                                            <label class="star" for="star3" title="Very good" aria-hidden="true"></label>
                                            <input type="radio" id="star2" name="score" value="2"/>
                                            <label class="star" for="star2" title="Good" aria-hidden="true"></label>
                                            <input type="radio" id="star1" name="score" value="1"/>
                                            <label class="star" for="star1" title="Bad" aria-hidden="true"></label>
                                        </div>
                                        <!-- End Rating -->
                                    </div>

                                </div>

                                <hr class="my-3">


                                <div class="flex justify-end ">
                                    <button id="closeModalButton" class="px-4 mx-2 py-2 bg-red-500 text-white rounded-lg">بستن</button>

                                    <button type="submit" class="bg-green-500 hover:bg-green-700 duration-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">ثبت نظر</button>
                                </div>

                            </form>

                        @endauth
                        @guest
                            <div class="mb-5">
                                <p>برای درج نظر ابتدا باید وارد حساب کاربری خود شوید.</p>
                            </div>
                            <div class="flex justify-end">
                                <a class="bg-green-400 border border-green-500 px-3 py-2 rounded-2xl hover:bg-green-800 dark:hover:text-white duration-700 " href="{{route('login')}}">
                                    <i class="fa fa-user mx-1"></i>
                                    ورود به حساب کاربری </a>
                            </div>

                        @endguest

                    </div>
                </div>

            </div>
            @if(count($user->getComments->where('status' , 1)->where('parent' , null))> 0)
                <div class="grid grid-cols-12">

                    @foreach($user->getComments->where('status' , 1)->where('parent' , null) as $comment)
                        <div class="col-span-12 sm:col-span-6 bg-main25 rounded-3xl p-4 m-4">
                            <div class="flex items-center justify-between py-3">
                                <div class="flex items-center">

                                    @if(is_null($comment->user->avatar))
                                    <img class="h-16 rounded-2xl" src="/assets/user-avatar.png" alt="{{$comment->user->name}} {{$comment->user->family}}">
                                    @else
                                    <img class="h-16 rounded-2xl" src="{{$comment->user->avatar}}" alt="{{$comment->user->name}} {{$comment->user->family}}">
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
                                                        <img class="h-16 rounded-2xl" src="/assets/user-avatar.png" alt="{{$child->user->name}} {{$child->user->family}}">
                                                    @else
                                                        <img class="h-16 rounded-2xl" src="{{$child->user->avatar}}" alt="{{$child->user->name}} {{$child->user->family}}">
                                                    @endif
                                                    <div class="mr-3 pt-2">
                                                        <h5 class=" text-main100 font-extrabold mb-2">{{$child->user->name}} {{$child->user->family}}
                                                            <small class="text-gray-400">
                                                                در پاسخ به  {{$comment->user->name}} {{$comment->user->family}}
                                                            </small>
                                                        </h5>
                                                    </div>

                                                </div>
                                                <div>
                                                    <span class="text-gray-500"><i class="fa fa-calendar-day mx-1"></i>{{jdate($child->created_at)->ago()}}</span>
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
                    <p class="text-gray-400 max-w-none">هنوز دیدگاهی ثبت نشده! اولین نفری باشید که دیدگاه ثبت میکند.</p>
                </div>
            @endif
        </div>
    </div>
    {{--End comment--}}


    {{--Calender Section--}}
    <div class="mt-7">
        <div class="container mx-auto py-4">
            <div class="flex justify-between items-center">
                <h4 class="font-extrabold text-2xl py-5">تقویم</h4>
            </div>
            <div id='Calendar'></div>

        </div>
    </div>
    {{--End Calender--}}

    {{--Course Section--}}
    <div class="mt-7 bg-gray-100">
        <div class="container mx-auto py-4">
            <div class="flex justify-between items-center">
                <h4 class="font-extrabold text-2xl py-5">همه کلاس های {{$user->name}} {{$user->family}} </h4>
            </div>

            <div class="grid grid-cols-12">
                @foreach($user->courses as $course)
                    <div class="col-span-12 sm:col-span-3 rounded-2xl p-2 border shadow my-3 mx-4">
                        <div class="p-1">
                            <div><a href="{{route('course.show' , $course)}}"><img class="rounded-2xl" src="{{$course->image}}" alt="{{$course->title}}"></a>
                            </div>

                            <h5 class="mt-4 font-extrabold text-2xl hover:text-main duration-500"><a
                                        href="{{route('course.show' , $course)}}">{{$course->title}}</a></h5>



                            {{--Info--}}

                                <div class=" mt-2  mx-1 bg-main25 shadow rounded-2xl">
                                    <div class="flex h-full items-center justify-center py-2 text-center">
                                        {{number_format(($course->price - $course->discount_price) / $course->class_duration )}}
                                        تومان هر جلسه
                                    </div>
                                </div>
                            {{--End Info--}}


                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    {{--End Course--}}







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











        <!-- jQuery -->
        <script src="/assets/home/plugins/jquery/jquery.min.js"></script>

        <script src="/assets/home/plugins/persian-fullcalendar/js/moment.min.js"></script>
        <script src="/assets/home/plugins/persian-fullcalendar/js/moment-jalaali.js"></script>

        <script src="/assets/home/plugins/persian-fullcalendar/js/fullcalendar.min.js"></script>
        <script src="/assets/home/plugins/persian-fullcalendar/js/fa.js"></script>

        <script>
            $(document).ready(function () {

                $('#Calendar').fullCalendar({
                    height: 800,
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,basicWeek,basicDay'
                    },

                    locale: 'fa',
                    isJalaali: true,
                    isRTL: true,
                    navLinks: true, // can click day/week names to navigate views
                    editable: false,
                    eventLimit: true, // allow "more" link when too many events
                    events: [

                            @foreach($user->schedules as $time )

                            @php
                                $startDatetime = \Carbon\Carbon::parse($time->start_date . ' ' . $time->start_time)->format('Y-m-d\TH:i:s');

                                $endDatetime = \Carbon\Carbon::parse($time->start_date . ' ' . $time->start_time)->addMinutes(30)->format('Y-m-d\TH:i:s');

                                $color = $time->start_date > now() ? '#b0a5c1' : '#686868';
                            @endphp
                        {
                            id: "{{$time->id}}",
                            title: "{{$time->course->title}} ({{$time->parts->title}})",
                            start: "{{$startDatetime}}",
                            end: "{{$endDatetime}}",
                            url: "{{route('course.show', $time->course)}}",
                            backgroundColor: "{{$color}}"
                        },
                        @endforeach
                    ]

                });

            });

        </script>
    @endsection

@endsection

 @extends('home.layouts.main.master')

@section('content')
    <div class="bg-[#e9e5ef]">
        <div class="container mx-auto  ">
            <div class="grid grid-cols-12 ">
                <div class="col-span-12  sm:col-span-6 mr-4 my-4">
                    <div class="flex h-full  items-center ">
                        <div>
                            <h1 class="text-main100 font-extrabold text-4xl">{{$course->title}}</h1>

                            <div class="mt-6 mr-6">
                                <p>
                                    {{$course->meta_description}}
                                </p>
                            </div>


                        </div>
                    </div>
                </div>

                <div class="col-span-12 border sm:col-span-6  my-10">
                    <div class="flex align-items-center justify-center items-center">
                        @if(is_null($course->video))
                            <img class="rounded-3xl w-auto max-h-72 " src="{{!is_null($course->image) ? $course->image : '/assets/default-image.jpg'}}" alt="{{$course->title}}">
                        @else
                            <video  height="400" controls poster="{{$course->image}}" class="max-h-72 rounded-lg w-auto">
                                <source src="{{$course->video}}" type="video/mp4">
                                <source src="{{$course->video}}" type="video/ogg">
                                Your browser does not support the video tag.
                            </video>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="relative  -z-10 mb-5">
        <img class="w-full" src="/assets/home/wavessimpletop.svg" alt="halazon hr">
    </div>

    <div class="container mx-auto">
        <div class="grid grid-cols-12">
            <div class="col-span-12 sm:col-span-9 p-3 ">
                <article id="course-description"
                         class="prose max-w-none  max-h-96 overflow-hidden relative transition-all duration-300 ease-in-out">
                    {!! $course->description !!}
                </article>
                <div class="flex justify-center">
                    <button id="show-more"
                            class="mt-4 px-4 py-2  text-main50 hover:text-main100 transition duration-300">
                        <li class="fa fa-angles-down"></li>
                        نمایش بیشتر
                    </button>

                </div>


                <div class="w-full mt-7">
                    <div class="accordion">
                        <div class="accordion-item shadow-md mb-4 border border-main rounded-2xl">
                            <div class="accordion-header w-full text-right flex justify-between items-center p-4" >
                                <h3 class="text-main font-extrabold">سر فصل های {{$course->title}}</h3>
                                <i class="fas fa-chevron-down text-main"></i>
                            </div>
                            <div class="accordion-content bg-main25 rounded-b-2xl p-1 sm:p-4 ">

                                @foreach($course->headlines as $headline)

                                    <div class="w-full px-2 my-2">
                                        <div class="accordion">
                                            <div class="accordion-item bg-white shadow-md mb-4 border ">
                                                <button class="accordion-header w-full p-1 sm:p-4 text-sm sm:text-base"
                                                        onclick="toggleAccordion(event)">

                                                    <div class="grid grid-cols-12 text-right">
                                                        <div class="col-span-9">
                                                            <div class="flex items-center">
                                                                @if(!is_null($headline) && $headline->is_free == 1)
                                                                    <div class="bg-green-700 p-1 h-8 w-8 rounded-full text-white text-center ">
                                                                        <i class="fa fa-lock-open"></i>
                                                                    </div>
                                                                @else
                                                                    <div class="bg-red-500 p-1 h-8 w-8 rounded-full text-white text-center ">
                                                                        <i class="fa fa-lock"></i>
                                                                    </div>
                                                                @endif

                                                                <h4 class="text-main font-extrabold mr-1 sm:mr-3 truncate">
                                                                    <span class="text-primary">{{$headline->priority}})</span>
                                                                    {{$headline->title}}
                                                                </h4>
                                                            </div>

                                                        </div>

                                                        <div class="col-span-3 text-end">
                                                            <div class="flex items-center justify-end">
                                                                <a class="bg-gray-400 p-1 sm:p-2 rounded text-white sm:mx-4" href="{{route('headline.show' , [$course , $headline])}}">مشاهده</a>
                                                                <i class="fas fa-chevron-down text-main"></i>
                                                            </div>
                                                        </div>

                                                    </div>



                                                </button>
                                                <div class="accordion-content bg-gray-100 p-4 hidden">
                                                    @if(!is_null($headline) && $headline->is_free == 1)
                                                        <video width="100%" controls>
                                                            <source src="{{ $headline->video }}" type="video/mp4">
                                                            مرورگر شما از تگ ویدیو پشتیبانی نمی‌کند.
                                                        </video>

                                                    @endif

                                                    {{$headline->description}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>


                        </div>
                    </div>
                </div>



                <div class="w-full mt-7">
                    <div class="accordion">
                        <div class="accordion-item shadow-md mb-4 border border-main rounded-2xl">
                            <button class="accordion-header w-full text-right flex justify-between items-center p-4"
                                    onclick="toggleAccordion(event)">
                                <h4 class="text-main font-extrabold">درباره مدرس {{$course->title}}</h4>
                                <i class="fas fa-chevron-down text-main"></i>
                            </button>
                            <div class="accordion-content bg-main25 rounded-b-2xl p-4 hidden">
                                <div class="flex items-center">
                                    <img class="rounded-full h-20 w-20 border border-2 border-main "
                                         src="{{$course->teacher->avatar}}"
                                         alt="{{$course->teacher->name}} {{$course->teacher->family}}">
                                    <span class="mr-2">
                                        <a class="font-extrabold"
                                           href="{{route('teacher.show' , $course->teacher)}}">{{$course->teacher->name}} {{$course->teacher->family}}</a>
                                    </span>
                                </div>
                                @if(!is_null($course->teacher->description))
                                    <div class="prose max-w-none">
                                        {!! $course->teacher->description !!}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>


            </div>


            <div class="col-span-12 sm:col-span-3  ">

                <div class="rounded-2xl border border-main100 shadow space-y-4 mb-3 sticky top-0 ">
                    <div class="flex items-center justify-center bg-main25 py-4 rounded-t-2xl ">
                        <span class="font-extrabold text-lg text-main100">{{$course->type == 'offline'  ? 'کلاس ضبط شده' : 'کلاس آنلاین'}}</span>
                    </div>

                    <div class="p-3 border-b border-b-main ">
                        <div class="flex justify-center items-center">
                            @if($course->discount_price > 0)
                                <div class="ml-4">
                                    <b class="line-through decoration-red-600 ">{{number_format(($course->price))}}
                                        تومان </b>
                                </div>
                            @endif

                            <div>
                                <b class="font-extrabold text-2xl">{{number_format(($course->price - $course->discount_price))}}</b>
                                <span class="mr-1">تومان</span>
                            </div>
                        </div>
                        <div class="flex justify-center items-center">
                            <div>
                                <b class="text-gray-600 ">{{number_format(($course->price - $course->discount_price) / $course->class_duration )}}</b>
                            </div>
                            <span class="mr-1">تومان</span>
                            <small class="text-primary mr-1"> به ازای هر جلسه </small>
                        </div>
                    </div>


                    <div class="py-3 border-b border-b-mai mx-2 ">
                        <div class="flex  items-center my-3 ">
                            <div class="flex items-center">
                                <i class="ml-1 fa-regular fa-calendar-clock"></i>
                                <b class="ml-1">تعداد جلسات:</b>
                                <span>{{$course->class_duration}} </span>
                            </div>
                        </div>


                        <div class="flex  items-center  my-3 ">
                            <div class="flex items-center">
                                <i class="ml-1 fa-solid fa-timer"></i>
                                <b class="ml-1">زمان هر کلاس:</b>
                                <span>{{$course->minutes}} دقیقه </span>
                            </div>
                        </div>


                        <div class="flex  items-center  my-3 ">
                            <div class="flex items-center">
                                <i class="ml-1 fa-regular fa-calendar"></i>
                                <b class="ml-1">تعداد جلسه در هفته:</b>
                                <span>{{$course->weeks}} هفته </span>
                            </div>
                        </div>
                    </div>


                    <div class="py-3 border-b border-b-main mx-2 ">
                        <div class="flex  items-center my-3 ">
                            <div class="flex items-center">
                                <i class="ml-1 fa-regular fa-user-group"></i>
                                <b class="ml-1">رده سنی:</b>
                                @if($course->age_from == $course->age_to )
                                    مختص {{$course->age_from}} سال
                                @else
                                    <span> {{$course->age_from}} الی  {{$course->age_to}} سال </span>
                                @endif
                            </div>
                        </div>


                        <div class="flex  items-center  my-3 ">
                            <div class="flex items-center">
                                <i class="ml-1 fa-regular fa-square-user"></i>
                                <b class="ml-1">ظرفیت:</b>
                                <span>{{$course->capacity}} نفر </span>
                            </div>
                        </div>


                    </div>


                    <div class=" pb-3 mx-2">
                        @if($course->type == 'online')
                            <h5 class="text-main font-extrabold">زمان بندی کلاس ها:</h5>
                            @foreach($course->parts as $part)

                                @php
                                    $uniqueDays = $part->schedules->pluck('day_id')->unique();
                                    $days = \App\Models\Day::whereIn('id', $uniqueDays)->pluck('day_farsi', 'id');
                                    $part->uniqueDays = $days;
                                @endphp

                                <div class="my-5">
                                    <span class="font-extrabold">{{$part->title}}</span>

                                    <div class="my-2">
                                        <bdi>روز های برگزاری:</bdi>
                                        <span class="text-main50">{{ implode(', ', $part->uniqueDays->values()->toArray()) }}</span>
                                    </div>

                                    <div class="mt-2">
                                        <bdi>تاریخ شروع:</bdi>
                                        <span class="text-main50">{{jdate()->forge($part->schedules->first()->start_date)->toDateString()}}</span>
                                    </div>

                                    <div class="mt-2">
                                        <bdi>تاریخ پایان:</bdi>
                                        <span class="text-main50">{{jdate()->forge($part->schedules->last()->start_date)->toDateString()}}</span>
                                    </div>
                                    <div class="flex justify-end">
                                        <form action="{{route('cart.store')}}" method="post">
                                            @csrf
                                            @method('POST')
                                            <input type="hidden" name="course" value="{{ $course->id }}">
                                            <input type="hidden" name="part" value="{{ $part->id }}">
                                            <button class="mx-2 px-3 py-2 border border-main shadow text-main rounded-lg hover:bg-main25 duration-500"
                                                    type="submit">ثبت نام
                                            </button>
                                        </form>
                                    </div>
                                </div>

                            @endforeach

                        @elseif($course->type == 'offline')
                            <div class="flex items-center justify-center">
                                <form class="w-full" action="{{route('cart.store')}}" method="post">
                                    @csrf
                                    @method('POST')
                                    <input type="hidden" name="course" value="{{ $course->id }}">
                                    <button class=" my-2 w-full  py-2 border border-main shadow text-main rounded-lg hover:bg-main25 duration-500"
                                            type="submit">ثبت نام
                                    </button>
                                </form>
                            </div>
                        @endif

                        @auth
                            @if(!auth()->user()->favorites()->where('favoriteable_type',get_class($course))->where('favoriteable_id', $course->id)->exists())
                                <form action="{{route('favorites.store')}}" method="post">
                                    @csrf
                                    @method('POST')
                                    <input type="hidden" name="type" value="{{get_class($course)}}">
                                    <input type="hidden" name="id" value="{{$course->id}}">
                                    <button class="my-2 w-full  py-2 border border-red-500 shadow text-red-500 rounded-lg hover:bg-red-200 duration-500"
                                            type="submit"><i class="fa fa-heart ml-1"></i>افزودن علاقه مندی
                                    </button>
                                </form>

                            @else
                                <form action="{{route('favorites.delete')}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="type" value="{{get_class($course)}}">
                                    <input type="hidden" name="id" value="{{$course->id}}">
                                    <button class="my-2 w-full  py-2 border border-red-500 shadow text-red-500 rounded-lg hover:bg-red-200 duration-500"
                                            type="submit"><i class="fa fa-heart-broken ml-1"></i>حذف از علاقه مندی
                                    </button>
                                </form>
                            @endif
                        @endauth
                        @guest
                                <form action="{{route('favorites.store')}}" method="post">
                                    @csrf
                                    @method('POST')
                                    <input type="hidden" name="type" value="{{get_class($course)}}">
                                    <input type="hidden" name="id" value="{{$course->id}}">
                                    <button class="my-2 w-full  py-2 border border-red-500 shadow text-red-500 rounded-lg hover:bg-red-200 duration-500"
                                            type="submit"><i class="fa fa-heart ml-1"></i>افزودن علاقه مندی
                                    </button>
                                </form>
                        @endguest

                    </div>

                </div>
            </div>



        </div>
    </div>


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
                                <input type="hidden" name="type" value="{{get_class($course)}}">
                                <input type="hidden" name="id" value="{{$course->id}}">
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
            @if(count($course->comments->where('status' , 1)->where('parent' , null))> 0)
                <div class="grid grid-cols-12">

                    @foreach($course->comments->where('status' , 1)->where('parent' , null) as $comment)
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

    @section('script')

        <style>
            #course-description.open {
                max-height: none;
            }
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const showMoreBtn = document.getElementById('show-more');
                const courseDescription = document.getElementById('course-description');

                showMoreBtn.addEventListener('click', function () {
                    if (courseDescription.classList.contains('open')) {
                        courseDescription.classList.remove('open');
                        showMoreBtn.innerHTML = '<li class="fa fa-angles-down"></li> نمایش بیشتر';


                    } else {
                        courseDescription.classList.add('open');
                        showMoreBtn.innerHTML = '<li class="fa fa-angles-up"></li> نمایش کمتر';
                    }
                });
            });
        </script>




        <script>
            function toggleAccordion(event) {
                const header = event.currentTarget;
                const content = header.nextElementSibling;
                const icon = header.querySelector('.fas');

                // Toggle the hidden class to show/hide the content
                content.classList.toggle('hidden');

                // Toggle the icon
                if (content.classList.contains('hidden')) {
                    icon.classList.remove('fa-chevron-up');
                    icon.classList.add('fa-chevron-down');
                } else {
                    icon.classList.remove('fa-chevron-down');
                    icon.classList.add('fa-chevron-up');
                }
            }
        </script>




        <script>
            // انتخاب دکمه و مدال
            const comment = document.getElementById('comment');
            const closeModalButton = document.getElementById('closeModalButton');
            const modal = document.getElementById('myModal');

            // زمانی که کاربر روی دکمه کلیک می‌کند، مدال باز شود
            comment.addEventListener('click', () => {
                modal.classList.remove('hidden');
            });

            // زمانی که کاربر روی دکمه بسته شدن کلیک می‌کند، مدال بسته شود
            closeModalButton.addEventListener('click', () => {
                modal.classList.add('hidden');
            });

            // همچنین می‌توانید مدال را با کلیک خارج از آن ببندید
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

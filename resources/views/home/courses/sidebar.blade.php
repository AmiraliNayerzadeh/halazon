<div class="col-span-12 sm:col-span-3 p-3 sm:p-1 ">

    <div class="rounded-2xl border border-main100 shadow space-y-4 mb-3 sticky top-0 ">
        <div class="flex items-center justify-center bg-main25 py-4 rounded-t-2xl ">
            <span class="font-extrabold text-lg text-main100">{{$course->type == 'offline'  ? 'کلاس ضبط شده' : 'کلاس آنلاین'}}</span>
        </div>

        <div class="p-3 border-b border-b-main ">
            @if($course->price != 0 )

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
            @else
                <div class="flex justify-center items-center">

                    <div class="font-bold text-2xl">
                        رایگان
                    </div>
                </div>
            @endif
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


            @if(!is_null($course->capacity))

                <div class="flex  items-center  my-3 ">
                    <div class="flex items-center">
                        <i class="ml-1 fa-regular fa-square-user"></i>
                        <b class="ml-1">ظرفیت:</b>
                        <span>{{$course->capacity}} نفر </span>
                    </div>
                </div>
            @endif


        </div>


        <div class=" pb-3 mx-2" id="submit-part">
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


                            @if(!(auth()->check() && auth()->user()->hasAccessToPart($course->id, $part->id)))

                                <form action="{{route('cart.store')}}" method="post">
                                    @csrf
                                    @method('POST')
                                    <input type="hidden" name="course" value="{{ $course->id }}">
                                    <input type="hidden" name="part" value="{{ $part->id }}">
                                    <button class="mx-2 px-3 py-2 border border-main shadow text-main rounded-lg hover:bg-main25 duration-500"
                                            type="submit">ثبت نام
                                    </button>
                                </form>

                            @else
                                <div class="mx-2 px-3 py-2 border bg-green-300 border-green-600 shadow  rounded-lg hover:bg-green-400 duration-500">
                                    ثبت نام کرده اید
                                </div>

                            @endif
                        </div>
                    </div>

                @endforeach

            @elseif($course->type == 'offline')
                <div class="flex items-center justify-center sm:sticky fixed ">

                    @if(!(auth()->check() || auth()->user()->hasAccessToCourse($course->id)))

                        <form class="w-full" action="{{route('cart.store')}}" method="post">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="course" value="{{ $course->id }}">
                            <button class=" my-2 w-full  py-2 border border-main shadow text-main rounded-lg hover:bg-main25 duration-500"
                                    type="submit">ثبت نام
                            </button>
                        </form>
                    @else
                        <button class=" my-2 w-full  py-2 border bg-green-300 border-green-600 shadow  rounded-lg  hover:bg-green-400 duration-500"
                                type="button">ثبت نام کرده اید
                        </button>
                    @endif
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


@php
    $agent = new \Jenssegers\Agent\Agent();
@endphp

@if($agent->isMobile())
    <div class="sm:static fixed bottom-0 left-0 right-0 z-50 bg-gray-200 shadow shadow-main100 p-3 border-t border-gray-200 flex items-center justify-center">

        <div class="grid grid-cols-12 w-full ">
            <div class="col-span-6">
                <div class="w-full h-full flex items-center">

                    <div class="p-1">
                        @if($course->price != 0 )
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
                        @else
                            <div class="flex justify-center items-center">

                                <div class="font-bold text-2xl">
                                    رایگان
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-span-6">

                @if($course->type == 'offline')

                    @if(!(auth()->check() && auth()->user()->hasAccessToCourse($course->id)))
                        <form class="w-full" action="{{route('cart.store')}}" method="post">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="course" value="{{ $course->id }}">
                            <button class="my-2 w-full py-2 border border-main shadow text-main rounded-lg hover:bg-main25 duration-500"
                                    type="submit">ثبت نام
                            </button>
                        </form>
                    @else
                        <button class="my-2 w-full py-2 border bg-green-300 border-green-600 shadow rounded-lg hover:bg-green-400 duration-500"
                                type="button">ثبت نام کرده اید
                        </button>
                    @endif

                @endif

                @if($course->type == 'online')
                    <div class="w-full h-full flex items-center">
                        <a href="#submit-part"
                           class="my-2 w-full py-2 border border-main shadow text-main rounded-lg hover:bg-main25 duration-500 text-center">مشاهده
                            زمان بندی ها
                        </a>
                    </div>

                @endif

            </div>
        </div>

    </div>
@endif

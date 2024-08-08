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
                        <img class="rounded-3xl w-auto max-h-72 "
                             src="{{!is_null($course->image) ? $course->image : '/assets/default-image.jpg'}}"
                             alt="{{$course->title}}">
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
                            <button class="accordion-header w-full text-right flex justify-between items-center p-4"
                                    onclick="toggleAccordion(event)">
                                <h3 class="text-main font-extrabold">سر فصل های {{$course->title}}</h3>
                                <i class="fas fa-chevron-down text-main"></i>
                            </button>
                            <div class="accordion-content bg-main25 rounded-b-2xl p-4 hidden">

                                @foreach($course->headlines as $headline)

                                    <div class="w-full px-2 my-2">
                                        <div class="accordion">
                                            <div class="accordion-item bg-white shadow-md mb-4 border ">
                                                <button class="accordion-header w-full text-right flex justify-between items-center p-4"
                                                        onclick="toggleAccordion(event)">
                                                    <h4 class="text-main font-extrabold">
                                                        <span class="text-primary">{{$headline->priority}})</span>
                                                        {{$headline->title}}
                                                    </h4>
                                                    <i class="fas fa-chevron-down text-main"></i>
                                                </button>
                                                <div class="accordion-content bg-gray-100 p-4 hidden">
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

                @if(!is_null($course->homework))
                    <div class="w-full mt-7">
                        <div class="accordion">
                            <div class="accordion-item shadow-md mb-4 border border-main rounded-2xl">
                                <button class="accordion-header w-full text-right flex justify-between items-center p-4"
                                        onclick="toggleAccordion(event)">
                                    <h4 class="text-main font-extrabold">تکالیف</h4>
                                    <i class="fas fa-chevron-down text-main"></i>
                                </button>
                                <div class="accordion-content bg-main25 rounded-b-2xl p-4 hidden">
                                    {{$course->homework}}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif


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
                                           href="#">{{$course->teacher->name}} {{$course->teacher->family}}</a>
                                    </span>
                                </div>
                                @if(!is_null($course->teacher->description))
                                    <div class="prose">
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
                                <span> {{$course->age_from}} الی  {{$course->age_to}} سال </span>
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
                                        <form action="#">
                                            <button class="mx-2 px-3 py-2 border border-main shadow text-main rounded-lg hover:bg-main25 duration-500"
                                                    type="submit">ثبت نام
                                            </button>
                                        </form>
                                    </div>
                                </div>

                            @endforeach

                        @elseif($course->type == 'offline')
                            <div class="flex items-center justify-center">
                                <form class="w-full" action="#">
                                    <button class=" my-2 w-full  py-2 border border-main shadow text-main rounded-lg hover:bg-main25 duration-500"
                                            type="submit">ثبت نام
                                    </button>
                                </form>
                            </div>
                        @endif
                        <form class="w-full" action="#">
                            <button class=" my-2 w-full  py-2 border border-red-500 shadow text-red-500 rounded-lg hover:bg-red-200 duration-500"
                                    type="submit">
                                <i class="fa-regular fa-heart"></i>
                                افزودن به علاقه مندی
                            </button>
                        </form>
                    </div>

                </div>


            </div>
        </div>
    </div>


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

    @endsection

@endsection

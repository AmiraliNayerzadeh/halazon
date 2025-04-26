<div class="p-1 ">
    <div>
        <a href="{{route('course.show' , $course)}}">
            <img class="rounded-2xl h-28 sm:h-60 w-full" src="{{$course->image}}"
                 alt="{{$course->title}}">
        </a>
    </div>

    <h3 class="mt-4 font-extrabold text-sm sm:text-lg hover:text-main duration-500 truncate"><a
            href="{{route('course.show' , $course)}}">{{$course->title}}</a>

    </h3>

    <div class="mt-2 text-gray-500 text-xs sm:text-sm">
        <p>نوع کلاس:
            <span>{{$course->type_translated}}</span>
        </p>
    </div>


    {{--Teacher--}}
    <div class="flex items-center mt-3 ">
        <a href="{{route('teacher.show' , $course->teacher)}}"><img
                class="rounded-full h-8 w-8 sm:h-14 sm:w-14 border border-2 border-main "
                src="{{$course->teacher->avatar}}" alt=""></a>
        <h4 class="mr-2 text-main50 text-xs sm:text-base truncate">استاد: <a
                href="{{route('teacher.show' , $course->teacher)}}">{{$course->teacher->name}} {{$course->teacher->family}}</a>
        </h4>

    </div>


    {{--  End Teacher--}}

    {{-- Info--}}
    <div class="grid grid-cols-6 mt-2 sm:mt-4">

        <div class="col-span-6 sm:col-span-3 mx-2 bg-main25 shadow rounded-2xl my-1 sm:my-2">
            <div class="flex h-full items-center justify-center py-1 sm:py-3 text-center text-xs sm:text-base">

                @if($course->age_from == $course->age_to )
                    <div>
                        مختص
                        {{$course->age_from}}
                        سال
                    </div>

                @else
                    <div>
                        {{$course->age_from}}
                        الی
                        {{$course->age_to}}
                        سال
                    </div>
                @endif

            </div>
        </div>


        <div class="col-span-6 sm:col-span-3 mx-2 bg-main25 shadow rounded-2xl my-1 sm:my-2">
            <div class="flex h-full items-center justify-center py-1 sm:py-3 text-center text-xs sm:text-base">
                {{$course->minutes}}
                دقیقه
            </div>
        </div>


        <div class="col-span-6 sm:col-span-6  mx-2 bg-main25 shadow rounded-2xl my-1 sm:my-2">
            <div class="flex h-full items-center justify-center py-1 sm:py-3 text-center text-xs sm:text-base">
                @if($course->price != 0 )
                    @if($course->type == 'online')
                        {{number_format(($course->price - $course->discount_price) / $course->class_duration )}}
                        تومان هر جلسه
                    @elseif($course->type == 'offline')
                        {{number_format(($course->price - $course->discount_price))}}
                        تومان
                    @endif
                @else
                    رایگان😍
                @endif
            </div>
        </div>
    </div>
    {{--End Info--}}
</div>

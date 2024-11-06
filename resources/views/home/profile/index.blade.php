@extends('.home.profile.master')

@section('content')
    <h1 class="text-2xl font-extrabold text-main my-4"><i class="fa fa-comment-alt mx-1"></i>داشبورد</h1>


    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 my-6">

        <div class="bg-white p-4 rounded-lg shadow flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-700">تعداد دوره‌های شما</h2>
                <p class="text-2xl font-bold text-primary">{{count(auth()->user()->userCourses)}}</p>
            </div>
            <i class="fa fa-book text-3xl text-main"></i>
        </div>

        {{-- تعداد نظرات --}}
        <div class="bg-white p-4 rounded-lg shadow flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-700">تعداد نظرات</h2>
                <p class="text-2xl font-bold text-primary">{{count(auth()->user()->comments)}}</p>
            </div>
            <i class="fa fa-comments text-3xl text-main"></i>
        </div>

        {{-- تعداد علاقه‌مندی‌ها --}}
        <div class="bg-white p-4 rounded-lg shadow flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-700">تعداد علاقه‌مندی‌ها</h2>
                <p class="text-2xl font-bold text-primary">{{count(auth()->user()->favorites)}}</p>
            </div>
            <i class="fa fa-heart text-3xl text-main"></i>
        </div>

        {{-- تعداد درخواست‌های پشتیبانی --}}
        <div class="bg-white p-4 rounded-lg shadow flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-700">تعداد درخواست‌های پشتیبانی</h2>
                <p class="text-2xl font-bold text-primary">0</p>
            </div>
            <i class="fa fa-life-ring text-3xl text-main"></i>
        </div>
    </div>

    {{-- جدول برای نمایش آخرین دوره‌های تهیه شده --}}
    <div class="bg-white rounded-lg shadow-md mt-8 overflow-x-auto">
        <h2 class="text-xl font-semibold text-gray-700 px-4 py-2 border-b">آخرین دوره‌های تهیه شده:</h2>
        <table class="min-w-full text-center">
            <thead class="bg-gray-200">
            <tr>
                <th class="p-4 text-sm font-semibold text-gray-700">تصویر</th>
                <th class="p-4 text-sm font-semibold text-gray-700">عنوان دوره</th>
                <th class="p-4 text-sm font-semibold text-gray-700">زمان خرید</th>
                <th class="p-4 text-sm font-semibold text-gray-700">آموزش</th>
            </tr>
            </thead>
            <tbody>

            @foreach(auth()->user()->userCourses as $item )
                <tr class="border-b">
                    <td class="p-4">
                        <img src="{{ $item->course->image }}" alt="{{$item->course->title}}"
                             class=" h-16 object-cover rounded-lg mx-auto">
                    </td>
                    <td class="p-4 text-gray-700">
                        <a href="{{ route('course.show', $item->course->slug) }}"
                           class="hover:underline font-medium">{{ $item->course->title }}</a>
                        @if(!is_null($item->part_id))
                            <small class="text-gray-400">
                                ({{$item->part->title}})
                            </small>
                        @endif
                    </td>

                    <td class="p-4 text-gray-700">
                        <a href="{{ route('course.show', $item->course->slug) }}"
                           class="hover:underline font-medium">{{ jdate($item->created_at)->ago()  }}</a>
                    </td>

                    <td class="p-4">
                        <a href="{{ route('course.show', $item->course->slug) }}"
                           class="text-white bg-main px-4 py-2 rounded-md hover:bg-main-dark">آموزش</a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
@endsection
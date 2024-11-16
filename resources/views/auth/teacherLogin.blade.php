@extends('.home.layouts.just-header.master')
@section('content')

    <div class="grid grid-cols-12 h-full ">

        <div class="col-span-12 sm:col-span-12">
            <div class="flex flex-col sm:justify-center items-center h-full">
                <h1 class="text-main font-extrabold text-3xl my-5"> ورود / عضویت معلمین</h1>
                <div class="sm:w-1/3 p-5 sm:px-0">

                    <form method="post" action="{{ route('login') }}">
                        @csrf
                        <input type="hidden" name="teacher" value="1">
                        <div class="py-2 flex justify-around items-center rounded-2xl border border-l-gray-500">
                            <input name="phone" class="w-full border-0  focus:border-transparent focus:ring-0 text-2xl num" style="direction: ltr" type="text" placeholder="شماره تلفن" id="" inputmode="numeric" pattern="[0-9]*">
                            <span class="text-2xl font-extrabold border-r  text-gray-400 px-2">98+</span>
                        </div>

                        <button type="submit" class="my-5 py-4 border bg-primary hover:bg-primary100 duration-500 rounded-2xl w-full text-lg font-extrabold text-white" >تایید و دریافت کُد</button>
                        <div class="flex items-center justify-center">
                            <span class="w-full text-center"> ثبت ‌نام یا ورود به منزله پذیرش <a class="text-main font-extrabold underline" href="{{route('terms')}}"> شرایط و قوانین</a> حلزون است. </span>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

@endsection

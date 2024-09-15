@extends('.home.layouts.just-header.master')
@section('content')

    <div class="grid grid-cols-12 h-full ">
        <div class="col-span-12 sm:col-span-6"
             style="background: linear-gradient(270deg, rgba(251, 137, 49, 0.73) 0%, rgba(81, 46, 136, 0.23) 100%);">
            <div class="flex h-full items-center justify-center">
                <img class="h-44 sm:h-96" src="/assets/home/image/login.webp" alt="ورود / ثبت نام در پلتفرم آموزشی حلزون">

            </div>
        </div>
        
        <div class="col-span-12 sm:col-span-6">
            <div class="flex flex-col sm:justify-center items-center h-full">
                <h1 class="text-main font-extrabold text-3xl my-5">ورود / عضویت</h1>
                <div class="sm:w-1/2 p-5 sm:px-0">
                    <form method="post" action="{{ route('login') }}">
                        @csrf
                        <div class="py-2 flex justify-around items-center rounded-2xl border border-l-gray-500">
                            <input name="phone" class="w-full border-0  focus:border-transparent focus:ring-0 text-2xl" style="direction: ltr" type="text" placeholder="شماره تلفن" id="">
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

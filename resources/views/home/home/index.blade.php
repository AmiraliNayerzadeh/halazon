@extends('.home.layouts.main.master')

@section('content')
    <div class="mt-5 grid grid-cols-12 rounded-3xl container mx-auto"
         style="background: linear-gradient(90deg, rgba(81, 46, 136, 0.22) 27%, rgba(251, 137, 49, 0.22) 72.5%)">
        <div class="col-span-12 sm:col-span-6 p-6 sm:p-20">
            <div class="flex flex-wrap h-full items-center">
                <div class="space-y-3 sm:space-y-5">
                    <h1 class="text-main font-extrabold text-3xl sm:text-6xl ">پلتفرم آموزشی حلزون</h1>
                    <p class="mt-3 text-lg sm:text-2xl">آهسته و پیوسته پیشرفت می‌کنیم.</p>
                    <div>
                        <li class="fa-solid fa-graduation-cap text-3xl text-primary ml-4"></li>
                        <span class="text-main underline font-extrabold dec">+22</span>
                        <span>کلاس فعال</span>
                    </div>
                    <div>
                        <li class="fa-solid fa-chalkboard-user text-3xl text-primary ml-4"></li>
                        <span class="text-main underline font-extrabold dec">+15</span>
                        <span>دبیر فعال</span>
                    </div>
                    <div>
                        <li class="fa-regular fa-star text-3xl text-primary ml-4"></li>
                        <span class="text-main underline font-extrabold dec">+69</span>
                        <span>کلاس برگزار شده</span>
                    </div>
                    <div class="mt-24 flex">
                        <a class="bg-primary hover:bg-primary100 duration-500 py-4 px-5 font-extrabold rounded-3xl text-white "
                           href="{{route('login')}}"><i class="fa-solid fa-plus ml-3"></i>به ما بپیوندید</a>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-6">
            <div class="flex w-full h-full justify-center">
                <img class="" src="/assets/home/image/Mainhalazoon.webp" alt="وب سایت آموزشی حلزون">
            </div>
        </div>
    </div>




    {{--Section 2--}}
    <div class="grid grid-cols-12 my-10 container mx-auto ">

        <div class="col-span-12  sm:col-span-3 my-3">
            <div class="flex items-center justify-center">
                <img class="ml-2" src="/assets/home/image/global.svg" alt="آموزش برای تمام فارسی زبانان">
                <span class="font-bold">آموزش برای تمام فارسی زبانان</span>
            </div>
        </div>

        <div class="col-span-12  sm:col-span-3 my-3">
            <div class="flex items-center justify-center">
                <img class="ml-2" src="/assets/home/image/age.svg" alt="آموزش برای ۳ الی ۱۸ سال">
                <span class="font-bold">آموزش برای ۳ الی ۱۸ سال</span>
            </div>
        </div>

        <div class="col-span-12  sm:col-span-3 my-3">
            <div class="flex items-center justify-center">
                <img class="ml-2" src="/assets/home/image/felex.svg" alt="آموزش منعطف">
                <span class="font-bold">آموزش منعطف</span>
            </div>
        </div>

        <div class="col-span-12  sm:col-span-3 my-3">
            <div class="flex items-center justify-center">
                <img class="ml-2" src="/assets/home/image/review.svg" alt="نظارت بر آموزش">
                <span class="font-bold">نظارت بر آموزش</span>
            </div>
        </div>

    </div>
    {{--End Section 2--}}



    {{--Section 3--}}
    <div class="my-12 container mx-auto">
        <h3 class="font-extrabold text-2xl sm:text-4xl text-center mb-6">کلاس ها و معلمان برای هر مقطعی</h3>
        <div class="grid grid-cols-12 mx-auto">
            <div class="col-span-6 sm:col-span-3 my-1">
                <div class="sm:w-2/3 p-4">
                    <a href="#"><img class="w-full rounded-t-3xl " src="/assets/home/image/highSchool.png" alt="#"></a>
                    <div class="w-full bg-white shadow rounded-b-3xl py-5 text-center"><a href="#"
                                                                                          class="font-extrabold text-lg hover:text-main duration-500">مهد
                            کودک</a></div>
                </div>
            </div>

            <div class="col-span-6 sm:col-span-3 my-1">
                <div class="sm:w-2/3 p-4">
                    <a href="#"><img class="w-full rounded-t-3xl " src="/assets/home/image/highSchool.png" alt="#"></a>
                    <div class="w-full bg-white shadow rounded-b-3xl py-5 text-center"><a href="#"
                                                                                          class="font-extrabold text-lg hover:text-main duration-500">مهد
                            کودک</a></div>
                </div>
            </div>

            <div class="col-span-6 sm:col-span-3 my-1">
                <div class="sm:w-2/3 p-4">
                    <a href="#"><img class="w-full rounded-t-3xl " src="/assets/home/image/highSchool.png" alt="#"></a>
                    <div class="w-full bg-white shadow rounded-b-3xl py-5 text-center"><a href="#"
                                                                                          class="font-extrabold text-lg hover:text-main duration-500">مهد
                            کودک</a></div>
                </div>
            </div>

            <div class="col-span-6 sm:col-span-3 my-1">
                <div class="sm:w-2/3 p-4">
                    <a href="#"><img class="w-full rounded-t-3xl " src="/assets/home/image/highSchool.png" alt="#"></a>
                    <div class="w-full bg-white shadow rounded-b-3xl py-5 text-center"><a href="#"
                                                                                          class="font-extrabold text-lg hover:text-main duration-500">مهد
                            کودک</a></div>
                </div>
            </div>

        </div>
    </div>
    {{--End Section 3--}}

    {{--Section 4--}}
    <div class="bg-main25 rounded-3xl container mx-auto">
        <h3 class="font-extrabold text-2xl sm:text-4xl text-center my-6 py-5">موضوعات و محورهای آموزشی منتخب</h3>
        <div class="grid grid-cols-12">

            <div class="col-span-6 sm:col-span-3 my-6">
                <div class="flex justify-center items-center text-center">
                    <div class="">
                        <a href="#">
                            <img class="" src="/assets/home/image/art.png" alt="#">
                            <span class="font-bold text-lg hover:text-main duration-500">هنر</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-span-6 sm:col-span-3 my-6">
                <div class="flex justify-center items-center text-center">
                    <div class="">
                        <a href="#">
                            <img class="" src="/assets/home/image/english.png" alt="#">
                            <span class="font-bold text-lg hover:text-main duration-500">انگلیسی</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-span-6 sm:col-span-3 my-6">
                <div class="flex justify-center items-center text-center">
                    <div class="">
                        <a href="#">
                            <img class="" src="/assets/home/image/exel.png" alt="#">
                            <span class="font-bold text-lg hover:text-main duration-500">اکسل</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-span-6 sm:col-span-3 my-6">
                <div class="flex justify-center items-center text-center">
                    <div class="">
                        <a href="#">
                            <img class="" src="/assets/home/image/programing.png" alt="#">
                            <span class="font-bold text-lg hover:text-main duration-500">برنامه نویسی</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-span-6 sm:col-span-3 my-6">
                <div class="flex justify-center items-center text-center">
                    <div class="">
                        <a href="#">
                            <img class="" src="/assets/home/image/art.png" alt="#">
                            <span class="font-bold text-lg hover:text-main duration-500">هنر</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-span-6 sm:col-span-3 my-6">
                <div class="flex justify-center items-center text-center">
                    <div class="">
                        <a href="#">
                            <img class="" src="/assets/home/image/art.png" alt="#">
                            <span class="font-bold text-lg hover:text-main duration-500">هنر</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-span-6 sm:col-span-3 my-6">
                <div class="flex justify-center items-center text-center">
                    <div class="">
                        <a href="#">
                            <img class="" src="/assets/home/image/art.png" alt="#">
                            <span class="font-bold text-lg hover:text-main duration-500">هنر</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-span-6 sm:col-span-3 my-6">
                <div class="flex justify-center items-center text-center">
                    <div class="">
                        <a href="#">
                            <img class="" src="/assets/home/image/art.png" alt="#">
                            <span class="font-bold text-lg hover:text-main duration-500">هنر</span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
    {{--End Section 4--}}

@endsection
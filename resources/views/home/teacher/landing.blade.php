@extends('home.layouts.just-header.master')
@section('content')

    <div class="mt-5 grid grid-cols-12 rounded-3xl container mx-auto"
         style="background: linear-gradient(90deg, rgba(81, 46, 136, 0.22) 27%, rgba(251, 137, 49, 0.22) 72.5%)">
        <div class="col-span-12 sm:col-span-6 p-6 sm:p-20">
            <div class="flex flex-wrap h-full items-center">
                <div class="space-y-3 sm:space-y-5">
                    <h1 class="text-main font-extrabold text-lg sm:text-2lg ">
                        تدریس حرفه ای را با استفاده از پلتفرم حلزون تجربه کنید.
                    </h1>
                    <p class="mt-3 ">
                        در حلزون، به عنوان مدرس می‌توانید دانش و مهارت‌های خود را به جمعی گسترده منتقل کنید و از طریق
                        آموزش آنلاین به درآمد برسید.
                    </p>

                    <div class="mt-24 flex">
                        <a class="bg-primary hover:bg-primary100 duration-500 py-4 px-5 font-extrabold rounded-3xl text-white "
                           href="{{route('teachers.login')}}"><i class="fa-solid fa-plus ml-3"></i>ثبت نام به عنوان مدرس</a>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-6">
            <div class="flex w-full h-full justify-center">
                <img class="h-96" src="/assets/home/image/teacherLanding.webp" alt="تدریس در حلزون">
            </div>
        </div>
    </div>




    <div class="container mx-auto my-10">
        <h2 class="text-center font-extrabold text-2xl">
            چرا تدریس در حلزون را انتخاب کنیم؟
        </h2>

        <div class="grid grid-cols-12 mt-5 ">

            <div class="col-span-12 sm:col-span-6 p-1 mx-2 shadow border rounded-lg my-3">
                <div class="p-3">
                    <h4 class="text-bold text-main text-2xl">
                        <i class="fa fa-graduation-cap"></i>
                        درآمد بیشتر
                    </h4>
                    <p class="mt-3">
                        با تدریس در حلزون، بدون محدودیت مکانی و زمانی می‌توانید به درآمد بیشتری دست یابید. دوره‌های شما
                        به هزاران علاقه‌مند نمایش داده می‌شود، که فرصتی برای افزایش درآمدتان فراهم می‌کند.
                    </p>
                </div>
            </div>

            <div class="col-span-12 sm:col-span-6 p-1 mx-2 shadow border rounded-lg my-3">
                <div class="p-3">
                    <h4 class="text-bold text-main text-2xl">
                        <i class="fa fa-graduation-cap"></i>
                        تدریس بدون دغدغه
                    </h4>
                    <p class="mt-3">
                        حلزون با ارائه ابزارها و پشتیبانی مناسب، تجربه‌ای بی‌دغدغه برای تدریس آنلاین ایجاد می‌کند. شما
                        فقط روی آموزش و کیفیت محتوا تمرکز می‌کنید و ما سایر امور را برایتان مدیریت می‌کنیم.
                    </p>
                </div>
            </div>

            <div class="col-span-12 sm:col-span-6 p-1 mx-2 shadow border rounded-lg my-3">
                <div class="p-3">
                    <h4 class="text-bold text-main text-2xl">
                        <i class="fa fa-graduation-cap"></i>
                        جذب بیشتر علم‌جو
                    </h4>
                    <p class="mt-3">
                        شبکه گسترده حلزون، دوره‌های شما را به تعداد زیادی از علاقه‌مندان معرفی می‌کند. با دسترسی به این
                        تعداد مخاطب، شانس بیشتری برای جذب علم‌جویان و افزایش یادگیرندگان خود خواهید داشت.
                    </p>
                </div>
            </div>


            <div class="col-span-12 sm:col-span-6 p-1 mx-2 shadow border rounded-lg my-3">
                <div class="p-3">
                    <h4 class="text-bold text-main text-2xl">
                        <i class="fa fa-graduation-cap"></i>
                        استفاده‌ی بهینه از زمان
                    </h4>
                    <p class="mt-3">
                        با تدریس آنلاین، می‌توانید محتوای آموزشی خود را یک‌بار تولید کنید و بدون نیاز به تکرار، آن را
                        بارها و بارها به فروش برسانید. این روش باعث می‌شود که زمان خود را به بهترین شکل ممکن مدیریت کنید
                        و به اهداف خود برسید.
                    </p>
                </div>
            </div>


        </div>


    </div>


    <div class="container mx-auto my-10">
        <img src="/assets/home/Teach.jpg" class="w-full rounded-2xl" alt="تدریس در حلزون">
    </div>
    
    


    <div class="container mx-auto my-10">
        <div class="border rounded-lg shadow p-4">
            <div class="grid grid-cols-12">
                <div class="col-span-12 sm:col-span-8">
                    <div class="flex items-center h-full">
                        <div class=" mx-auto p-6  rounded-lg ">
                            <h1 class="text-2xl font-bold text-gray-800 mb-4">
                                چرا تدریس آنلاین در پلتفرم آموزشی
                                <a href="https://halazoon.org/" class="text-primary ">حلزون</a> برای معلمان جذاب است؟
                            </h1>
                            <p class="text-gray-700 mb-6">
                                اگر به دنبال استخدام معلم یا تدریس آنلاین هستید، پلتفرم آموزشی
                                <a href="https://halazoon.org/" class="text-primary ">حلزون</a>
                                بهترین فرصت برای شما است. در اینجا می‌توانید دوره‌های آنلاین خود را ارائه دهید، درآمد خود را افزایش دهید و از آزادی زمانی بهره‌برداری کنید.
                            </p>

                            <h2 class="text-xl font-bold text-gray-800 mb-4">مزایای تدریس آنلاین در پلتفرم حلزون</h2>

                            <div class="space-y-6">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800">1. درآمدزایی بیشتر از تدریس آنلاین در حلزون</h3>
                                    <p class="text-gray-700">
                                        حلزون به معلمان این امکان را می‌دهد که در دوره‌های پرفروش و پرطرفدار تدریس کنند. با تبلیغات هدفمند و پرداخت‌های منظم، شما می‌توانید درآمد خود را به‌طور قابل توجهی افزایش دهید. پلتفرم آموزشی حلزون با سیستم تبلیغاتی خود، دوره‌های شما را به دانش‌آموزان آنلاین از سراسر جهان معرفی می‌کند.
                                    </p>
                                </div>

                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800">2. آزادی زمانی و انعطاف‌پذیری در تدریس آنلاین حلزون</h3>
                                    <p class="text-gray-700">
                                        یکی از مهم‌ترین ویژگی‌های تدریس آنلاین در حلزون، آزادی زمانی است. شما می‌توانید کلاس‌های خود را در هر زمانی که بخواهید برگزار کنید و آن را با سبک زندگی خود هماهنگ کنید. این انعطاف‌پذیری به شما کمک می‌کند که تدریس آنلاین را به بهترین شکل ممکن مدیریت کنید.
                                    </p>
                                </div>

                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800">3. دسترسی به دانش‌آموزان آنلاین از سراسر جهان در حلزون</h3>
                                    <p class="text-gray-700">
                                        پلتفرم آموزشی حلزون به شما این امکان را می‌دهد که به دانش‌آموزانی از نقاط مختلف جهان تدریس کنید. این ویژگی منحصر به فرد باعث می‌شود که شما در آموزش آنلاین بتوانید تجربه‌ای جهانی کسب کنید.
                                    </p>
                                </div>

                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800">4. امنیت و پشتیبانی 24 ساعته در حلزون</h3>
                                    <p class="text-gray-700">
                                        امنیت یکی از اولویت‌های اصلی ما در حلزون است. ما از اطلاعات شما و دانش‌آموزان به‌طور کامل محافظت می‌کنیم. علاوه بر این، تیم پشتیبانی ما 24 ساعته آماده است تا به هرگونه سوال یا مشکل شما در تدریس آنلاین پاسخ دهد.
                                    </p>
                                </div>

                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800">5. تضمین پرداخت منظم در حلزون</h3>
                                    <p class="text-gray-700">
                                        در پلتفرم آموزشی حلزون، ما به شما تضمین می‌دهیم که هر ماه به‌طور دقیق و به موقع مبلغ درآمد شما پرداخت خواهد شد. شما می‌توانید بدون هیچ نگرانی از بابت پرداخت‌ها، به تدریس آنلاین خود ادامه دهید.
                                    </p>
                                </div>
                            </div>

                            <h2 class="text-xl font-bold text-gray-800 mt-8 mb-4">چطور به پلتفرم حلزون بپیوندید؟</h2>
                            <p class="text-gray-700 mb-6">
                                برای شروع، کافی است در
                                <a href="https://halazoon.org/" class="text-primary ">حلزون</a>
                                ثبت‌نام کنید و پروفایل خود را تکمیل کنید. سپس می‌توانید تدریس آنلاین خود را شروع کنید و از تمامی امکانات و حمایت‌های پلتفرم آموزشی حلزون بهره‌برداری کنید.
                            </p>

                            <h2 class="text-xl font-bold text-gray-800 mb-4">چرا حلزون بهترین پلتفرم برای تدریس آنلاین است؟</h2>
                            <p class="text-gray-700">
                                اگر به دنبال استخدام معلم و تدریس آنلاین با امکانات پیشرفته و امنیت بالا هستید،
                                <a href="https://halazoon.org/" class="text-primary ">پلتفرم آموزشی حلزون</a>
                                بهترین انتخاب برای شما است. با حلزون، شما می‌توانید درآمد خود را افزایش دهید، دانش‌آموزان جدید جذب کنید و در کنار آزادی زمانی، از پرداخت‌های منظم و امنیت کامل بهره‌مند شوید. همین امروز به
                                <a href="https://halazoon.org/" class="text-primary ">حلزون</a>
                                بپیوندید و دنیای تدریس آنلاین را متحول کنید.
                            </p>
                        </div>

                    </div>
                </div>

                <div class="col-span-12 sm:col-span-4">
                    <div class="flex justify-center items-center h-full">
                        <img src="/assets/home/image/teacherType.png" alt="فرایند های تدریس در حلزون">
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container mx-auto my-10">
        <div class="border rounded-lg shadow p-4">
            <div class="grid grid-cols-12">
                <div class="col-span-12 sm:col-span-8">
                    <div class="flex justify-center items-center h-full">
                        <div>
                            <h3 class="text-2xl text-main font-extrabold">
                                پلن‌های مالی تدریس در حلزون
                            </h3>
                            <p class="mt-4">
                                هزینه‌ی هر کلاس پس از کسر کمیسیون حلزون، در پایان کلاس به کیف پول شما واریز می‌شود. موجودی کیف پول قابل برداشت است؛ بعد از ثبت درخواست برداشت وجه، حداکثر 48 ساعت طول می‌کشد تا 90 درصد موجودی کیف پول (سقف برداشت) به شماره شبایی که در حساب کاربری‌تان وارد کرده‌اید، واریز شود.
                            </p>

                            <div class="bg-main25 p-3 rounded-full shadow mt-4">
                                <div class="flex justify-between">
                                    <h6 class="font-bold">دوره های آنلاین</h6>
                                    <a class="font-bold text-main text-2xl">65%</a>
                                </div>
                            </div>

                            <div class="bg-main25 p-3 rounded-full shadow mt-4">
                                <div class="flex justify-between">
                                    <h6 class="font-bold">دوره های هیبرید</h6>
                                    <a class="font-bold text-main text-2xl">70%</a>
                                </div>
                            </div>


                            <div class="bg-main25 p-3 rounded-full shadow mt-4">
                                <div class="flex justify-between">
                                    <h6 class="font-bold">دوره های آفلاین</h6>
                                    <a class="font-bold text-main text-2xl">75%</a>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>

                <div class="col-span-12 sm:col-span-4">
                    <div class="flex items-center h-full">
                        <img src="/assets/home/image/TeacherPlan.png" alt="فرایند های تدریس در حلزون">
                    </div>
                </div>
            </div>
        </div>
    </div>






    @section('script')
        <script>
            function showContent(type) {
                // Hide both contents
                document.getElementById('onlineContent').classList.add('hidden');
                document.getElementById('offlineContent').classList.add('hidden');

                // Reset button styles
                document.getElementById('onlineBtn').classList.remove('bg-main50', 'text-white');
                document.getElementById('offlineBtn').classList.remove('bg-main50', 'text-white');

                // Show the selected content and highlight the button
                if (type === 'online') {
                    document.getElementById('onlineContent').classList.remove('hidden');
                    document.getElementById('onlineBtn').classList.add('bg-main50', 'text-white');
                } else if (type === 'offline') {
                    document.getElementById('offlineContent').classList.remove('hidden');
                    document.getElementById('offlineBtn').classList.add('bg-main50', 'text-white');
                }
            }
        </script>

        <style>
            .hidden {
                display: none;
            }
        </style>
    @endsection

@endsection

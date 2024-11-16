@extends('.home.layouts.main.master')

@section('content')

    <div class="mt-5 grid grid-cols-12 rounded-3xl container mx-auto"
         style="background: linear-gradient(90deg, rgba(81, 46, 136, 0.22) 27%, rgba(251, 137, 49, 0.22) 72.5%)">
        <div class="col-span-12 sm:col-span-8 p-6 sm:p-20">
            <div class="flex flex-wrap h-full items-center">
                <div class="space-y-3 sm:space-y-5">
                    <h1 class="text-main font-extrabold text-2xl sm:text-2lg ">
                        درباره ما
                    </h1>
                    <p class="mt-3 ">
                        پلتفرم آموزشی حلزون، با رسالتی بزرگ و هدفی ارزشمند، برای پرورش نسل آینده طراحی شده است. این
                        پلتفرم با رویکردی نوین در ارائه آموزش‌های تخصصی، خلاقانه، و متناسب با نیازهای کودکان و نوجوانان،
                        طیف گسترده‌ای از آموزش‌ها را برای سنین 3 تا 18 سال فراهم می‌کند. در حلزون، اعتقاد داریم که آموزش
                        باید الهام‌بخش، سرگرم‌کننده و کاربردی باشد تا بتواند مهارت‌های اساسی زندگی و یادگیری را در
                        کودکان و نوجوانان تقویت کند.
                    </p>

                </div>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-4">
            <div class="flex h-full p-3 items-center justify-center">
                <img class="w-64" class="" src="/assets/logo.png" alt="درباره حلزون">
            </div>
        </div>
    </div>



    <div class="mt-5 grid grid-cols-12 rounded-3xl container mx-auto bg-main25">
        <div class="col-span-12 sm:col-span-12 p-6 sm:p-20">
            <div class="flex flex-wrap h-full items-center">
                <div class="space-y-3 sm:space-y-5">
                    <h1 class="text-main font-extrabold text-2xl sm:text-2lg ">
                        تاریخچه حلزون
                    </h1>
                    <div class="mt-3 ">
                        <section class="mb-8">
                            <p class="text-gray-700 leading-relaxed">
                                پلتفرم آموزشی <span class="font-semibold text-primary">حلزون</span>، فعالیت خود را از
                                <span class="font-semibold">مهرماه 1403</span> آغاز کرد. از همان ابتدا، تمرکز اصلی ما بر
                                ایجاد فضایی مناسب برای یادگیری کودکان و نوجوانان بوده است.
                                ما با جذب و گزینش معلمان باتجربه و متخصص، استانداردهایی بالا برای آموزش‌های ارائه‌شده
                                تعیین کرده‌ایم.
                                فرایند انتخاب معلمان شامل ارزیابی مهارت‌ها، تجربه، و توانایی ارتباط موثر با دانش‌آموزان
                                است تا اطمینان حاصل کنیم که هر دانش‌آموز با بهترین معلمان در حوزه خود در ارتباط خواهد
                                بود.
                                در این مسیر، تلاش کرده‌ایم تا با ارائه آموزش‌هایی با کیفیت بالا و استفاده از روش‌های
                                نوین تدریس، پلتفرمی بسازیم که پاسخگوی نیازهای آموزشی نسل جدید باشد.
                            </p>
                        </section>

                    </div>

                </div>
            </div>
        </div>
    </div>



    <div class="container mx-auto">

        <div class="bg-gray-100 rounded-lg shadow-md flex flex-col md:flex-row items-center p-6 md:p-8 my-8 mx-4 md:mx-0">

            <div class="w-full md:w-3/4 flex flex-col items-start pl-4">
                <h2 class="text-2xl font-semibold text-gray-800 mb-2">شما هم می‌توانید مدرس حلزون باشید!</h2>
                <p class="text-gray-700 mb-4">اگر تخصصی دارید و می‌خواهید دانش خود را با دیگران به اشتراک بگذارید، در
                    حلزون ثبت‌نام کنید. دوره‌های خود را به فروش بگذارید و به جامعه بزرگ ما بپیوندید.</p>
                <a href="{{ route('teacher.landing') }}"
                   class="px-6 py-3 bg-main text-white rounded-full font-semibold text-center transition duration-300 ease-in-out hover:bg-main100">
                    همکاری با حلزون
                </a>
            </div>


            <div class="w-full md:w-1/4 mb-4 md:mb-0">
                <img src="/assets/home/image/teacher.png" alt="Become a teacher on Halazon"
                     class="rounded-lg object-cover w-60 ">
            </div>

        </div>
    </div>


    <div class="mt-5 grid grid-cols-12 rounded-3xl container mx-auto bg-orange-100">
        <div class="col-span-12 sm:col-span-12 p-6 sm:p-20">
            <div class="flex flex-wrap h-full items-center">
                <div class="space-y-3 sm:space-y-5">
                    <h1 class="text-main font-extrabold text-2xl sm:text-2lg ">
                        هدف ما
                    </h1>
                    <div class="mt-3 ">
                        <section>
                            <p class="text-gray-700 leading-relaxed">
                                هدف اصلی <span class="font-semibold text-main">حلزون</span>، ایجاد بستری برای رشد
                                همه‌جانبه کودکان و نوجوانان است. ما بر این باوریم که یادگیری تنها به حفظ کردن و امتحان
                                دادن محدود نمی‌شود؛ بلکه باید به شکلی انجام شود که توانایی‌های فردی، خلاقیت، و تفکر
                                انتقادی دانش‌آموزان را به حداکثر برساند.
                                حلزون در تلاش است تا به کودکان و نوجوانان کمک کند که با شناخت استعدادهای خود، مسیر
                                آینده‌شان را با اطمینان و انگیزه بیشتری طی کنند.
                                هدف ما پرورش نسل‌هایی است که به‌خوبی آموزش دیده‌اند، آماده برای چالش‌های زندگی هستند، و
                                در جامعه تأثیری مثبت خواهند گذاشت.
                            </p>
                        </section>

                    </div>

                </div>
            </div>
        </div>
    </div>






    <div class="bg-blue-50 py-16 mt-8">
        <div class="container mx-auto flex flex-col lg:flex-row items-center px-6 lg:px-12">

            <div class="lg:w-1/2">
                <div class="flex w-full h-full justify-center items-center">
                    <img src="/assets/home/contact1.png" alt="پلتفرم آموزشی حلزون"
                         class="h-80">
                </div>
            </div>

            <!-- متن -->
            <div class="lg:w-1/2 text-center  mb-8 lg:mb-0">
                <h1 class="text-4xl font-bold text-gray-800 leading-tight">
                    آموزش حرفه‌ای برای نسل آینده
                </h1>
                <p class="text-gray-600 mt-4 leading-relaxed">
                    در <span class="font-semibold text-main">حلزون</span>، ما تلاش می‌کنیم با ارائه آموزش‌های تخصصی و
                    نوین، مسیر رشد کودکان و نوجوانان را هموار کنیم. اگر سؤال یا پیشنهادی دارید، با ما در تماس باشید.
                </p>
                <a href="{{route('contact.index')}}"
                   class="mt-6 inline-block bg-main text-white  py-3 px-6 rounded-full shadow-md hover:bg-main100 transition">
                    ارتباط با ما
                </a>
            </div>

        </div>
    </div>

@endsection
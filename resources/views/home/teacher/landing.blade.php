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
        <div class="border rounded-lg shadow p-4">
            <div class="grid grid-cols-12">
                <div class="col-span-12 sm:col-span-8">
                    <div class="flex items-center h-full">
                        <div>
                            <h3 class="text-2xl text-main font-extrabold">فرآیند تدریس در حلزون</h3>
                            <p class="mt-4">
                                آموزش در پلتفرم حلزون به دو صورت آنلاین و آفلاین ارائه می‌شود. برای آشنایی بیشتر با
                                جزئیات هر
                                یک، روی گزینه‌های موجود کلیک کنید.
                            </p>

                            <div class="mt-4 space-x-2">
                                <button
                                        onclick="showContent('online')"
                                        class="p-2 text-sm sm:text-base bg-main25 rounded-lg"
                                        id="onlineBtn"
                                >
                                    فرایند آموزش آنلاین
                                </button>

                                <button
                                        onclick="showContent('offline')"
                                        class="p-2 text-sm sm:text-base bg-main25 rounded-lg"
                                        id="offlineBtn"
                                >
                                    فرایند آموزش آفلاین
                                </button>
                            </div>

                            <!-- Content for Online Process -->
                            <div id="onlineContent" class="mt-4 hidden">

                                <div class="bg-main25 p-3 rounded-lg my-4">
                                    <h2 class="font-semibold text-lg"> 1) ثبت نام و تکمیل اطلاعات</h2>
                                    <p class="mt-2">
                                        برای تکمیل ثبت‌نام به‌عنوان مدرس در حلزون، لازم است اطلاعات خود را به‌دقت وارد
                                        کنید. در این مرحله، شما می‌توانید نمونه‌کارهای آموزشی خود را بارگذاری کرده و
                                        ویدیوی معرفی کوتاهی از خودتان ارائه دهید تا ما و دانش‌آموزان بتوانند بهتر با
                                        توانایی‌ها و سبک تدریس شما آشنا شوند. همچنین، دسته‌بندی‌های موضوعی که قصد تدریس
                                        در آن‌ها را دارید، مشخص کنید تا دانش‌آموزان مناسب را به دوره‌های شما هدایت کنیم.
                                        این فرآیند به شما کمک می‌کند تا بهترین شروع ممکن را در پلتفرم حلزون داشته باشید.
                                    </p>
                                </div>


                                <div class="bg-main25 p-3 rounded-lg my-4">
                                    <h2 class="font-semibold text-lg"> 2) تعریف کلاس در پلتفرم</h2>
                                    <p class="mt-2">
                                        برای تعریف کلاس در پلتفرم حلزون، نیاز است جزئیات دوره خود را به‌صورت دقیق وارد
                                        کنید. این شامل انتخاب عنوان مناسب برای دوره، تعیین ظرفیت کلاس، مشخص کردن روزهای
                                        برگزاری جلسات و همچنین هزینه دوره است. این اطلاعات به دانش‌آموزان کمک می‌کند تا
                                        دوره‌ی شما را بهتر درک کرده و با آگاهی بیشتری ثبت‌نام کنند.
                                    </p>
                                </div>

                                <div class="bg-main25 p-3 rounded-lg my-4">
                                    <h2 class="font-semibold text-lg"> 3) برگزاری مرتب کلاس زیر نظر حلزون</h2>
                                    <p class="mt-2">
                                        پس از تأیید دوره توسط کارشناسان حلزون، شما می‌توانید کلاس خود را به‌طور منظم و
                                        با حمایت تیم ما در بستر پلتفرم برگزار کنید. تیم پشتیبانی حلزون در کنار شماست تا
                                        از روند برگزاری کلاس اطمینان حاصل شود و بهترین تجربه آموزشی برای شما و
                                        دانش‌آموزانتان فراهم گردد. به این ترتیب، با خیالی آسوده به تدریس بپردازید و تنها
                                        بر ارائه محتوای آموزشی خود تمرکز کنید.

                                    </p>
                                </div>

                            </div>

                            <!-- Content for Offline Process -->
                            <div id="offlineContent" class="mt-4 hidden">

                                <div class="bg-main25 p-3 rounded-lg my-4">
                                    <h2 class="font-semibold text-lg"> 1) ثبت نام و تکمیل اطلاعات</h2>
                                    <p class="mt-2">
                                        برای تکمیل ثبت‌نام به‌عنوان مدرس در حلزون، لازم است اطلاعات خود را به‌دقت وارد
                                        کنید. در این مرحله، شما می‌توانید نمونه‌کارهای آموزشی خود را بارگذاری کرده و
                                        ویدیوی معرفی کوتاهی از خودتان ارائه دهید تا ما و دانش‌آموزان بتوانند بهتر با
                                        توانایی‌ها و سبک تدریس شما آشنا شوند. همچنین، دسته‌بندی‌های موضوعی که قصد تدریس
                                        در آن‌ها را دارید، مشخص کنید تا دانش‌آموزان مناسب را به دوره‌های شما هدایت کنیم.
                                        این فرآیند به شما کمک می‌کند تا بهترین شروع ممکن را در پلتفرم حلزون داشته باشید.
                                    </p>
                                </div>

                                <div class="bg-main25 p-3 rounded-lg my-4">
                                    <h2 class="font-semibold text-lg"> 2) تعریف کلاس در پلتفرم</h2>
                                    <p class="mt-2">
                                        برای تعریف کلاس در پلتفرم حلزون، نیاز است جزئیات دوره خود را به‌صورت دقیق وارد
                                        کنید. این شامل انتخاب عنوان مناسب برای دوره، تعیین ظرفیت کلاس، مشخص کردن روزهای
                                        برگزاری جلسات و همچنین هزینه دوره است. این اطلاعات به دانش‌آموزان کمک می‌کند تا
                                        دوره‌ی شما را بهتر درک کرده و با آگاهی بیشتری ثبت‌نام کنند.
                                    </p>
                                </div>

                                <div class="bg-main25 p-3 rounded-lg my-4">
                                    <h2 class="font-semibold text-lg"> 3) ایجاد سرفصل و آپلود محتوای جلسه</h2>
                                    <p class="mt-2">
                                        در فرآیند تعریف دوره، شما می‌توانید سرفصل‌های هر جلسه را مشخص کرده و محتوای
                                        آموزشی مربوطه را در پلتفرم حلزون آپلود کنید. این سرفصل‌ها می‌توانند شامل ویدیو،
                                        فایل‌های آموزشی، تمرین‌ها و مطالب تکمیلی باشند. همچنین، این امکان وجود دارد که
                                        برخی از سرفصل‌ها را در صورت تمایل به‌صورت رایگان در دسترس دانش‌آموزان قرار دهید
                                        تا آن‌ها با کیفیت محتوای شما بیشتر آشنا شوند. این قابلیت می‌تواند در جذب مخاطبین
                                        بیشتر و افزایش محبوبیت دوره‌ی شما مؤثر باشد.
                                    </p>
                                </div>

                                <div class="bg-main25 p-3 rounded-lg my-4">
                                    <h2 class="font-semibold text-lg"> 4) شروع فروش دوره </h2>
                                    <p class="mt-2">
                                        پس از تکمیل اطلاعات و سرفصل‌های دوره و بررسی توسط کارشناسان حلزون، دوره‌ی شما
                                        آماده‌ی عرضه در پلتفرم خواهد شد. با تایید دوره، فروش آن آغاز می‌شود و کاربران
                                        می‌توانند به راحتی دوره شما را مشاهده و ثبت‌نام کنند. حلزون با فراهم کردن بستری
                                        مطمئن و گسترده، به شما کمک می‌کند تا با دسترسی به مخاطبان بیشتر، فروش بهتری را
                                        تجربه کنید و به صورت حرفه‌ای به تدریس بپردازید.
                                    </p>
                                </div>


                            </div>
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
                                    <h6 class="font-bold">درصد کمسیون پلتفرم حلزون</h6>
                                    <a class="font-bold text-main text-2xl">35%</a>
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

@extends('.home.layouts.main.master')
@section('content')

<main class="container mx-auto px-6 py-12">
    <!-- مقدمه -->
    <section class="mb-10">
        <h1 class="text-2xl font-extrabold mb-4">قوانین و مقررات</h1>
        <p class="text-gray-600 leading-relaxed">
            لطفاً قبل از استفاده از خدمات ما، تمامی قوانین و مقررات را با دقت مطالعه فرمایید. استفاده از خدمات حلزون به منزله پذیرش این شرایط است.
        </p>
    </section>

    <!-- کارت‌های قوانین -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- بخش تعاریف -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-xl font-semibold text-main mb-2">1. تعاریف</h3>
            <ul class="list-disc pl-5 text-gray-700 space-y-2">
                <li>حلزون: پلتفرم آموزشی آنلاین.</li>
                <li>کاربر: فرد استفاده‌کننده از خدمات سایت.</li>
                <li>مدرس: ارائه‌دهنده محتوای آموزشی.</li>
                <li>دوره آموزشی: محتوای آموزشی شامل ویدیو، متن یا صوت.</li>
            </ul>
        </div>

        <!-- بخش ثبت‌نام -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-xl font-semibold text-main mb-2">2. ثبت‌نام و حساب کاربری</h3>
            <p class="text-gray-700 leading-relaxed">
                کاربران موظف به ارائه اطلاعات صحیح در زمان ثبت‌نام هستند. حفاظت از اطلاعات ورود بر عهده خود کاربر است.
            </p>
        </div>

        <!-- بخش استفاده از محتوا -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-xl font-semibold text-main mb-2">3. استفاده از محتوای آموزشی</h3>
            <p class="text-gray-700 leading-relaxed">
                کاربران فقط مجاز به استفاده شخصی از محتوا هستند. بازنشر یا استفاده تجاری بدون مجوز ممنوع است.
            </p>
        </div>

        <!-- بخش همکاری مدرسان -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-xl font-semibold text-main mb-2">4. همکاری مدرسان</h3>
            <p class="text-gray-700 leading-relaxed">
                مدرسان باید محتوای آموزشی باکیفیت و مطابق قوانین ارائه دهند. درآمد مطابق قرارداد تقسیم می‌شود.
            </p>
        </div>

        <!-- بخش حقوق مالکیت معنوی -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-xl font-semibold text-main mb-2">5. حقوق مالکیت معنوی</h3>
            <p class="text-gray-700 leading-relaxed">
                کلیه حقوق سایت و محتوا متعلق به حلزون است. هرگونه بهره‌برداری تجاری بدون مجوز پیگرد قانونی دارد.
            </p>
        </div>

        <!-- بخش حریم خصوصی -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-xl font-semibold text-main mb-2">6. حریم خصوصی</h3>
            <p class="text-gray-700 leading-relaxed">
                اطلاعات شخصی کاربران به صورت محرمانه نگهداری شده و فقط در چارچوب ارائه خدمات استفاده می‌شود.
            </p>
        </div>
    </div>


</main>

@endsection
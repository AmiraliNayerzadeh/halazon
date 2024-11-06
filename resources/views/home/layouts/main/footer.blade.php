<footer class="bg-main25 mt-4 ">
    <img class="w-full" src="/assets/home/splittop.svg" alt="split top">
    <div class="container mx-auto  py-2 px-5 sm:px-0 ">
        <div class="grid grid-cols-12 py-4">

            <div class="col-span-12 sm:col-span-6 mb-5 sm:mb-0"><a href="{{route('home')}}"><img class="w-[120px]" src="/assets/logo.png" alt="hlalazon Logo"></a>
                <ul class="space-y-3">
                    <li> آموزش مجازی با کیفیت برای همه؛ بدون مرز، همیشه، همه‌جا</li>

                    <li>
                        <i class="fa-regular fa-phone-volume"></i>
                        <a class="hover:text-primary duration-200" href="tel:989374796092">09374796092</a>
                    </li>

                    <li>
                        <i class="fa-regular fa-mail-bulk"></i>
                        <a class="hover:text-primary duration-200" href="mailto:info@halazoon.org">info@halazoon.org</a>
                    </li>
                </ul>
            </div>


            <div class="col-span-6 sm:col-span-2">
                <h5 class="font-extrabold text-main100 mb-4">دسترسی سریع:</h5>
                <ul class="list-disc space-y-3">
                    <li><a class="hover:text-primary duration-200 {{\Illuminate\Support\Facades\Request::is('degrees*') ? 'text-primary' :''}}" href="{{route('degrees.index')}}">مقاطع</a></li>
                    <li><a class="hover:text-primary duration-200 {{\Illuminate\Support\Facades\Request::is('blogs*') ? 'text-primary' :''}}" href="{{route('blog.index')}}">مجله</a></li>
                    <li><a class="hover:text-primary duration-200 {{\Illuminate\Support\Facades\Request::is('teacher*') ? 'text-primary' :''}}" href="{{route('teacher.index')}}">معلمین حلزون</a></li>
                </ul>
            </div>


            <div class="col-span-6 sm:col-span-2">
                <h5 class="font-extrabold text-main100 mb-4">خدمات:</h5>
                <ul class="list-disc space-y-3">
                    <li><a class="hover:text-primary duration-200" href="">درباره‌ حلزون</a></li>
                    <li><a class="hover:text-primary duration-200" href="#">تماس با ما</a></li>
                    <li><a class="hover:text-primary duration-200" href="#">سوالات متداول</a></li>
                    <li><a class="hover:text-primary duration-200" href="#">شرایط استفاده</a></li>
                </ul>
            </div>

            <div class="col-span-6 sm:col-span-2">
                <h5 class="font-extrabold text-main100 mb-4">همکاری با حلزون:</h5>
                <ul class="list-disc space-y-3">
                    <li><a class="hover:text-primary duration-200 {{\Illuminate\Support\Facades\Request::is('work-as-teacher') ? 'text-primary' :''}}"  href="{{route('teacher.landing')}}">تدریس در حلزون</a></li>
                    <li><a class="hover:text-primary duration-200" href="#">همکاری در تولید محتوا</a></li>
                    <li><a class="hover:text-primary duration-200" href="#"> فرصت‌های شغلی</a></li>
                </ul>
            </div>


        </div>

        <div class="grid grid-cols-12 py-5 border-t border-b border-main">

            <div class="col-span-6 space-y-4">
                <div class="flex items-center h-full ">
                    <div class="mt-3">
                        <span class="text-lg"><b class="text-main50 font-extrabold">حلزون </b>را در شبکه‌های اجتماعی دنبال کنید:</span>

                        <div class="flex">
                            <a class="text-4xl mx-1" href="#">
                                <i class="fa-brands fa-telegram text-blue-700 hover:text-main duration-700"></i>
                            </a>

                            <a class="text-4xl mx-1" href="#">
                                <i class="fa-brands fa-youtube text-red-700 hover:text-main duration-700"></i>
                            </a>

                            <a class="text-4xl mx-1" href="#">
                                <i class="fa-brands fa-instagram text-purple-700 hover:text-main duration-700"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-span-6">
                <div class="flex items-center justify-end ">
                    <a referrerpolicy='origin' target='_blank' href='https://trustseal.enamad.ir/?id=529177&Code=IHgbDbtIfwAFQHK2ZhFWciFk2mZm866w'><img referrerpolicy='origin' src='https://trustseal.enamad.ir/logo.aspx?id=529177&Code=IHgbDbtIfwAFQHK2ZhFWciFk2mZm866w' alt='' style='cursor:pointer' code='IHgbDbtIfwAFQHK2ZhFWciFk2mZm866w'></a>
                </div>
            </div>
        </div>


    </div>
    <div class="">
        <div class="flex w-full items-center justify-center py-5">
            <div>
                ©
                <script>document.write(new Date().getFullYear())</script>
                توسعه با <i class="fa fa-heart"></i> توسط
                <a href="https://mollygroup.ir/" class="font-weight-bold" target="_blank">گروه توسعه مولی</a>
            </div>
        </div>
    </div>
</footer>
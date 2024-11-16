@extends('.home.layouts.main.master')

@section('content')


    <div class="container mx-auto py-8 px-4">
        <!-- عنوان اصلی -->
        <h1 class="text-4xl font-bold text-center text-gray-800 mb-4">تماس با ما</h1>
        <p class="text-center text-gray-600 mb-8">
            اگر سوال یا مشکلی دارید، از طریق فرم زیر یا راه‌های ارتباطی با ما در تماس باشید.
        </p>

        <!-- محتوای صفحه -->
        <div class="flex flex-col md:flex-row bg-white shadow-md rounded-lg overflow-hidden">
            <!-- سمت راست: فرم -->
            <div class="md:w-1/2 p-6">
                <form action="{{route('contact.store')}}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-medium mb-2">نام و نام خانوادگی</label>
                        <input type="text" id="name" name="name" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="نام خود را وارد کنید" value="{{old('name')}}">
                    </div>
                    <div class="mb-4">
                        <label for="mobile" class="block text-gray-700 font-medium mb-2">شماره تماس</label>
                        <input type="text" id="mobile" name="phone" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="شماره تماس خود را وارد کنید" {{old('phone')}}>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 font-medium mb-2">ایمیل</label>
                        <input type="email" id="email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="ایمیل خود را وارد کنید" {{old('email')}}>
                    </div>
                    <div class="mb-6">
                        <label for="description" class="block text-gray-700 font-medium mb-2">توضیحات</label>
                        <textarea id="description" name="description" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="پیام خود را وارد کنید">{{old('description')}}</textarea>
                    </div>
                    <button type="submit" class="w-full bg-main text-white font-bold py-2 px-4 rounded-md hover:bg-main100 transition duration-300">ارسال پیام</button>
                </form>
            </div>

            <!-- سمت چپ: تصویر -->
            <div class="md:w-1/2 bg-gray-200 flex items-center justify-center">
                <img  src="/assets/home/contact1.png" alt="تماس با ما" class=" max-h-96 w-auto">
            </div>
        </div>


        <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="flex items-center bg-white shadow-md rounded-lg p-4">
                <i class="fas fa-phone-alt text-blue-500 text-2xl"></i>
                <div class="ml-4">
                    <h3 class="font-bold text-gray-800">شماره تماس</h3>
                    <p class="text-gray-600">
                        <a class="hover:text-primary duration-200" href="tel:989374796092">09374796092</a>
                    </p>
                </div>
            </div>


            <div class="flex items-center bg-white shadow-md rounded-lg p-4">
                <i class="fas fa-envelope text-blue-500 text-2xl"></i>
                <div class="ml-4">
                    <h3 class="font-bold text-gray-800">ایمیل</h3>
                    <p class="text-gray-600">
                        <a class="hover:text-primary duration-200" href="mailto:info@halazoon.org">info@halazoon.org</a>
                    </p>
                </div>
            </div>


            <div class="flex items-center bg-white shadow-md rounded-lg p-4">
                <i class="fab fa-instagram text-pink-500 text-2xl"></i>
                <div class="ml-4">
                    <h3 class="font-bold text-gray-800">اینستاگرام</h3>
                    <p class="text-gray-600">
                        <a href="https://www.instagram.com/halazoon_org">@halazoon_org</a>
                    </p>
                </div>
            </div>

            <div class="flex items-center bg-white shadow-md rounded-lg p-4">
                <i class="fab fa-telegram-plane text-blue-500 text-2xl"></i>
                <div class="ml-4">
                    <h3 class="font-bold text-gray-800">تلگرام</h3>
                    <p class="text-gray-600">
                        <a href="">Halazoon_contact</a>
                    </p>
                </div>
            </div>
        </div>
    </div>


@endsection
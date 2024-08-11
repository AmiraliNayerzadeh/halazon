@extends('.home.profile.master')

@section('content')

    <h1 class="text-2xl font-extrabold text-main my-4">
        <i class="fa fa-gear"></i>
        تنظیمات حساب کاربری</h1>

    <form action="{{route('profile.update' , $user)}}" method="post">
        @csrf
        @method('PUT')
        <div class="bg-main25 shadow rounded-3xl mb-3">
            <h3 class="p-4 text-lg font-extrabold">
                <i class="fa fa-user mx-1"></i>اطلاعات فردی</h3>
            <div class="grid grid-cols-12 p-2">

                <div class="col-span-12 sm:col-span-4 m-3">
                    <label class="grid mb-2 " for="name"><span>نام:<small class="text-red-600">*</small></span></label>
                    <input class="rounded-lg w-full border-main" type="text" name="name" id="name"
                           value="{{old('name') ? old('name') : $user->name }}" required
                           placeholder="نام خود را وارد کنید.">
                </div>

                <div class="col-span-12 sm:col-span-4 m-3">
                    <label class="grid mb-2 " for="family"><span>نام خانوادگی:<small
                                class="text-red-600">*</small></span></label>
                    <input class="rounded-lg w-full border-main" type="text" name="family" id="family"
                           value="{{old('family') ? old('family') : $user->family }}" required
                           placeholder="نام خانوادگی خود را وارد کنید.">
                </div>


                <div class="col-span-12 sm:col-span-4 m-3">
                    <label class="grid mb-2 " for="gender"><span>جنسیت:<small
                                class="text-red-600">*</small></span></label>
                    <select class="rounded-lg w-full border-main" name="gender" id="gender" required>
                        <option>انتخاب کنید...</option>
                        <option {{$user->gender == 'male' ? 'selected' : ''}} value="male">آقا</option>
                        <option {{$user->gender == 'female' ? 'selected' : ''}} value="female">خانم</option>
                    </select>
                </div>


                <div class="col-span-12 sm:col-span-4 m-3">
                    <label class="grid mb-2 " for="nationalCode">کُد ملی:</label>
                    <input class="rounded-lg w-full border-main" type="text" name="nationalCode" id="nationalCode"
                           value="{{old('nationalCode') ? old('nationalCode') : $user->nationalCode }}"
                           placeholder="کُد ملی خود را وارد کنید">
                </div>

                <div class="col-span-12 sm:col-span-4 m-3">
                    <label class="grid mb-2 " for="birthday">تاریخ تولد:</label>
                    <input autocomplete="off" data-jdp class="rounded-lg w-full border-main" type="text" name="birthday"
                           id="birthday"
                           value="{{!is_null($user->birthday) ? str_replace('-', '/', jdate($user->birthday)->toDateString()) : old('birthday')}}"
                           placeholder="تاریخ تولد را انتخاب کنید">
                </div>


            </div>
        </div>

        <div class="bg-main25 shadow rounded-3xl mb-3">
            <h3 class="p-4 text-lg font-extrabold">
                <i class="fa fa-home mx-1"></i>آدرس:</h3>
            <div class="grid grid-cols-12 p-2">

                <div class="col-span-12 sm:col-span-4 m-3">
                    <label class="grid mb-2 " for="postalCode">کُد پستی:</label>
                    <input class="rounded-lg w-full border-main" type="number" name="postalCode" id="postalCode"
                           value="{{old('postalCode') ? old('postalCode') : $user->postalCode }}"
                           placeholder="کُدپستی خود را وارد کنید.">
                </div>

                <div class="col-span-12 sm:col-span-8 m-3">
                    <label class="grid mb-2 " for="address">آدرس:</label>
                    <input class="rounded-lg w-full border-main" type="text" name="address" id="address"
                           value="{{old('address') ? old('address') : $user->address }}"
                           placeholder="آدرس محل سکونت خود را وارد کنید.">
                </div>

            </div>
        </div>

        <div class="bg-main25 shadow rounded-3xl mb-3">
            <h3 class="p-4 text-lg font-extrabold">
                <i class="fa fa-heart-circle-bolt mx-1"></i>به چه موضوعاتی علاقه مندید؟</h3>
            <div class="">


                <ul class="grid w-full gap-6 md:grid-cols-4 p-3">

                    @foreach(\App\Models\Category::where('parent_id' , null)->get() as $category)
                        <li>
                            <input  type="checkbox" name="categories[]" id="{{$category->title_en}}"
                                   value="{{$category->id}}" class="hidden peer" {{in_array($category->id , $user->categories->pluck('id')->toArray())? 'checked' : ''}} >
                            <label for="{{$category->title_en}}"
                                   class="inline-flex border-2  items-center justify-between w-full p-1 text-gray-500 bg-gray-100 hover:bg-white  rounded-lg cursor-pointer  hover:text-main50  peer-checked:text-main100 peer-checked:bg-green-100  duration-700  peer-checked:border-main  ">
                                <div class="flex items-center">
                                    <img class="rounded-lg h-16 my-2"
                                         src="{{$category->image != null ? $category->image : '/assets/default-image.jpg'}}">
                                    <div class=" mr-2 text-lg">{{$category->title}}</div>
                                </div>
                            </label>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="flex justify-end mx-3">
            <button class="px-2 py-3 bg-main50 hover:bg-main duration-700 text-white rounded" type="submit">ثبت و
                بروزرسانی
            </button>
        </div>

    </form>



    @section('script')
        <link id="pagestyle" href="/assets/admin/plugin/JalaliDatePicker-main/dist/jalalidatepicker.min.css"
              rel="stylesheet"/>
        <script src="/assets/admin/plugin/JalaliDatePicker-main/dist/jalalidatepicker.min.js"></script>

        <script>
            jalaliDatepicker.startWatch();
        </script>
    @endsection

@endsection

<div class="bg-white shadow rounded-2xl overflow-hidden flex flex-col md:flex-row w-full my-3">

    <div class="w-full md:w-1/2 p-10">
        <div class="text-center">
            <h4 class="text-lg font-extrabold mb-2 text-blue-800 text-center">هر دوره ای بخوای جلسه اولش رایگانه!</h4>
            <p class="mb-6">فقط کافیه اطلاعات را پر کنید تا مشاورین ما در اسرع وقت با شما تماس بگیرند.</p>
        </div>
        <form class="space-y-5" method="post" action="{{route('lead.store')}}">
            @csrf
            @method('POST')
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">نام و نام خانوادگی</label>
                <input name="name" value="{{old('name')}}" type="text" placeholder="مثلاً: علی رضایی" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 shadow-sm" />
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">شماره تلفن</label>
                <input  name="phone" value="{{old('phone')}}" type="number" placeholder="مثلاً: 09121234567" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 shadow-sm" />
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">مقطع تحصیلی</label>
                <select  name="degree"  class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 shadow-sm">
                    <option disabled selected>انتخاب کنید</option>
                    <option {{ old('degree') == 'اول' ? 'selected' : '' }}>اول دبستان</option>
                    <option {{ old('degree') == 'دوم' ? 'selected' : '' }}>دوم دبستان</option>
                    <option {{ old('degree') == 'سوم' ? 'selected' : '' }}>سوم دبستان</option>
                    <option {{ old('degree') == 'چهارم' ? 'selected' : '' }}>چهارم دبستان</option>
                    <option {{ old('degree') == 'پنجم' ? 'selected' : '' }}>پنجم دبستان</option>
                    <option {{ old('degree') == 'ششم' ? 'selected' : '' }}>ششم دبستان</option>
                    <option {{ old('degree') == 'هفتم' ? 'selected' : '' }}>هفتم (متوسطه اول)</option>
                    <option {{ old('degree') == 'هشتم' ? 'selected' : '' }}>هشتم (متوسطه اول)</option>
                    <option {{ old('degree') == 'نهم' ? 'selected' : '' }}>نهم (متوسطه اول)</option>
                </select>
            </div>
            <!-- دکمه ارسال -->
            <div>
                <button type="submit" class="w-full bg-gradient-to-r from-purple-500 to-blue-500 text-white py-3 rounded-xl font-semibold hover:scale-105 transition-transform duration-300 shadow-lg">
                    ارسال فرم
                </button>
            </div>
        </form>
    </div>

    <!-- سمت چپ: تصویر -->
    <div class="hidden md:block w-1/2 bg-cover bg-center" style="background-image: url('/assets/home/leadComponent.png');">
    </div>
</div>

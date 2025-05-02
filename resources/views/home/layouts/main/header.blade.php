@if(auth()->user() && auth()->user()->is_teacher == 1)
    <div class="p-2 sm:p-3 bg-main25 text-sm sm:text-base">
        <div class="container mx-auto">
            <a href="{{route('teachers.dashboard')}}" class="flex items-center gap-2">
                <i class="fas fa-chalkboard-teacher"></i>
                <span>ورود به پنل مدرسین</span>
            </a>
        </div>
    </div>
@endif

<header class="bg-white shadow-md sticky top-0 z-50">
    <div class="container mx-auto px-4">
        <!-- بخش بالایی هدر -->
        <div class="flex items-center justify-between py-3">
            <!-- لوگو و دکمه منو در موبایل -->
            <div class="flex items-center gap-4">
                <button id="mobileMenuButton" class="lg:hidden text-gray-700">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <a href="{{route('home')}}" class="flex-shrink-0">
                    <img src="/assets/logo.png" alt="logo" class="w-24 sm:w-32">
                </a>
            </div>

            <!-- نوار جستجو -->
            <div class="hidden lg:flex flex-1 max-w-xl mx-4">
                <div class="relative w-full">
                    <input type="text" placeholder="جستجو میان دوره های حلزون..."
                           class="w-full py-2 px-4 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-main50 focus:border-transparent">
                    <button class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>

            <!-- بخش اقدامات کاربر -->
            <div class="flex items-center gap-2 sm:gap-4">
                <!-- دکمه جستجو در موبایل -->
                <button id="mobileSearchButton" class="lg:hidden p-2 text-gray-700 w-8 h-8 ">
                    <i class="fas fa-search text-xl "></i>
                </button>

                <!-- علاقه‌مندی‌ها -->
                <a href="{{route('profile.favorite')}}" class="p-2 text-gray-700 hover:text-main relative w-8 h-8">
                    <i class="far fa-heart text-xl"></i>
                </a>

                <!-- سبد خرید -->
                <a href="{{route('cart.index')}}" class="p-2 text-gray-700 hover:text-main relative w-8 h-8">
                    <i class="fas fa-shopping-cart text-xl"></i>
                    @php
                        $cart = \App\Models\Cart::where('user_id', auth()->id())->first();
                        $itemCount = $cart ? $cart->items->count() : 0;
                    @endphp
                    @if($itemCount > 0)
                        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">
                            {{ $itemCount }}
                        </span>
                    @endif
                </a>

                <!-- بخش کاربر -->
                @auth
                    <div class="relative group">
                        <button class="flex items-center gap-2 p-2 rounded-full hover:bg-gray-100">
                            @if(!is_null(auth()->user()->name))
                                <span class="hidden sm:inline text-sm font-medium">{{auth()->user()->name}} {{auth()->user()->family}}</span>
                            @else
                                <span class="hidden sm:inline text-sm font-medium">{{auth()->user()->phone}}</span>
                            @endif
                            <div class="w-8 h-8 rounded-full bg-main text-white flex items-center justify-center">
                                <i class="far fa-user text-sm"></i>
                            </div>
                        </button>

                        <!-- منوی کاربر -->
                        <div class="absolute left-1 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 hidden group-hover:block">
                            <a href="{{route('profile.index')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-user-circle ml-2"></i> پروفایل کاربری
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="block w-full text-left">
                                @csrf
                                <button type="submit" class="w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-sign-out-alt ml-2"></i> خروج
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="flex gap-2">
                        <a href="{{route('login')}}" class="hidden sm:block px-3 py-2 bg-main hover:bg-main100 text-white text-sm rounded-full">
                            ورود / ثبت نام
                        </a>
                        <a href="{{route('login')}}" class="sm:hidden p-2 text-main">
                            <i class="fas fa-user-circle text-xl"></i>
                        </a>
                    </div>
                @endauth
            </div>
        </div>

        <nav class="hidden lg:block border-t border-gray-100  relative">
            <ul class="flex justify-center gap-6 py-2">
                @foreach(\App\Models\Category::where('parent_id', null)->get() as $main)
                    <li class="group">
                        <a href="{{route('category', $main)}}" class="flex items-center py-2 px-3 text-gray-700 hover:text-main font-medium">
                            {{$main->title}}
                            @if(count($main->children))
                                <i class="fas fa-chevron-down mr-1 text-xs mt-1"></i>
                            @endif
                        </a>

                        @if(count($main->children))
                            <!-- مگامنو تمام عرض -->
                            <div class="absolute left-0 right-0  bg-white shadow-lg hidden group-hover:block z-50 p-5 border-t border-gray-100">
                                <div class="container mx-auto">
                                    <div class="flex">
                                        <!-- ستون اصلی -->
                                        <div class="w-1/4 pr-6 ">
                                            <h3 class="text-lg font-bold text-main mb-6">{{$main->title}}</h3>
                                            <ul class="space-y-3">
                                                @foreach($main->children as $child)
                                                    <li>
                                                        <a href="{{route('category', $child)}}" class="text-gray-800 hover:text-main font-medium block py-2">
                                                            {{$child->title}}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>

                                        <!-- زیرمنوها -->
                                        <div class="w-3/4 pl-6">
                                            <div class="grid grid-cols-3 gap-6">
                                                @foreach($main->children as $child)
                                                    @if(count($child->children))
                                                        <div>
                                                            <h4 class="text-gray-900 font-semibold mb-4">
                                                                <a href="{{route('category', $child)}}">{{$child->title}}</a>
                                                            </h4>
                                                            <ul class="space-y-2">
                                                                @foreach($child->children as $childest)
                                                                    <li>
                                                                        <a href="{{route('category', $childest)}}" class="text-gray-600 hover:text-main text-sm block py-1">
                                                                            {{$childest->title}}
                                                                        </a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </li>
                @endforeach
            </ul>
        </nav>

    <!-- منوی موبایل -->
    <div id="mobileMenu" class="fixed inset-y-0 right-0 w-80 bg-white shadow-xl z-50 transform translate-x-full transition-transform duration-300 ease-in-out overflow-y-auto">
        <div class="p-4 border-b flex justify-between items-center">
            <h3 class="text-lg font-bold">منو</h3>
            <button id="mobileMenuClose" class="text-gray-500">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <div class="p-4 border-b">
            @auth
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-main text-white flex items-center justify-center">
                        <i class="far fa-user"></i>
                    </div>
                    <div>
                        @if(!is_null(auth()->user()->name))
                            <p class="font-medium">{{auth()->user()->name}} {{auth()->user()->family}}</p>
                        @else
                            <p class="font-medium">{{auth()->user()->phone}}</p>
                        @endif
                        <a href="{{route('profile.index')}}" class="text-xs text-main">مشاهده پروفایل</a>
                    </div>
                </div>
            @else
                <div class="flex gap-2">
                    <a href="{{route('login')}}" class="flex-1 text-center py-2 bg-main text-white rounded-full">
                        ورود / ثبت نام
                    </a>
                </div>
            @endauth
        </div>

        <ul class="divide-y divide-gray-100">
            @foreach(\App\Models\Category::where('parent_id', null)->get() as $main)
                <li class="group">
                    <a href="{{route('category', $main)}}" class="flex items-center justify-between py-3 px-4 text-gray-700 hover:bg-gray-50">
                        <span>{{$main->title}}</span>
                        @if(count($main->children))
                            <i class="fas fa-chevron-left text-xs text-gray-400"></i>
                        @endif
                    </a>

                    @if(count($main->children))
                        <ul class="bg-gray-50 hidden">
                            @foreach($main->children as $child)
                                <li>
                                    <a href="{{route('category', $child)}}" class="flex items-center justify-between py-2 px-6 text-gray-600 hover:bg-gray-100">
                                        <span>{{$child->title}}</span>
                                        @if(count($child->children))
                                            <i class="fas fa-chevron-left text-xs text-gray-400"></i>
                                        @endif
                                    </a>

                                    @if(count($child->children))
                                        <ul class="bg-gray-100 hidden">
                                            @foreach($child->children as $childest)
                                                <li>
                                                    <a href="{{route('category', $childest)}}" class="block py-2 px-8 text-gray-600 hover:bg-gray-200">
                                                        {{$childest->title}}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>

    <!-- جستجوی موبایل -->
    <div id="mobileSearch" class="fixed inset-0 bg-white z-50 hidden">
        <div class="container mx-auto px-4 py-3">
            <div class="flex items-center gap-2">
                <button id="mobileSearchClose" class="text-gray-500">
                    <i class="fas fa-arrow-right text-xl"></i>
                </button>
                <div class="relative flex-1">
                    <input type="text" placeholder="جستجو میان دوره های حلزون..."
                           class="w-full py-3 px-4 pr-10 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-main50 focus:border-transparent">
                    <button class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</header>

    <script>
        // مدیریت منوی موبایل
        const mobileMenuButton = document.getElementById('mobileMenuButton');
        const mobileMenuClose = document.getElementById('mobileMenuClose');
        const mobileMenu = document.getElementById('mobileMenu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.remove('translate-x-full');
            document.body.style.overflow = 'hidden';
        });

        mobileMenuClose.addEventListener('click', () => {
            mobileMenu.classList.add('translate-x-full');
            document.body.style.overflow = 'auto';
        });

        // مدیریت زیرمنوها در موبایل
        document.querySelectorAll('#mobileMenu li > a').forEach(link => {
            if (link.nextElementSibling && link.nextElementSibling.tagName === 'UL') {
                link.addEventListener('click', (e) => {
                    e.preventDefault();
                    const subMenu = link.nextElementSibling;
                    subMenu.classList.toggle('hidden');

                    // چرخش آیکون
                    const icon = link.querySelector('i');
                    if (icon) {
                        icon.classList.toggle('rotate-90');
                    }
                });
            }
        });

        // مدیریت جستجوی موبایل
        const mobileSearchButton = document.getElementById('mobileSearchButton');
        const mobileSearchClose = document.getElementById('mobileSearchClose');
        const mobileSearch = document.getElementById('mobileSearch');

        mobileSearchButton.addEventListener('click', () => {
            mobileSearch.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        });

        mobileSearchClose.addEventListener('click', () => {
            mobileSearch.classList.add('hidden');
            document.body.style.overflow = 'auto';
        });
    </script>


<style>
    .group:hover .absolute {
        display: block !important;
    }
    .absolute {
        display: none;
    }
</style>

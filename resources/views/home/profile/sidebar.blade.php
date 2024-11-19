@php
    $user = auth()->user();
@endphp

<button onclick="toggleSidebar()"
        class="p-4 bg-main50 text-white fixed top-4 left-4 z-50 md:hidden rounded-md focus:outline-none">
    <i class="fa-solid fa-bars"></i>
</button>

<aside id="sidebar"
       class="fixed top-0 sm:top-20 border border-main50 sm:mt-3 w-72 h-full sm:h-auto bg-white shadow-xl transform translate-x-full md:translate-x-0 transition-transform duration-300 z-50 rounded-3xl">
    <div class="p-1 sm:p-4">

        <div class="flex justify-center">
            @if(!is_null($user->avatar))
                <img class="rounded-2xl h-24 w-auto" src="{{$user->avatar}}"
                     alt="{{$user->name}} {{$user->family}}">
            @else
                <img class="rounded-2xl h-24 w-auto" src="/assets/user-avatar.png" alt="{{$user->phone}}">
            @endif
        </div>

        <div class="flex justify-center">
            @if(!is_null($user->name) && !is_null($user->family) )
                <h3 class="text-center font-extrabold mt-3 text-main100">{{$user->name}} {{$user->family}}</h3>
            @else
                <h3 class="text-center font-extrabold mt-3 text-main100">{{$user->phone}}</h3>
            @endif
        </div>

        <ul class="space-y-3 mt-4">
            <li>
                <a href="{{route('profile.index')}}"
                   class="flex items-center hover:text-primary hover:bg-gray-100 px-8 py-2 sm:py-4 transition-all {{ Request::is('profile') ? 'bg-main25 border-main border-l-4' : 'border-primary' }}">
                    <i class="fa fa-dashboard mx-1"></i>
                    داشبورد
                </a>
            </li>
            <li>
                <a href="{{route('profile.comment')}}"
                   class="flex items-center hover:text-primary hover:bg-gray-100 px-8 py-2 sm:py-4 transition-all {{ Request::is('profile/comments') ? 'bg-main25 border-main border-l-4' : 'border-primary' }}">
                    <i class="fa fa-comment-alt mx-1"></i>
                    دیدگاه و سوالات
                </a>
            </li>
            <li>
                <a href="{{route('profile.favorite')}}"
                   class="flex items-center hover:text-primary hover:bg-gray-100 px-8 py-2 sm:py-4 transition-all {{ Request::is('profile/favorites') ? 'bg-main25 border-main border-l-4' : 'border-primary' }}">
                    <i class="fa fa-heart mx-1"></i>
                    علاقه مندی ها
                </a>
            </li>
            <li>
                <a href="{{route('profile.payment')}}"
                   class="flex items-center hover:text-primary hover:bg-gray-100 px-8 py-2 sm:py-4 transition-all  {{ Request::is('profile/payment') ? 'bg-main25 border-main border-l-4' : 'border-primary' }} ">
                    <i class="fa fa-money-bill mx-1"></i>
                    لیست تراکنش ها
                </a>
            </li>


            <li>
                <a href="#"
                   class="flex items-center hover:text-primary hover:bg-gray-100 px-8 py-2 sm:py-4 transition-all">
                    <i class="fa fa-book mx-1"></i>
                    پشتیبانی
                </a>
            </li>
            <li>
                <a href="{{route('profile.setting')}}"
                   class="flex items-center hover:text-primary hover:bg-gray-100 px-8 py-2 sm:py-4 transition-all {{ Request::is('profile/setting') ? 'bg-main25 border-main border-l-4' : 'border-primary' }}">
                    <i class="fa fa-gear mx-1"></i>
                    اطلاعات کاربری
                </a>
            </li>


            <li>
                <form class="grid" action="{{route('logout')}}" method="post">
                    @csrf
                    @method('POST')
                    <button class="flex items-center text-red-500 hover:text-primary hover:bg-gray-100 px-8 py-2 sm:py-4 transition-all ">
                        <i class="fa fa-sign-out mx-1"></i>
                        خروج
                    </button>
                </form>
            </li>
        </ul>
    </div>
</aside>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('translate-x-full');
    }
</script>

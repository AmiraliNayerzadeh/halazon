<header class=' border-b shadow shadow-lg bg-white  tracking-wide relative z-50'>
    <div class="container mx-auto">
        <section class='flex  items-center justify-between  py-3 px-2 sm:px-10 min-h-[75px] '>

            <a href="{{route('home')}}" class=""><img src="/assets/logo.png" alt="logo" class='w-[120px]'/></a>

            <div class="flex px-4 w-1/3  rounded-3xl border-2  max-lg:hidden">
                <input type="text" placeholder="جستجو میان دوره های حلزون..."
                       class="w-full py-3 outline-none border-0 text-gray-600 text-sm"/>
                <button type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>

            <div class="flex items-center ">

                <a class="p-3 {{\Illuminate\Support\Facades\Request::is('/profile/favorites') ? 'text-primary' : ''}} "
                   href="{{route('profile.favorite')}}">
                    <i class="fa-regular fa-heart text-lg"></i>
                </a>
                <a class="p-3 {{\Illuminate\Support\Facades\Request::is('cart*') ? 'text-primary' : ''}}"
                   href="{{route('cart.index')}}">
                    <i class="fa-solid fa-cart-shopping text-lg"></i>
                </a>


                @auth
                    <span class='px-4 py-3 rounded-3xl bg-main text-white text-sm'>
                        <a href="{{route('profile.index')}}">
                        @if(!is_null(auth()->user()->name))
                                {{auth()->user()->name}} {{auth()->user()->family}}
                            @else
                                {{auth()->user()->phone}}
                            @endif
                        </a>
                    </span>
                @endauth
                @guest
                    <a href="{{route('login')}}"
                       class='px-4 py-3 rounded-3xl bg-main hover:bg-main100 duration-500 text-white shadow'>ورود/ثبت
                        نام</a>
                @endguest
            </div>

        </section>

        <div class='flex flex-wrap items-start gap-4 px-10 py-4 relative'>

            <div id="collapseMenu"
                 class='w-full max-lg:hidden lg:!block max-lg:fixed max-lg:before:fixed max-lg:before:bg-black max-lg:before:opacity-50 max-lg:before:inset-0 max-lg:before:z-50'>
                <button id="toggleClose" class='lg:hidden fixed top-2 right-4 z-[100] rounded-full bg-white p-3'>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 fill-black" viewBox="0 0 320.591 320.591">
                        <path
                                d="M30.391 318.583a30.37 30.37 0 0 1-21.56-7.288c-11.774-11.844-11.774-30.973 0-42.817L266.643 10.665c12.246-11.459 31.462-10.822 42.921 1.424 10.362 11.074 10.966 28.095 1.414 39.875L51.647 311.295a30.366 30.366 0 0 1-21.256 7.288z"
                                data-original="#000000"></path>
                        <path
                                d="M287.9 318.583a30.37 30.37 0 0 1-21.257-8.806L8.83 51.963C-2.078 39.225-.595 20.055 12.143 9.146c11.369-9.736 28.136-9.736 39.504 0l259.331 257.813c12.243 11.462 12.876 30.679 1.414 42.922-.456.487-.927.958-1.414 1.414a30.368 30.368 0 0 1-23.078 7.288z"
                                data-original="#000000"></path>
                    </svg>
                </button>

                <ul class='lg:flex lg:justify-between gap-x-8 max-lg:space-y-3 max-lg:fixed max-lg:bg-white max-lg:w-1/2 max-lg:min-w-[300px] max-lg:top-0 max-lg:left-0 max-lg:p-6 max-lg:h-full max-lg:shadow-md max-lg:overflow-auto z-50'>

                    @foreach(\App\Models\Category::where('parent_id' , null)->get() as $main)

                        <li class='group text-[14px] max-lg:border-b max-lg:px-3 max-lg:py-2 relative'>
                            <a href="{{route('category' , $main)}}"
                               class='hover:text-main50  font-bold  block'>{{$main->title}}
                                <span class="fa fa-angle-down"></span>

                            </a>
                            @if(count($main->children))
                                <div class='absolute lg:top-5 max-lg:top-8  z-50 flex shadow-lg bg-white max-h-0 overflow-hidden group-hover:opacity-100 group-hover:max-h-[700px] px-8 group-hover:pb-8 group-hover:pt-6 transition-all duration-500'>
                                    @foreach($main->children as $child)

                                        <div class="lg:min-w-[180px] max-lg:min-w-[140px]">

                                            <h6 class="text-base text-[#007bff] font-bold">
                                                <a class="text-primary font-extrabold"
                                                   href="{{route('category' , $child)}}">{{$child->title}}</a></h6>
                                            @if(count($child->children))
                                                <ul class='mt-3 pt-3 border-t border-1 space-y-3'>
                                                    @foreach($child->children as $childest)
                                                        <li class='max-lg:border-b py-1 rounded'><a
                                                                    href="{{route('category' , $childest)}}"
                                                                    class='hover:text-[#007bff] text-gray-500 font-bold text-sm block'>{{$childest->title}}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </div>
                                    @endforeach

                                </div>
                            @endif

                        </li>

                        {{--                    <li class='max-lg:border-b border-main max-lg:py-3'><a href='javascript:void(0)' class='hover:text-main50 duration-500'>--}}
                        {{--                            {{$main->title}}--}}
                        {{--                            <i class="fa-solid fa-angle-down"></i>--}}
                        {{--                        </a>--}}
                        {{--                    </li>--}}
                    @endforeach


                </ul>
            </div>

            <div class='flex ml-auto lg:hidden'>
                <button id="toggleOpen">
                    <i class="fa-solid fa-bars text-2xl text-main"></i>
                </button>
            </div>
        </div>
    </div>
</header>